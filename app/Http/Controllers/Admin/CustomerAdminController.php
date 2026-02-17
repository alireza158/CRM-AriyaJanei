<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\ReferenceType;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;
use App\Models\CustomerNote;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;
class CustomerAdminController extends Controller
{
  

public function index(Request $request)
{
    $search = $request->get('search');
    $sort   = $request->get('sort'); // last_note | null

    // تاریخ‌ها ممکنه با اعداد فارسی بیان
    $noteFrom = $this->faToEnDigits($request->get('note_from')); // YYYY/MM/DD
    $noteTo   = $this->faToEnDigits($request->get('note_to'));   // YYYY/MM/DD

    $fromCarbon = null;
    $toCarbon   = null;

    try {
        if ($noteFrom) {
            $fromCarbon = Jalalian::fromFormat('Y/m/d', $noteFrom)->toCarbon()->startOfDay();
        }
        if ($noteTo) {
            $toCarbon = Jalalian::fromFormat('Y/m/d', $noteTo)->toCarbon()->endOfDay();
        }
    } catch (\Throwable $e) {
        // اگر فرمت غلط بود، بازه اعمال نشه
        $fromCarbon = null;
        $toCarbon = null;
    }

    // ساب‌کوئری: آخرین زمان یادداشت هر مشتری
    $lastNoteSub = CustomerNote::query()
        ->select('customer_id', DB::raw('MAX(created_at) as last_note_at'))
        ->groupBy('customer_id');

    $customersQuery = Customer::query()
        ->with([
            'marketer',
            'notes' => fn ($q) => $q->latest(),
            'invoices',
            'referenceType',
        ])
        ->leftJoinSub($lastNoteSub, 'ln', fn ($join) => $join->on('ln.customer_id', '=', 'customers.id'))
        ->addSelect('customers.*', 'ln.last_note_at');

    // سرچ
    $customersQuery->when($search, function ($query, $search) {
        $query->where(function ($q) use ($search) {
            $q->where('customers.name', 'like', "%{$search}%")
              ->orWhere('customers.phone', 'like', "%{$search}%");
        });
    });

    // ✅ حالت last_note: فیلتر بازه + مرتب‌سازی
    if ($sort === 'last_note') {

        // ✅ اینجا کلید حل مشکل است: فیلتر روی last_note_at
        if ($fromCarbon && $toCarbon) {
            $customersQuery->whereBetween('ln.last_note_at', [$fromCarbon, $toCarbon]);
        } elseif ($fromCarbon) {
            $customersQuery->where('ln.last_note_at', '>=', $fromCarbon);
        } elseif ($toCarbon) {
            $customersQuery->where('ln.last_note_at', '<=', $toCarbon);
        }

        // اگر بازه وارد شده، مشتری‌های بدون یادداشت باید حذف شوند (چون داخل بازه نیستند)
        if ($fromCarbon || $toCarbon) {
            $customersQuery->whereNotNull('ln.last_note_at');
        }

        $customersQuery
            ->orderByDesc('ln.last_note_at')
            ->orderByDesc('customers.id');

    } else {
        $customersQuery->orderByDesc('customers.id');
    }

    $customers = $customersQuery->paginate(15);

    return view('admin.customers.index', compact('customers', 'search', 'sort'));
}

private function faToEnDigits(?string $value): ?string
{
    if ($value === null) return null;

    $fa = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹','٫','٬'];
    $en = ['0','1','2','3','4','5','6','7','8','9','.',''];

    return str_replace($fa, $en, trim($value));
}



    
public function exportExcelAllCustomers()
{
    $customers = Customer::with(['marketer', 'referenceType', 'notes.author'])->orderByDesc('id')->get();

    $rows = $customers->map(function ($customer) {
        $notes = $customer->notes
            ->sortBy('created_at')
            ->map(function ($note, $index) {
                $createdAt = $note->created_at instanceof Carbon
                    ? $note->created_at->format('Y-m-d H:i')
                    : '-';

                $noteText = trim(($note->title ? $note->title . ' - ' : '') . ($note->content ?? ''));

                return sprintf('%d) [%s] %s: %s', $index + 1, $createdAt, $note->author->name ?? 'نامشخص', $noteText);
            })
            ->implode("\n");

        return [
            $customer->id,
            $customer->name,
            $customer->phone,
            $customer->address,
            $customer->referenceType?->name ?? '-',
            $customer->marketer?->name ?? '-',
            optional($customer->created_at)->format('Y-m-d H:i'),
            optional($customer->updated_at)->format('Y-m-d H:i'),
            $notes,
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
                'آدرس',
                'نحوه آشنایی',
                'نام بازاریاب',
                'تاریخ ایجاد',
                'تاریخ آخرین ویرایش',
                'یادداشت‌ها',
            ];
        }
    };

    $filename = 'all-customers-' . now()->format('Ymd-His') . '.xlsx';

    return Excel::download($export, $filename);
}

public function create()
    {
        $marketers = User::role('Marketer')->get();
        $refrenses = ReferenceType::get();
        return view('admin.customers.create', compact('marketers','refrenses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required|string|unique:customers',
            'reference_type_id' => 'nullable|exists:reference_types,id',
            'address' => 'nullable|string',
            'user_id'=> 'nullable|exists:users,id',
        ]);

        $request->merge([
            'marketer_changed_at' => now(),
        ]);

        $customer = Customer::create($request->all());

        activity()
            ->performedOn($customer)
            ->causedBy(auth()->user())
            ->withProperties(['name' => $customer->name, 'phone' => $customer->phone])
            ->log('ایجاد مشتری جدید');

        return redirect()->route('admin.customersAdmin.index')
            ->with('success', 'مشتری جدید ثبت شد.');
    }

    public function edit(Customer $customer)
    {
        $marketers = User::role('marketer')->get();
        $refrenses = ReferenceType::get();
        return view('admin.customers.edit', compact('customer', 'marketers','refrenses'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required',
            'user_id' => 'nullable|exists:users,id',
            'address' => 'nullable',
            'reference_type_id' => 'nullable|exists:reference_types,id',
        ]);

        if ($request->user_id != $customer->user_id) {
            $customer->marketer_changed_at = now();
        }

        $customer->update([
            'user_id' => $request->user_id ?? $customer->user_id,
            'name' => $request->name ?? $customer->name,
            'phone' => $request->phone ?? $customer->phone,
            'reference_type_id' => $request->reference_type_id ?? $customer->reference_type_id,
            'address' => $request->address ?? $customer->address,
            'category_id' => $request->category_id ?? $customer->category_id,
            'marketer_changed_at' => $customer->marketer_changed_at,
        ]);

        activity()
            ->performedOn($customer)
            ->causedBy(auth()->user())
            ->withProperties(['changed' => $request->all()])
            ->log('ویرایش اطلاعات مشتری');

        return redirect()->route('admin.customersAdmin.index')->with('success', 'اطلاعات مشتری ویرایش شد.');
    }

    public function destroy(Customer $customer)
    {
        $customerName = $customer->name;
        $customerPhone = $customer->phone;

        $customer->delete();

        activity()
            ->performedOn($customer)
            ->causedBy(auth()->user())
            ->withProperties(['name' => $customerName, 'phone' => $customerPhone])
            ->log('حذف مشتری');

        return redirect()->route('admin.customersAdmin.index')->with('success', 'مشتری حذف شد.');
    }
}
