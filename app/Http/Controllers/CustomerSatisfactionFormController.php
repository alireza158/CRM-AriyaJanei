<?php

namespace App\Http\Controllers;

use App\Models\CustomerSatisfactionForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;

class CustomerSatisfactionFormController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasAnyRole(['Admin', 'internalManager', 'InternalManager'])) {
            $forms = CustomerSatisfactionForm::with(['assignedToUser', 'createdByUser'])
                ->latest()
                ->paginate(20);
        } elseif ($user->hasRole('customer_review')) {
            $forms = CustomerSatisfactionForm::with(['assignedToUser', 'createdByUser'])
                ->where(function ($q) use ($user) {
                    $q->where('created_by_user_id', $user->id)
                        ->orWhere('assigned_to_user_id', $user->id);
                })
                ->latest()
                ->paginate(20);
        } else {
            abort(403);
        }

        return view('customer-satisfaction-forms.index', compact('forms'));
    }

    public function create()
    {
        $user = Auth::user();

        if (! $user->hasRole('customer_review')) {
            abort(403);
        }

        $reviewUsers = User::role('customer_review')->orderBy('name')->get();

        return view('customer-satisfaction-forms.create', compact('reviewUsers'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if (! $user->hasRole('customer_review')) {
            abort(403);
        }

        $validated = $request->validate([
            'customers' => ['required', 'array', 'min:1'],
            'customers.*.submitted_at' => ['required', 'date'],
            'customers.*.shipment_sent_at_fa' => ['required', 'string'],
            'customers.*.customer_full_name' => ['required', 'string', 'max:255'],
            'customers.*.shipping_method' => ['required', 'in:barbari,tipax,rahmati,ghafari,nadi,hozori'],
            'customers.*.satisfaction_status' => ['required', 'in:satisfied,unsatisfied'],
            'customers.*.assigned_to_user_id' => ['required', 'integer'],
            'customers.*.referral_note' => ['nullable', 'string'],
        ]);

        foreach ($validated['customers'] as $formData) {
            $assignedUser = User::role('customer_review')->findOrFail($formData['assigned_to_user_id']);

            CustomerSatisfactionForm::create([
                'submitted_at' => $formData['submitted_at'],
                'shipment_sent_at' => Verta::parse($formData['shipment_sent_at_fa'])->datetime()->format('Y-m-d'),
                'customer_name' => trim($formData['customer_full_name']),
                'customer_family' => null,
                'shipping_method' => $formData['shipping_method'],
                'satisfaction_status' => $formData['satisfaction_status'],
                'assigned_to_user_id' => $assignedUser->id,
                'created_by_user_id' => $user->id,
                'referral_note' => $formData['referral_note'] ?? null,
            ]);
        }

        return redirect()->route('customer-satisfaction-forms.index')->with('success', 'فرم‌های رضایت مشتری با موفقیت ثبت شدند.');
    }

    public function show(CustomerSatisfactionForm $customerSatisfactionForm)
    {
        $user = Auth::user();

        $canView =
            $user->hasAnyRole(['Admin', 'internalManager', 'InternalManager']) ||
            $customerSatisfactionForm->created_by_user_id === $user->id ||
            $customerSatisfactionForm->assigned_to_user_id === $user->id;

        if (! $canView) {
            abort(403);
        }

        $customerSatisfactionForm->load(['assignedToUser', 'createdByUser']);

        return view('customer-satisfaction-forms.show', [
            'form' => $customerSatisfactionForm,
        ]);
    }


    public function destroy(CustomerSatisfactionForm $customerSatisfactionForm)
    {
        $user = Auth::user();

        if ($customerSatisfactionForm->created_by_user_id !== $user->id) {
            abort(403, 'فقط ثبت‌کننده می‌تواند فرم را حذف کند.');
        }

        if (! empty($customerSatisfactionForm->result)) {
            return redirect()->route('customer-satisfaction-forms.index')
                ->with('error', 'فرمی که نتیجه برای آن ثبت شده قابل حذف نیست.');
        }

        $customerSatisfactionForm->delete();

        return redirect()->route('customer-satisfaction-forms.index')
            ->with('success', 'فرم رضایت مشتری با موفقیت حذف شد.');
    }



    public function markAssignedReferralsSeen(): JsonResponse
    {
        $user = Auth::user();

        $updated = CustomerSatisfactionForm::query()
            ->where('assigned_to_user_id', $user->id)
            ->whereNull('referral_seen_at')
            ->update(['referral_seen_at' => now()]);

        return response()->json([
            'success' => true,
            'updated' => $updated,
        ]);
    }

    public function submitResult(Request $request, CustomerSatisfactionForm $customerSatisfactionForm)
    {
        $user = Auth::user();

        if ($customerSatisfactionForm->assigned_to_user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'result' => ['required', 'string'],
        ]);

        $customerSatisfactionForm->update([
            'result' => $validated['result'],
            'result_filled_at' => now(),
        ]);

        return redirect()->route('customer-satisfaction-forms.show', $customerSatisfactionForm)
            ->with('success', 'نتیجه بررسی ثبت شد.');
    }
}
