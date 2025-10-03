<?php
namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Hekmatinasser\Verta\Verta;
use App\Models\Notification;
  use Kavenegar\KavenegarApi;
use Illuminate\Support\Facades\Http;
class LeaveController extends Controller
{
    public function index()
{
    $user = Auth::user();

    if (Auth::user()->hasRole('Admin')) {
        // ادمین همه مرخصی‌ها رو می‌بینه
        $leaves = Leave::latest()->paginate(15);

    } elseif (Auth::user()->hasRole(roles: 'Manager')) {
        // مدیر فقط مرخصی‌هایی که به اون ارجاع داده شدن رو می‌بینه
        $leaves = Leave::where('manager_id', $user->id)
                       ->latest()
                       ->paginate(15);

    } elseif (Auth::user()->hasRole('Accountant')) {
        // حسابداری مرخصی‌هایی که مدیر تایید کرده رو می‌بینه
         $leaves = Leave::latest()->paginate(15);


    }  else if(Auth::user()->hasRole('User') ) {
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






public function store(Request $request)
{
    $start_date = Verta::parse($request->start_date)->datetime();
    $end_date   = Verta::parse($request->end_date)->datetime();
    $user = auth()->user();

    $leave = Leave::create([
        'user_id'    => $user->id,
        'leave_type' => $request->leave_type,
        'start_date' => $start_date,
        'end_date'   => $end_date,
        'start_time' => $request->start_time,
        'end_time'   => $request->end_time,
        'reason'     => $request->reason,
        'manager_id' => $user->manager_id,
        'status'     => 'pending',
    ]);

    if ($user->hasRole('Manager')) {
        $leave->update([
            'status'     => 'manager_approved',
            'manager_id' => $user->id,
        ]);
    }

    $allIds = User::role(['Admin','Accountant','Manager'])->pluck('id')->toArray();
    $allIds = array_unique($allIds);

    $message = "یک درخواست مرخصی جدید از طرف {$user->name} ثبت شد.";
    $title = "درخواست مرخصی جدید" ;

    foreach ($allIds as $id) {
        Notification::create([
            'user_id' => $id,
            'title' => $title,
            'message' => $message,
            'seen' => false,
        ]);
    }

    $manager = $user->manager;

$phones = User::role('InternalManager')   // همه کاربران با نقش InternalManager
    ->pluck('phone')                       // فقط شماره تلفن‌ها
    ->filter()                             // حذف مقادیر null یا خالی
    ->unique()                             // حذف شماره‌های تکراری
    ->values()
    ->toArray();

    $managerPhone = $manager->phone; // فرض می‌کنیم ستون شماره تلفن phone است
    $managerId = $manager->id;

    $apiKey = '7867584376656655436E6279396C6148302B41774F317A7359486B76634C74324276584C356964677049413D';
    $template = 'req';
$token = "."; // تبدیل متن به فرمت مناسب URL

 
foreach ($phones as $phone) {
   

    $response = Http::get("https://api.kavenegar.com/v1/{$apiKey}/verify/lookup.json", [
        'receptor' => $phone,
        'token'    =>$token ,
        'template' => $template,
    ]);
  

    $results[] = [
        'phone'    => $phone,
        'token'    => $token ,
        'response' => $response->json(),
    ];
}
    $response = Http::get("https://api.kavenegar.com/v1/{$apiKey}/verify/lookup.json", [
        'receptor' => $managerPhone,
        'token'    => $token ,
        'template' => $template,
    ]);
    return redirect()->route('leaves')->with('success', 'درخواست مرخصی ثبت شد و پیامک ارسال گردید.');
}
public function approve(Leave $leave)
{
    $user = auth()->user();

    if ($user->hasRole('Manager') && $leave->status === 'pending' && $leave->manager_id == $user->id) {
        $leave->update(['status' => 'manager_approved', 'manager_id' => $user->id]);
    } elseif (($user->hasRole('Admin') || $user->hasRole('internalManager')) && $leave->status === 'manager_approved') {
        $leave->update(['status' => 'internal_approved', 'super_manager_id' => $user->id]);
    } elseif ($user->hasRole('Accountant') && $leave->status === 'internal_approved') {
        $leave->update(['status' => 'final_approved', 'accountant_id' => $user->id]);
    } else {
        abort(403, 'شما مجوز تایید این مرخصی را ندارید.');
    }

    return back()->with('success', 'مرخصی تأیید شد.');
}

public function reject(Leave $leave)
{
    $user = auth()->user();

    if ($user->hasRole('Manager') && $leave->status === 'pending') {
        $leave->update(['status' => 'manager_rejected', 'manager_id' => $user->id]);
    } elseif (($user->hasRole('Admin') || $user->hasRole('internalManager')) && $leave->status === 'manager_approved') {
        $leave->update(['status' => 'internal_rejected', 'super_manager_id' => $user->id]);
    } elseif ($user->hasRole('Accountant') && $leave->status === 'internal_approved') {
        $leave->update(['status' => 'accounting_rejected', 'accountant_id' => $user->id]);
    } else {
        abort(403, 'شما مجوز رد این مرخصی را ندارید.');
    }

    return back()->with('error', 'مرخصی رد شد.');
}




}
