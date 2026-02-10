<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Spatie\Activitylog\Models\Activity;

class MarketerController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Marketer');
    }

    public function index()
    {
        $marketers = User::role('Marketer')->paginate(20);
        return view('admin.marketers.index', compact('marketers'));
    }

    public function create()
    {
        return view('admin.marketers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^09\d{9}$/', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'phone.regex' => 'فرمت شماره موبایل معتبر نیست. باید با 09 شروع شود و 11 رقم باشد.',
            'phone.unique' => 'این شماره موبایل قبلاً ثبت شده است.',
            'password.confirmed' => 'رمز عبور و تکرار آن یکسان نیستند.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('Marketer');

        // لاگ ایجاد کاربر
        activity()
            ->causedBy(auth()->user())
            ->performedOn($user)
            ->withProperties(['action' => 'create'])
            ->log('ایجاد مارکتر جدید');

        return redirect()->route('admin.marketers.index')
            ->with('success', 'کاربر با موفقیت ثبت شد.');
    }

    public function edit(string $id)
    {
        $marketer = User::findOrFail($id);
        return view('admin.marketers.edit', compact('marketer'));
    }

    public function update(Request $request, string $id)
    {
        $marketer = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'string',
                'regex:/^09\d{9}$/',
                Rule::unique('users', 'phone')->ignore($marketer->id),
            ],
        ]);

        $oldData = $marketer->getOriginal();

        $marketer->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        // لاگ ویرایش کاربر
        activity()
            ->causedBy(auth()->user())
            ->performedOn($marketer)
            ->withProperties(['old' => $oldData, 'new' => $marketer->toArray()])
            ->log('ویرایش اطلاعات مارکتر');

        return redirect()->route('admin.marketers.index')
            ->with('success', 'اطلاعات با موفقیت ویرایش شد.');
    }

    public function destroy(string $id)
    {
        $marketer = User::findOrFail($id);

        // لاگ حذف کاربر
        activity()
            ->causedBy(auth()->user())
            ->performedOn($marketer)
            ->withProperties(['action' => 'delete'])
            ->log('حذف مارکتر');

        $marketer->delete();

        return redirect()->route('admin.marketers.index')
            ->with('success', 'مارکتر با موفقیت حذف شد');
    }
}
