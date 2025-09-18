<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(20);

        // لاگ مشاهده لیست محصولات
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['action' => 'view_list'])
            ->log('مشاهده لیست محصولات');

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // لاگ مشاهده فرم ایجاد محصول
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['action' => 'view_create_form'])
            ->log('مشاهده فرم ایجاد محصول');

        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::create($data);

        // لاگ ایجاد محصول
        activity()
            ->causedBy(auth()->user())
            ->performedOn($product)
            ->withProperties(['new' => $data])
            ->log('ایجاد محصول جدید');

        return redirect()->route('admin.products.index')->with('success', 'محصول با موفقیت اضافه شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // لاگ مشاهده محصول
        activity()
            ->causedBy(auth()->user())
            ->performedOn($product)
            ->withProperties(['action' => 'view'])
            ->log('مشاهده محصول');

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // لاگ مشاهده فرم ویرایش محصول
        activity()
            ->causedBy(auth()->user())
            ->performedOn($product)
            ->withProperties(['action' => 'view_edit_form'])
            ->log('مشاهده فرم ویرایش محصول');

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $oldData = $product->getOriginal();

        $product->update($data);

        // لاگ ویرایش محصول
        activity()
            ->causedBy(auth()->user())
            ->performedOn($product)
            ->withProperties(['old' => $oldData, 'new' => $data])
            ->log('ویرایش محصول');

        return redirect()->route('admin.products.index')
            ->with('success', 'محصول با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // لاگ حذف محصول
        activity()
            ->causedBy(auth()->user())
            ->performedOn($product)
            ->withProperties(['action' => 'delete'])
            ->log('حذف محصول');

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'محصول با موفقیت حذف شد.');
    }
}
