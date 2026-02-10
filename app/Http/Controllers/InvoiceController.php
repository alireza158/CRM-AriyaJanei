<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    public function __construct()
    {
        // محدود کردن دسترسی بر اساس نقش
        $this->middleware('role:Admin')->only([
            'indexByMarketer', 'createForAdmin', 'storeForAdmin',
            'showByAdmin', 'editByAdmin', 'updateByAdmin', 'destroyByAdmin'
        ]);

        $this->middleware('role:Marketer')->only([
            'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
        ]);
    }

    // ================= Helpers =================

    protected function validateInvoice(Request $request): array
    {
        return $request->validate([
            'invoice_date' => 'required|date',
            'description'  => 'nullable|string',
            'attachment'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);
    }

    protected function handleAttachment(Request $request, ?Invoice $invoice = null): ?string
    {
        if (! $request->hasFile('attachment')) {
            return $invoice?->attachment_path;
        }

        // حذف فایل قبلی
        if ($invoice && $invoice->attachment_path) {
            Storage::disk('public')->delete($invoice->attachment_path);
        }

        return $request->file('attachment')->store('invoices', 'public');
    }

    // ================= Marketer =================

    public function index(Customer $customer)
    {
        $invoices = $customer->invoices()
            ->latest()
            ->paginate(15);

        return view('marketer.invoices.index', compact('invoices', 'customer'));
    }

    public function create(Customer $customer)
    {
        $action  = route('marketer.invoices.store', $customer);
        $invoice = null;

       return view('marketer.invoices.create', compact('customer', 'action', 'invoice'));
    }

    public function store(Request $request, Customer $customer)
{
    $data = $this->validateInvoice($request);

    $data['user_id']      = Auth::id();
    $data['customer_id']  = $customer->id;
    $data['total_amount'] = 0;

    // اگر دیگه attachment_path رو نمی‌خوای، این خط رو حذف کن
    // $data['attachment_path'] = $this->handleAttachment($request);

    $invoice = Invoice::create($data);

    // ذخیره چند فایل
    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            $path = $file->store('invoices', 'public');

            $invoice->attachments()->create([
                'path' => $path,
            ]);
        }
    }

    return redirect()
        ->route('marketer.invoices.index', $customer)
        ->with('success', 'فاکتور با موفقیت ثبت شد.');
}

    public function show(Customer $customer, Invoice $invoice)
    {
        abort_if($invoice->customer_id !== $customer->id, 404);

        return view('marketer.invoices.show', compact('customer', 'invoice'));
    }

    public function edit(Customer $customer, Invoice $invoice)
    {
        abort_if($invoice->customer_id !== $customer->id, 404);

        $action = route('marketer.invoices.update', [$customer, $invoice]);

        return view('marketer.invoices.form', compact('customer', 'invoice', 'action'));
    }

    public function update(Request $request, Customer $customer, Invoice $invoice)
    {
        abort_if($invoice->customer_id !== $customer->id, 404);

        $data = $this->validateInvoice($request);

        $data['attachment_path'] = $this->handleAttachment($request, $invoice);

        $invoice->update($data);

        return redirect()
            ->route('marketer.invoices.index', $customer)
            ->with('success', 'فاکتور با موفقیت بروزرسانی شد.');
    }
public function destroy(Customer $customer, Invoice $invoice)
{
    abort_if($invoice->customer_id !== $customer->id, 404);

    // حذف چند پیوست متصل به فاکتور
    foreach ($invoice->attachments as $attachment) {
        Storage::disk('public')->delete($attachment->path);
    }

    $invoice->delete();

    return redirect()
        ->route('marketer.invoices.index', $customer)
        ->with('success', 'فاکتور با موفقیت حذف شد.');
}

    // ================= Admin =================

    public function indexByMarketer(User $marketer, Customer $customer)
    {
        $invoices = Invoice::where('user_id', $marketer->id)
            ->where('customer_id', $customer->id)
            ->latest()
            ->paginate(15);

        return view(
            'admin.marketers.customers.invoices.index',
            compact('invoices', 'marketer', 'customer')
        );
    }

    public function createForAdmin(User $marketer, Customer $customer)
    {
        $action  = route('admin.marketers.invoices.store', [$marketer, $customer]);
        $invoice = null;

        return view(
            'admin.marketers.customers.invoices.form',
            compact('marketer', 'customer', 'action', 'invoice')
        );
    }

    public function storeForAdmin(Request $request, User $marketer, Customer $customer)
    {
        $data = $this->validateInvoice($request);

        $data['user_id']      = $marketer->id;
        $data['customer_id']  = $customer->id;
        $data['total_amount'] = 0;

        $data['attachment_path'] = $this->handleAttachment($request);

        Invoice::create($data);

        return redirect()
            ->route('admin.marketers.invoices.index', [$marketer, $customer])
            ->with('success', 'فاکتور با موفقیت ثبت شد.');
    }

    public function showByAdmin(User $marketer, Customer $customer, Invoice $invoice)
    {
        return view(
            'admin.marketers.customers.invoices.show',
            compact('invoice', 'marketer', 'customer')
        );
    }

    public function editByAdmin(User $marketer, Customer $customer, Invoice $invoice)
    {
        $action = route('admin.marketers.invoices.update', [$marketer, $customer, $invoice]);

        return view(
            'admin.marketers.customers.invoices.form',
            compact('marketer', 'customer', 'invoice', 'action')
        );
    }

    public function updateByAdmin(Request $request, User $marketer, Customer $customer, Invoice $invoice)
    {
        $data = $this->validateInvoice($request);

        $data['attachment_path'] = $this->handleAttachment($request, $invoice);

        $invoice->update($data);

        return redirect()
            ->route('admin.marketers.invoices.index', [$marketer, $customer])
            ->with('success', 'فاکتور با موفقیت بروزرسانی شد.');
    }

    public function destroyByAdmin(User $marketer, Customer $customer, Invoice $invoice)
    {
        if ($invoice->attachment_path) {
            Storage::disk('public')->delete($invoice->attachment_path);
        }

        $invoice->delete();

        return redirect()
            ->route('admin.marketers.invoices.index', [$marketer, $customer])
            ->with('success', 'فاکتور با موفقیت حذف شد.');
    }
}
