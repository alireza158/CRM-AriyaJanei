<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerNote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class CustomerNotesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin|Marketer']);
    }

    /**
     * Display a listing of the resource.
     */
   public function index(User $marketer, Customer $customer)
{
    // ✅ ذخیره مسیر قبلی اگر از لیست مشتریان اومده
    if (url()->previous() && !str_contains(url()->previous(), 'notes')) {
        session(['customers_previous_url' => url()->previous()]);
    }

    if (Auth::user()->hasrole('Admin')) {
        if ($customer->user_id !== $marketer->id) abort(403);

        $view = 'admin.marketers.customers.notes.index';
        $notes = $customer->notes()->latest('created_at')->paginate(15);
        return view($view, compact('customer', 'marketer', 'notes'));
    }

    if (Auth::user()->hasrole('Marketer')) {
      

        $view = 'marketer.customers.notes.index';
        $notes = $customer->notes()->latest('created_at')->paginate(15);
        return view($view, compact('customer', 'notes'));
    }

    abort(403);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(User $marketer, Customer $customer)
    {
        if (Auth::user()->hasrole('Admin')) {
         

            return view('admin.marketers.customers.notes.create', compact('customer', 'marketer'));
        }

        if (Auth::user()->hasrole('Marketer')) {
         

            return view('marketer.customers.notes.create', compact('customer'));
        }

        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            // اگر لازم است می‌توانید بررسی کنید مشتری به کدام مارکتر تعلق دارد
            $note = $customer->notes()->create([
                'user_id' => $user->id, // یا مارکتر مشخصی
                'content' => $data['content'],
            ]);

            activity()
                ->causedBy($user)
                ->performedOn($note)
                ->withProperties(['customer_id' => $customer->id])
                ->log('ایجاد یادداشت توسط ادمین');

            return response()->json([
                'success' => true,
                'note' => [
                    'id' => $note->id,
                    'content' => $note->content,
                    'creator' => $user->name,
                    'created_at' => $note->created_at->format('Y-m-d H:i')
                ]
            ]);
            return redirect()->route('admin.marketers.customers.notes.index', ['customer' => $customer, 'marketer' => $marketer])
            ->with('success', 'یادداشت جدید با موفقیت افزوده شد');
        }

        if ($user->hasRole('Marketer')) {
          

            $note = $customer->notes()->create([
                'user_id' => $user->id,
                'content' => $data['content'],
            ]);

            activity()
                ->causedBy($user)
                ->performedOn($note)
                ->withProperties(['customer_id' => $customer->id])
                ->log('ایجاد یادداشت توسط بازاریاب');


            return redirect()->route('marketer.customer.notes.index', ['customer' => $customer])
            ->with('success', 'یادداشت جدید با موفقیت افزوده شد');
        }

        abort(403);
    }
 public function store2(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            // اگر لازم است می‌توانید بررسی کنید مشتری به کدام مارکتر تعلق دارد
            $note = $customer->notes()->create([
                'user_id' => $user->id, // یا مارکتر مشخصی
                'content' => $data['content'],
            ]);

            activity()
                ->causedBy($user)
                ->performedOn($note)
                ->withProperties(['customer_id' => $customer->id])
                ->log('ایجاد یادداشت توسط ادمین');

            return response()->json([
                'success' => true,
                'note' => [
                    'id' => $note->id,
                    'content' => $note->content,
                    'creator' => $user->name,
                    'created_at' => $note->created_at->format('Y-m-d H:i')
                ]
            ]);
            return redirect()->route('admin.marketers.customers.notes.index', ['customer' => $customer, 'marketer' => $marketer])
            ->with('success', 'یادداشت جدید با موفقیت افزوده شد');
        }

        if ($user->hasRole('Marketer')) {
          

            $note = $customer->notes()->create([
                'user_id' => $user->id,
                'content' => $data['content'],
            ]);

            activity()
                ->causedBy($user)
                ->performedOn($note)
                ->withProperties(['customer_id' => $customer->id])
                ->log('ایجاد یادداشت توسط بازاریاب');

 return response()->json([
                'success' => true,
                'note' => [
                    'id' => $note->id,
                    'content' => $note->content,
                    'creator' => $user->name,
                    'created_at' => $note->created_at->format('Y-m-d H:i')
                ]
            ]);
        }

        abort(403);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $marketer, Customer $customer, CustomerNote $note)
    {
        if (Auth::user()->hasrole('Admin')) {
            if ($customer->user_id !== $marketer->id) abort(403);

            return view('admin.marketers.customers.notes.show', compact('customer', 'marketer', 'note'));
        }

        if (Auth::user()->hasrole('Marketer')) {
            if ($customer->user_id !== Auth::id()) abort(403);

            return view('marketer.customers.notes.show', compact('customer', 'note'));
        }

        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $marketer, Customer $customer, CustomerNote $note)
    {
        if (Auth::user()->hasrole('Admin')) {
            if ($customer->user_id !== $marketer->id) abort(403);

            return view('admin.marketers.customers.notes.edit', compact('customer', 'marketer', 'note'));
        }

        if (Auth::user()->hasrole('Marketer')) {
            if ($customer->user_id !== Auth::id()) abort(403);

            return view('marketer.customers.notes.edit', compact('customer', 'note'));
        }

        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $marketer, Customer $customer, CustomerNote $note)
    {
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        if (Auth::user()->hasRole('Admin')) {
           // if ($customer->user_id !== $marketer->id) abort(403);

            $oldData = $note->getOriginal();

            $note->update([
                'user_id' => $marketer->id,
                'content' => $data['content'],
            ]);

            activity()
                ->causedBy(Auth::user())
                ->performedOn($note)
                ->withProperties(['old' => $oldData, 'new' => $data, 'customer_id' => $customer->id])
                ->log('ویرایش یادداشت توسط ادمین');

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'content' => $note->content
                ]);
            }

            return redirect()->route('admin.marketers.customers.notes.index', ['customer' => $customer, 'marketer' => $marketer])
                             ->with('success', 'یادداشت با موفقیت بروزرسانی شد');
        }

        if (Auth::user()->hasRole('Marketer')) {
            if ($customer->user_id !== Auth::id()) abort(403);

            $oldData = $note->getOriginal();

            $note->update([
                'user_id' => Auth::id(),
                'content' => $data['content'],
            ]);

            activity()
                ->causedBy(Auth::user())
                ->performedOn($note)
                ->withProperties(['old' => $oldData, 'new' => $data, 'customer_id' => $customer->id])
                ->log('ویرایش یادداشت توسط بازاریاب');

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'content' => $note->content
                ]);
            }

            return redirect()->route('marketer.customer.notes.index', ['customer' => $customer])
                             ->with('success', 'یادداشت با موفقیت بروزرسانی شد');
        }

        abort(403);
    }


    /**
     * Remove the specified resource from storage.
     */

     public function destroy(User $marketer, Customer $customer, CustomerNote $note)
{
    if (Auth::user()->hasRole('Admin')) {
        if ($customer->user_id !== $marketer->id) abort(403);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($note)
            ->withProperties(['customer_id' => $customer->id])
            ->log('حذف یادداشت توسط ادمین');

        $note->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('admin.marketers.customers.notes.index', ['customer' => $customer, 'marketer' => $marketer]);
    }

    if (Auth::user()->hasRole('Marketer')) {
        if ($customer->user_id !== Auth::id()) abort(403);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($note)
            ->withProperties(['customer_id' => $customer->id])
            ->log('حذف یادداشت توسط بازاریاب');

        $note->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('marketer.customer.notes.index', ['customer' => $customer]);
    }

    abort(403);
}


}
