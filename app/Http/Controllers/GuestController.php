<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GuestController extends Controller
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
        $guests = User::role('Guest')->paginate(15);
        return view('admin.guests.index', compact('guests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.guests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^09\d{9}$/', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'phone.regex' => 'فرمت شماره موبایل معتبر نیست.',
            'phone.unique' => 'این شماره قبلاً استفاده شده است.',
            'password.confirmed' => 'رمز عبور و تکرار آن مطابقت ندارند.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole('Guest');

        return redirect()->route('admin.guests.index')
            ->with('success', 'کاربر مهمان با موفقیت ایجاد شد.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guest = User::findOrFail($id);
        return view('admin.guests.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guest = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => [
                'required',
                'string',
                'regex:/^09\d{9}$/',
                Rule::unique('users', 'phone')->ignore($guest->id),
            ],
        ]);
        $guest->update([
            'name' => request('name'),
            'phone' => request('phone'),
        ]);
        return redirect()->route('admin.guests.index')
            ->with('success', 'اطلاعات با موفقیت ویرایش شد.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guest = User::findOrFail($id);
        $guest->delete();
        return redirect()->route('admin.guests.index')
            ->with('success', 'کاربر حذف شد.');
    }
}
