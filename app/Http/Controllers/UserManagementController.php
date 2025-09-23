<?php
namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        $managers = User::role('Manager')->with('User')->get();
        return view('admin.users.index', compact('managers'));
    }

    // --- مدیر ---
    public function createManager()
    {
        return view('admin.users.create-manager');
    }

    public function storeManager(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^09\d{9}$/|unique:users,phone',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'manager_id' => "1", // اینجا درست مقداردهی میشه
        ]);

        $user->assignRole('Manager');

        return redirect()->route('admin.users.index')->with('success', 'مدیر با موفقیت ایجاد شد.');
    }

    public function editManager(User $manager)
    {
        return view('admin.users.edit-manager', compact('manager'));
    }

    public function updateManager(Request $request, User $manager)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                'required','string','regex:/^09\d{9}$/',
                Rule::unique('users','phone')->ignore($manager->id),
            ],
        ]);

        $manager->update($request->only('name','phone'));

        return redirect()->route('admin.users.index')->with('success', 'اطلاعات مدیر بروزرسانی شد.');
    }

    public function destroyManager(User $manager)
    {
        $manager->delete();
        return redirect()->route('admin.users.index')->with('success', 'مدیر حذف شد.');
    }

    // --- کارمند ---
    public function createEmployee(User $manager)
    {
        return view('admin.users.create-employee', compact('manager'));
    }

    public function storeEmployee(Request $request, User $manager)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^09\d{9}$/|unique:users,phone',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'manager_id' => $manager->id, // اتصال به مدیر
        ]);

        $user->assignRole('User');

        return redirect()->route('admin.users.index')->with('success', 'کارمند با موفقیت ایجاد شد.');
    }

    public function editEmployee(User $employee)
    {
        return view('admin.users.edit-employee', compact('employee'));
    }

    public function updateEmployee(Request $request, User $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                'required','string','regex:/^09\d{9}$/',
                Rule::unique('users','phone')->ignore($employee->id),
            ],
        ]);

        $employee->update($request->only('name','phone'));

        return redirect()->route('admin.users.index')->with('success', 'اطلاعات کارمند بروزرسانی شد.');
    }

    public function destroyEmployee(User $employee)
    {
        $employee->delete();
        return redirect()->route('admin.users.index')->with('success', 'کارمند حذف شد.');
    }
}
