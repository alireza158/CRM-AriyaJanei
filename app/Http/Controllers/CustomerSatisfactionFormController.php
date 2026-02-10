<?php

namespace App\Http\Controllers;

use App\Models\CustomerSatisfactionForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'submitted_at' => ['required', 'date'],
            'shipment_sent_at_fa' => ['required', 'string'],
            'customer_full_name' => ['nullable', 'string', 'max:255'],
            'customers_bulk_input' => ['nullable', 'string'],
            'shipping_method' => ['required', 'in:barbari,tipax,rahmati,ghafari,nadi,hozori'],
            'satisfaction_status' => ['required', 'in:satisfied,unsatisfied'],
            'assigned_to_user_id' => ['required', 'integer'],
            'referral_note' => ['nullable', 'string'],
        ]);

        if (empty(trim((string) ($validated['customer_full_name'] ?? ''))) && empty(trim((string) ($validated['customers_bulk_input'] ?? '')))) {
            return back()
                ->withErrors(['customers_bulk_input' => 'حداقل یک نام مشتری وارد کنید.'])
                ->withInput();
        }

        $assignedUser = User::role('customer_review')->findOrFail($validated['assigned_to_user_id']);

        $customers = $this->extractCustomers(
            $validated['customer_full_name'] ?? null,
            $validated['customers_bulk_input'] ?? null
        );

        if (count($customers) === 0) {
            return back()
                ->withErrors(['customers_bulk_input' => 'فرمت نام مشتری صحیح نیست.'])
                ->withInput();
        }

        $shipmentSentAt = Verta::parse($validated['shipment_sent_at_fa'])->datetime()->format('Y-m-d');

        DB::transaction(function () use ($validated, $assignedUser, $user, $shipmentSentAt, $customers) {
            foreach ($customers as $customer) {
                CustomerSatisfactionForm::create([
                    'submitted_at' => $validated['submitted_at'],
                    'shipment_sent_at' => $shipmentSentAt,
                    'customer_name' => $customer['customer_name'],
                    'customer_family' => $customer['customer_family'],
                    'shipping_method' => $validated['shipping_method'],
                    'satisfaction_status' => $validated['satisfaction_status'],
                    'assigned_to_user_id' => $assignedUser->id,
                    'created_by_user_id' => $user->id,
                    'referral_note' => $validated['referral_note'] ?? null,
                ]);
            }
        });

        $successMessage = count($customers) > 1
            ? count($customers) . ' فرم رضایت مشتری با موفقیت ثبت شد.'
            : 'فرم رضایت مشتری با موفقیت ثبت شد.';

        return redirect()->route('customer-satisfaction-forms.index')->with('success', $successMessage);
    }

    private function extractCustomers(?string $singleFullName, ?string $bulkInput): array
    {
        $rows = [];

        if (! empty(trim((string) $singleFullName))) {
            $rows[] = trim($singleFullName);
        }

        if (! empty(trim((string) $bulkInput))) {
            $bulkRows = preg_split('/\r\n|\r|\n/', trim($bulkInput)) ?: [];
            $rows = array_merge($rows, $bulkRows);
        }

        $customers = [];

        foreach ($rows as $row) {
            $line = trim($row);

            if ($line === '') {
                continue;
            }

            $tabParts = preg_split('/\t+/', $line) ?: [];
            $tabParts = array_values(array_filter(array_map('trim', $tabParts), fn ($value) => $value !== ''));

            if (count($tabParts) >= 2) {
                $name = $tabParts[0];
                $family = implode(' ', array_slice($tabParts, 1));
            } else {
                $nameParts = preg_split('/\s+/u', $line, -1, PREG_SPLIT_NO_EMPTY) ?: [];

                if (count($nameParts) < 2) {
                    continue;
                }

                $name = array_shift($nameParts);
                $family = implode(' ', $nameParts);
            }

            if ($name === '' || $family === '') {
                continue;
            }

            $customers[] = [
                'customer_name' => mb_substr($name, 0, 255),
                'customer_family' => mb_substr($family, 0, 255),
            ];
        }

        return $customers;
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
