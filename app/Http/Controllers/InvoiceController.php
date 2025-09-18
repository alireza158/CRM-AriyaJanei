<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin')->only(
            'indexByMarketer',
            'createForAdmin',
            'storeForAdmin',
            'showByAdmin',
            'editByAdmin',
            'updateByAdmin',
            'destroyByAdmin',
        );
        $this->middleware('role:Marketer')->only(
            'index',
            'create',
            'store',
            'show',
            'edit',
            'update',
            'destroy',
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Customer $customer)
    {
        $user = Auth::user();
//        dd($user);
        $invoices = $customer->invoices()
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
//        $invoices = Invoice::with(['customer', 'items'])
//            ->where('user_id', $user->id)
//            ->where('customer_id', $customer->id)
//            ->orderByDesc('created_at')
//            ->paginate(15);

        return view('marketer.invoices.index', compact('invoices', 'customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Customer $customer)
    {
        $products  = Product::all();

        return view('marketer.invoices.create', compact('customer', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        $request->validate([
//            'customer_id'         => 'required|exists:customers,id',
            'invoice_date'        => 'required|date',
            'items'               => 'required|array|min:1',
            'items.*.product_id'  => 'required|exists:products,id',
            'items.*.quantity'    => 'required|integer|min:1',
            'items.*.unit_price'  => 'required|numeric|min:0',
            'description'         => 'nullable|string',
        ]);

//        $data = $request->only(['customer_id', 'invoice_date', 'description']);
        $data = $request->only(['invoice_date', 'description']);
        $data['user_id'] = Auth::id();
        $data['customer_id'] = $customer->id;

        $items = collect($request->input('items'))->map(function($item) {
            $item['sub_total'] = $item['quantity'] * $item['unit_price'];
            return $item;
        })->toArray();

        $total = collect($items)->sum('sub_total');

        // ذخیره درون تراکنش
        DB::transaction(function() use ($data, $items, $total) {
            $invoice = Invoice::create(array_merge($data, [
                'total_amount' => $total,
            ]));
            $invoice->items()->createMany($items);
        });

        return redirect()
            ->route('marketer.invoices.index', $customer)
            ->with('success', 'فاکتور با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer, Invoice $invoice)
    {
        if ($invoice->customer_id !== $customer->id) {
            abort(404);
        }
        $invoice->load(['customer', 'items.product']);
        return view('marketer.invoices.show', compact( 'customer','invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, Invoice $invoice)
    {
        if ($invoice->customer_id !== $customer->id) {
            abort(404);
        }
        $invoice->load('items');
        $products  = Product::all();

        return view('marketer.invoices.edit', compact('customer','invoice',  'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer, Invoice $invoice)
    {
        $request->validate([
//            'customer_id'         => 'required|exists:customers,id',
            'invoice_date'        => 'required|date',
            'items'               => 'required|array|min:1',
            'items.*.product_id'  => 'required|exists:products,id',
            'items.*.quantity'    => 'required|integer|min:1',
            'items.*.unit_price'  => 'required|numeric|min:0',
            'description'         => 'nullable|string',
        ]);

        $data = [
            'invoice_date'  => $request->invoice_date,
            'description'   => $request->description,
            'customer_id'   => $customer->id,
        ];

        $items = collect($request->input('items'))->map(function($item) {
            $item['sub_total'] = $item['quantity'] * $item['unit_price'];
            return $item;
        })->toArray();

        $total = collect($items)->sum('sub_total');

        DB::transaction(function() use ($invoice, $data, $items, $total) {
            $invoice->items()->delete();

            $invoice->update(array_merge($data, [
                'total_amount' => $total,
            ]));

            $invoice->items()->createMany($items);
        });

        return redirect()
            ->route('marketer.invoices.index', $customer)
            ->with('success', 'فاکتور با موفقیت بروزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, Invoice $invoice)
    {
        if ($invoice->customer_id !== $customer->id) {
            abort(404);
        }
        $invoice->delete();
        return redirect()
            ->route('marketer.invoices.index', $customer)
            ->with('success', 'فاکتور با موفقیت حذف شد.');
    }

    // ------------------- بخش مدیریت (Admin) -------------------

    public function indexByMarketer(User $marketer, Customer $customer)
    {
        $invoices = Invoice::with(['customer', 'items'])
            ->where('user_id', $marketer->id)
            ->where('customer_id', $customer->id)
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.marketers.customers.invoices.index', compact('invoices', 'marketer', 'customer'));
    }

    public function createForAdmin(User $marketer, Customer $customer)
    {
        $products = Product::all();
        return view('admin.marketers.customers.invoices.create', compact('marketer', 'customer', 'products'));
    }

    public function storeForAdmin(Request $request, User $marketer, Customer $customer)
    {
        $request->validate([
            'invoice_date'        => 'required|date',
            'items'               => 'required|array|min:1',
            'items.*.product_id'  => 'required|exists:products,id',
            'items.*.quantity'    => 'required|integer|min:1',
            'items.*.unit_price'  => 'required|numeric|min:0',
            'description'         => 'nullable|string',
        ]);

        $data = [
            'user_id'        => $marketer->id,
            'customer_id'    => $customer->id,
            'invoice_date'   => $request->input('invoice_date'),
            'description'    => $request->input('description'),
        ];

        $items = collect($request->input('items'))->map(function($item) {
            $item['sub_total'] = $item['quantity'] * $item['unit_price'];
            return $item;
        })->toArray();

        $total = collect($items)->sum('sub_total');

        DB::transaction(function() use ($data, $items, $total) {
            $invoice = Invoice::create(array_merge($data, [
                'total_amount' => $total,
            ]));
            $invoice->items()->createMany($items);
        });

        return redirect()
            ->route('admin.marketers.invoices.index', ['marketer' => $marketer->id, 'customer' => $customer->id])
            ->with('success', 'فاکتور با موفقیت ثبت شد.');
    }

    public function showByAdmin(User $marketer, Customer $customer, Invoice $invoice)
    {
        $invoice->load(['customer', 'items.product']);
        return view('admin.marketers.customers.invoices.show', compact('invoice', 'marketer'));
    }

    public function editByAdmin(User $marketer, Customer $customer, Invoice $invoice)
    {
        $products = Product::all();
        $invoice->load('items');
        return view('admin.marketers.customers.invoices.edit', compact('invoice', 'marketer', 'products'));
    }

    public function updateByAdmin(Request $request, User $marketer, Customer $customer, Invoice $invoice)
    {
        $request->validate([
            // 'customer_id' => 'required|exists:customers,id',
            'invoice_date'      => 'required|date',
            'items'             => 'required|array|min:1',
            'items.*.product_id'=> 'required|exists:products,id',
            'items.*.quantity'  => 'required|integer|min:1',
            'items.*.unit_price'=> 'required|numeric|min:0',
            'description'       => 'nullable|string',
        ]);

        $data = [
            'customer_id'  => $customer->id,
            'invoice_date' => $request->invoice_date,
            'description'  => $request->description,
            ];

            $items = collect($request->input('items'))->map(function($item) {
            $item['sub_total'] = $item['quantity'] * $item['unit_price'];
            return $item;
        })->toArray();

        $total = collect($items)->sum('sub_total');

        DB::transaction(function() use ($invoice, $data, $items, $total) {
            $invoice->items()->delete();
            $invoice->update(array_merge($data, [
                'total_amount' => $total,
            ]));
            $invoice->items()->createMany($items);
        });

        return redirect()
            ->route('admin.marketers.invoices.index', ['marketer' => $marketer->id, 'customer'=> $customer->id])
            ->with('success', 'فاکتور با موفقیت بروزرسانی شد.');
    }

    public function destroyByAdmin(User $marketer, Customer $customer, Invoice $invoice)
    {
        $invoice->delete();
        return redirect()
            ->route('admin.marketers.invoices.index', ['marketer' => $marketer->id, 'customer'=> $customer->id])
            ->with('success', 'فاکتور با موفقیت حذف شد.');
    }
}
