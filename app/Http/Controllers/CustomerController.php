<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\ReferenceType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin')->only(['allNotes', 'marketers', 'customersOfMarketer']);
        $this->middleware('role:Admin|Marketer')->only([
            'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
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

        $customers = $query->paginate(15)->withQueryString();

        return view('marketer.customers.index', compact('customers'));
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

        if(!$marketerId){
            Notification::create([
                'user_id' => $marketerId,
                'title' => "شماره جدید",
                'message' => "شماره جدید ثبت شده است.",
                'seen' => false,
            ]);
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

        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'DISC'              => 'nullable|string|max:255',
            'phone'             => 'nullable|string|max:20|unique:customers,phone,' . $customer->id,
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

        // 📌 لاگ ویرایش مشتری
        activity()
            ->performedOn($customer)
            ->causedBy(auth()->user())
            ->withProperties(['data' => $data])
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
        if (Auth::user()->hasRole('Marketer') && $customer->user_id !== Auth::id()) {
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
