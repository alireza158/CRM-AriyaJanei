<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\ReferenceType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin')->only(['allNotes', 'marketers', 'customersOfMarketer']);
        $this->middleware('role:Admin|Marketer')->only([
            'index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'exportExcel'
        ]);
    }

    public function allNotes()
    {
        $customers = Customer::with(['marketer'])->paginate(20);
        return view('admin.customers.notes', compact('customers'));
    }

    public function customersOfMarketer($marketerId)
    {
        $marketer = User::findOrFail($marketerId);
        $customers = Customer::with(['category', 'referenceType'])
            ->where('user_id', $marketer->id)
            ->paginate(15);

        return view('admin.marketers.customers.index', compact('customers', 'marketer'));
    }

    public function index(Request $request)
    {
        $query = Customer::with(['category', 'referenceType'])
            ->where('user_id', Auth::id());

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $customers = $query->paginate(20)->withQueryString();

        return view('marketer.customers.index', compact('customers'));
    }

    public function exportExcel(Request $request, $marketerId = null)
    {
        if (Auth::user()->hasRole('Admin') && $marketerId) {
            $marketer = User::findOrFail($marketerId);
            $customers = Customer::with(['category', 'referenceType', 'marketer', 'notes.author'])
                ->where('user_id', $marketer->id)
                ->get();
            $filename = 'customers-' . $marketer->id . '-' . now()->format('Ymd-His') . '.xlsx';
        } else {
            $customers = Customer::with(['category', 'referenceType', 'marketer', 'notes.author'])
                ->where('user_id', Auth::id())
                ->get();
            $filename = 'customers-' . Auth::id() . '-' . now()->format('Ymd-His') . '.xlsx';
        }

        $rows = $customers->map(function ($customer) {
            $notes = $customer->notes
                ->sortBy('created_at')
                ->map(function ($note, $index) {
                    $createdAt = $note->created_at instanceof Carbon
                        ? $note->created_at->format('Y-m-d H:i')
                        : '-';

                    return sprintf(
                        '%d) [%s] %s: %s',
                        $index + 1,
                        $createdAt,
                        $note->author->name ?? 'نامشخص',
                        trim(($note->title ? $note->title . ' - ' : '') . ($note->content ?? ''))
                    );
                })
                ->implode("\n");

            return [
                'id' => $customer->customer_number ?? (100000 + $customer->id),
                'name' => $customer->name,
                'phone' => $customer->phone,
                'disc' => $customer->DISC,
                'address' => $customer->address,
                'category' => $customer->category->name ?? '-',
                'reference_type' => $customer->referenceType->name ?? '-',
                'marketer' => $customer->marketer->name ?? '-',
                'created_at' => optional($customer->created_at)->format('Y-m-d H:i'),
                'updated_at' => optional($customer->updated_at)->format('Y-m-d H:i'),
                'notes' => $notes,
            ];
        })->toArray();

        $export = new class($rows) implements FromArray, WithHeadings {
            public function __construct(private array $rows)
            {
            }

            public function array(): array
            {
                return $this->rows;
            }

            public function headings(): array
            {
                return [
                    'شناسه مشتری',
                    'نام مشتری',
                    'تلفن',
                    'DISC',
                    'آدرس',
                    'دسته‌بندی',
                    'منبع آشنایی',
                    'نام بازاریاب',
                    'تاریخ ایجاد',
                    'تاریخ آخرین ویرایش',
                    'یادداشت‌ها',
                ];
            }
        };

        return Excel::download($export, $filename);
    }

    public function create($marketerId = null)
    {
        $categories = Category::all();
        $referenceTypes = ReferenceType::all();

        if (Auth::user()->hasRole('Admin')) {
            $marketer = User::findOrFail($marketerId);
            return view('admin.marketers.customers.create', compact('categories', 'referenceTypes', 'marketer'));
        }

        return view('marketer.customers.create', compact('categories', 'referenceTypes'));
    }

    public function store(Request $request, $marketerId = null)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'DISC'              => 'nullable|string|max:255',
            'phone'             => 'nullable|string|max:20|unique:customers,phone',
            'province'          => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'address'           => 'nullable|string',
            'category_id'       => 'required|exists:categories,id',
            'reference_type_id' => 'required|exists:reference_types,id',
        ]);

        if (Auth::user()->hasRole('Admin')) {
            $marketer = User::findOrFail($marketerId);
            $data['user_id'] = $marketer->id;
        } else {
            $data['user_id'] = Auth::id();
        }

        $customer = Customer::create($data);

        // 📌 لاگ ایجاد مشتری
        activity()
            ->performedOn($customer)
            ->causedBy(auth()->user())
            ->withProperties(['data' => $data])
            ->log('ایجاد مشتری جدید');

        if (Auth::user()->hasRole('Admin')) {
            return redirect()->route('admin.marketers.customers.index', $marketer->id)
                ->with('success', 'مشتری با موفقیت ساخته شد.');
        }

      

        return redirect()->route('marketer.customer.notes.create', ['customer' => $customer->id])
        ->with('success', 'مشتری با موفقیت ساخته شد. حالا می‌توانید یادداشت جدید ثبت کنید.');
    }

    public function edit(User $marketer, Customer $customer)
    {
        if (Auth::user()->hasRole('Admin')) {
            return view('admin.marketers.customers.edit', compact('customer', 'marketer'));
        }else{
            $categories = Category::all();
        $referenceTypes = ReferenceType::all();

             return view('marketer.customers.edit', compact(
            'customer',
            'marketer',
            'categories',
            'referenceTypes'
        ));
        }
    }

    public function update(Request $request, User $marketer, Customer $customer)
    {
        if (Auth::user()->hasRole('Marketer') && $customer->user_id !== Auth::id()) {
            abort(403);
        }

        $before = $customer->only([
            'user_id',
            'name',
            'DISC',
            'phone',
            'province',
            'city',
            'address',
            'category_id',
            'reference_type_id',
        ]);

        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'DISC'              => 'nullable|string|max:255',
            'phone'             => 'nullable|string|max:20|unique:customers,phone,' . $customer->id,
            'province'          => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'address'           => 'nullable|string',
            'category_id'       => 'required|exists:categories,id',
            'reference_type_id' => 'required|exists:reference_types,id',
        ]);

        if (Auth::user()->hasRole('Admin')) {
            $data['user_id'] = $marketer->id;
        } else {
            $data['user_id'] = Auth::id();
        }

        $customer->update($data);

        $customer->refresh();
        $after = $customer->only([
            'user_id',
            'name',
            'DISC',
            'phone',
            'province',
            'city',
            'address',
            'category_id',
            'reference_type_id',
        ]);

        $changedFields = collect($before)
            ->keys()
            ->filter(fn ($field) => ($before[$field] ?? null) != ($after[$field] ?? null))
            ->values()
            ->all();

        // 📌 لاگ ویرایش مشتری
        activity()
            ->performedOn($customer)
            ->causedBy(auth()->user())
            ->withProperties([
                'before' => $before,
                'after' => $after,
                'changed_fields' => $changedFields,
            ])
            ->log('ویرایش اطلاعات مشتری');

        if (Auth::user()->hasRole('Admin')) {
            return redirect()->route('admin.marketers.customers.index', $marketer->id)
                ->with('success', 'مشتری با موفقیت به‌روزرسانی شد.');
        }


        return redirect()->route('marketer.customers.index')
            ->with('success', 'مشتری با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(User $marketer, Customer $customer)
    {
        if (Auth::user()->hasRole('Marketer')) {
            abort(403);
        }

        $customer->delete();

        // 📌 لاگ حذف مشتری
        activity()
            ->performedOn($customer)
            ->causedBy(auth()->user())
            ->withProperties(['id' => $customer->id, 'name' => $customer->name])
            ->log('حذف مشتری');

        if (Auth::user()->hasRole('Admin')) {
            return redirect()->route('admin.marketers.customers.index', $marketer->id)
                ->with('success', 'مشتری با موفقیت حذف شد.');
        }

        return redirect()->route('marketer.customers.index')
            ->with('success', 'مشتری با موفقیت حذف شد.');
    }
}
