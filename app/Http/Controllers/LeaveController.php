<?php
namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Hekmatinasser\Verta\Verta;
class LeaveController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if ($user->role === 'admin') {
        // ادمین همه مرخصی‌ها رو می‌بینه
        $leaves = Leave::latest()->paginate(15);

    } elseif ($user->role === 'manager') {
        // مدیر فقط مرخصی‌هایی که به اون ارجاع داده شدن رو می‌بینه
        $leaves = Leave::where('manager_id', $user->id)
                       ->latest()
                       ->paginate(15);

    } elseif ($user->role === 'accountant') {
        // حسابداری مرخصی‌هایی که مدیر تایید کرده رو می‌بینه
        $leaves = Leave::where('status', 'manager_approved')
                       ->latest()
                       ->paginate(15);

    }  else if($user->role === 'user') {
        // کارمند فقط مرخصی‌های خودش رو می‌بینه
        $leaves = Leave::where('user_id', $user->id)
                       ->latest()
                       ->paginate(15);
    }else if($user->role === 'internalManager') {
        // کارمند فقط مرخصی‌های خودش رو می‌بینه
        $leaves = Leave::where('user_id', $user->id)
                       ->latest()
                       ->paginate(15);
    }

    return view('leaves.index', compact('leaves'));
}


    public function create() {
        return view('leaves.create');
    }



    public function edit(Leave $leave) {
        $this->authorize('update', $leave);
        return view('leaves.edit', compact('leave'));
    }

    public function update(Request $request, Leave $leave) {
        $this->authorize('update', $leave);

        $data = $request->validate([
            'type' => 'required|in:استحقاقی,بدون حقوق,ساعتی',
            'start_date' => 'required|date',
            'start_time' => 'nullable|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'nullable|date_format:H:i',
            'description' => 'nullable|string',
        ]);

        $leave->update($data);

        return redirect()->route('leaves')->with('success','مرخصی به‌روزرسانی شد.');
    }

    public function destroy(Leave $leave) {
        $this->authorize('delete', $leave);
        $leave->delete();
        return redirect()->route('leaves')->with('success','مرخصی حذف شد.');
    }


    public function store(Request $request)
    {
        $start_date = Verta::parse($request->start_date)->datetime();
        $end_date   = Verta::parse($request->end_date)->datetime();
        $user = auth()->user();
        Leave::create([
            'user_id' => auth()->id(),
            'leave_type' => $request->leave_type,
            'start_date' =>  $start_date,
            'end_date' =>  $end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'reason' => $request->reason,
            'manager_id' => $user->manager_id,
        ]);

        return redirect()->route('leaves')->with('success', 'درخواست مرخصی ثبت شد.');
    }

    public function approve(Leave $leave)
    {
        $user = auth()->user();

        if ($user->isRole('manager') && $leave->status === 'pending') {
            $leave->update([
                'manager_id' => $user->id,
                'status' => 'manager_approved',
            ]);
        }

        if ($user->isRole('accountant') && $leave->status === 'manager_approved') {
            $leave->update([
                'accountant_id' => $user->id,
                'status' => 'accounting_approved',
            ]);
        }

        if ($user->isRole('internalManager') && $leave->status === 'accounting_approved') {
            $leave->update([
                'super_manager_id' => $user->id,
                'status' => 'final_approved',
            ]);
        }
        if ($user->isRole('admin') && $leave->status === 'accounting_approved') {
            $leave->update([
                'super_manager_id' => $user->id,
                'status' => 'final_approved',
            ]);
        }
        return back()->with('success', 'مرخصی تأیید شد.');
    }

    public function reject(Leave $leave)
    {
        $user = auth()->user();

        if ($user->isRole('manager') && $leave->status === 'pending') {
            $leave->update([
                'manager_id' => $user->id,
                'status' => 'manager_rejected',
            ]);
        }

        if ($user->isRole('accountant') && $leave->status === 'manager_approved') {
            $leave->update([
                'accountant_id' => $user->id,
                'status' => 'accounting_rejected',
            ]);
        }

        if ($user->isRole('internalManager') && $leave->status === 'accounting_approved') {
            $leave->update([
                'super_manager_id' => $user->id,
                'status' => 'final_rejected',
            ]);
        }
        if ($user->isRole('admin') && $leave->status === 'accounting_approved') {
            $leave->update([
                'super_manager_id' => $user->id,
                'status' => 'final_rejected',
            ]);
        }

        return back()->with('error', 'مرخصی رد شد.');
    }


}
