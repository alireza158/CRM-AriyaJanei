<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Marketer|User|Manager');
    }


    public function index(User $user)
    {
       /* if (Auth::user()->hasRole('Admin')) {
            $reports = Report::where('user_id', $user->id)
                ->whereIn('status', [Report::STATUS_SUBMITTED, Report::STATUS_READ])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            $view = $user->hasRole('Marketer') ? 'admin.marketers.reports.index' : 'user.reports.reportsManagment';

            activity()
                ->causedBy(Auth::user())
                ->withProperties(['user_id' => $user->id, 'action' => 'view_list'])
                ->log('مشاهده لیست گزارش‌ها');

            return view($view, compact('user', 'reports'));
        }*/




        $authUser = Auth::user();
        $view = $authUser->hasRole('Marketer') ? 'user.reports.index' : 'user.reports.index';
        $reports = Report::where('user_id', $authUser->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        activity()
            ->causedBy($authUser)
            ->withProperties(['user_id' => $authUser->id, 'action' => 'view_list'])
            ->log('مشاهده لیست گزارش‌ها');

        return view($view, compact('reports'));
    }
    public function reportsManagment(User $user)
    {
         if (Auth::user()->hasRole('Admin')) {
    // همه گزارش‌ها بدون فیلتر user_id
    $reports = Report::whereIn('status', [Report::STATUS_SUBMITTED, Report::STATUS_READ])
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    $view = 'user.reports.reportsManagment'; // یا ویوی دلخواه برای ادمین

    activity()
        ->causedBy(Auth::user())
        ->withProperties(['action' => 'view_list'])
        ->log('مشاهده لیست تمامی گزارش‌ها');

    return view($view, compact('reports'));
}



     $manager = auth()->user();



    // همه گزارش‌های کارمندانی که manager_id = id مدیر
    $reports = Report::whereHas('user', function ($query) use ($manager) {
        $query->where('manager_id', $manager->id);
    })->with('user')->latest()->paginate(15);

    return view('user.reports.reportsManagment', compact('reports'));
    }
    public function feedback(Request $request, Report $report)
    {
        if (!in_array($report->status, [Report::STATUS_SUBMITTED, Report::STATUS_READ])) {
            abort(404);
        }

        $data = $request->validate([
            'feedback' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'voice' => 'nullable|string', // base64
        ]);

        if ($request->voice) {
            $voiceData = explode(',', $request->voice);
            $voiceBinary = base64_decode($voiceData[1]);
            $fileName = 'voices/' . uniqid() . '.mp3';
            Storage::disk('public')->put($fileName, $voiceBinary);
            $data['voice_path'] = $fileName;
        }

        $oldData = $report->getOriginal();
        $report->update($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties(['old' => $oldData, 'new' => $data])
            ->log('ثبت بازخورد برای گزارش');

        Notification::create([
            'user_id' => $report->user_id,
            'title' => "بازخورد جدید",
            'message' => $report->feedback,
            'seen' => false,
        ]);

        return back()->with('success', 'بازخورد و ویس با موفقیت ذخیره شد.');
    }



    public function create(User $user)
    {
        $authUser = Auth::user();

        $view = $authUser->hasRole('Admin') ? 'user.reports.create' :
            ($authUser->hasRole('Marketer') ? 'user.reports.create' : 'user.reports.create');

        activity()
            ->causedBy($authUser)
            ->withProperties(['action' => 'view_create_form'])
            ->log('مشاهده فرم ایجاد گزارش');

        return view($view, $authUser->hasRole('Admin') ? compact('user') : []);
    }

    public function store(Request $request, User $user)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'required|string',
            'attachments.*' => 'nullable|file|max:10240', // حداکثر 10MB
        ]);

        $authUser = Auth::user();
        $userId = $authUser->id;

        $data['submitted_at']= now();
        $data['user_id'] =  $authUser->id;
        $data['status'] = Report::STATUS_SUBMITTED;

        $report = Report::create($data);

        // ذخیره فایل‌ها
        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {
                $path = $file->store('report_attachments', 'public');
                $report->attachments()->create([
                    'file_path' => $path,
                    'type' => $file->getClientMimeType(),
                ]);
            }
        }

        activity()
            ->causedBy($authUser)
            ->performedOn($report)
            ->withProperties(['new' => $data])
            ->log('ارسال گزارش با فایل');

       if(  $authUser ->hasRole('Marketer')){
  $route = $authUser->hasRole('Marketer') ? 'user.reports.index' : 'user.reports.index';
}elseif(  $authUser ->hasRole('Manager')){
    $route = 'user.reports.index';
}else{
     $route = 'user.reports.index';
}

$allIds = [];
$Ids = User::role(['Admin','Manager'])->pluck('id')->toArray();
$allIds = array_merge($allIds, $Ids);

$allIds = array_unique($allIds);
$message = "گزارش کار جدید ثبت شده است." ;
$title="گزارش کار جدید" ;

foreach ($allIds as $id) {
    Notification::create([
        'user_id' => $id,
        'title' => $title,
        'message' => $message,
        'seen' => false,
    ]);
}

        return redirect()->route($route, $userId)
            ->with('success', 'گزارش با موفقیت ثبت شد.');
    }

    public function submit(Report $report)
    {
        $authUser = Auth::user();
        if ($authUser->id !== $report->user_id) abort(403);

        if ($report->status === Report::STATUS_SUBMITTED) {
            return redirect()->back()->with('error', 'این گزارش قبلا ارسال شده است.');
        }

        $oldData = $report->getOriginal();
        $report->status = Report::STATUS_SUBMITTED;
        $report->submitted_at = now();
        $report->save();

        activity()
            ->causedBy($authUser)
            ->performedOn($report)
            ->withProperties(['old' => $oldData, 'new' => $report->toArray()])
            ->log('ارسال گزارش');
if(  $authUser ->hasRole('Marketer')){
  $route = $authUser->hasRole('Marketer') ? 'user.reports.index' : 'user.reports.index';
}elseif(  $authUser ->hasRole('Manager')){
    $route = 'user.reports.index';
}else{
     $route = 'user.reports.index';
}


        return redirect()->route($route, $report)
            ->with('success', 'گزارش ارسال شد.');
    }

   public function show(Report $report, User $user = null)
{
    $authUser = Auth::user();


    if ($authUser->hasRole('Admin')) {
        if (!in_array($report->status, [Report::STATUS_SUBMITTED, Report::STATUS_READ])) {
            abort(404);
        }

        if ($report->status === Report::STATUS_SUBMITTED) {
            $report->markAsRead();
        }

        activity()
            ->causedBy($authUser)
            ->performedOn($report)
            ->withProperties(['action' => 'view'])
            ->log('مشاهده گزارش توسط ادمین');

        return view('reports.show', compact('report', 'user'));
    }

    // اگر مدیر باشه، اجازه دیدن گزارش‌های کارمندهاش رو هم داشته باشه
    if ($authUser->hasRole('Manager')) {
        $isEmployeeReport = $report->user && $report->user->manager_id == $authUser->id;


    }

    activity()
        ->causedBy($authUser)
        ->performedOn($report)
        ->withProperties(['action' => 'view'])
        ->log('مشاهده گزارش');

    return view('user.reports.show', compact('report',));
}


  public function edit(Report $report, User $user = null)
{
    $authUser = Auth::user();

    if ($authUser->hasRole('Admin')) {
        if ($user) {
        $report = Report::where('user_id', $user->id)->where('id', $report->id)->firstOrFail();
    } else {
        // ادمین همه گزارش‌ها میتونه ببینه
        $report = Report::where('id', $report->id)->firstOrFail();
    }
    } elseif ($authUser->hasRole('Manager')) {
        // فقط گزارش کارمندهای خودش
        $report = Report::where('id', $report->id)

            ->firstOrFail();
    } else {
        // کاربر یا مارکتر فقط گزارش خودش
        $report = Report::where('user_id', $authUser->id)->where('id', $report->id)->firstOrFail();
    }

    $view = $authUser->hasRole('Admin') ? 'user.reports.edit'
        : ($authUser->hasRole('Manager') ? 'user.reports.edit'
        : ($authUser->hasRole('Marketer') ? 'user.reports.edit' : 'user.reports.edit'));

    activity()
        ->causedBy($authUser)
        ->performedOn($report)
        ->withProperties(['action' => 'view_edit_form'])
        ->log('مشاهده فرم ویرایش گزارش');

    return view($view, $authUser->hasRole('Admin') ? compact('report', 'user') : compact('report'));
}

public function update(Request $request, Report $report, User $user = null)
{
    $data = $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'required|string',
    ]);

    $authUser = Auth::user();

    if ($authUser->hasRole('Admin')) {
        $report = Report::where('id', $report->id)->firstOrFail();
    } elseif ($authUser->hasRole('Manager')) {
        $report = Report::where('id', $report->id)

            ->firstOrFail();
    } else {
        $report = Report::where('user_id', $authUser->id)->where('id', $report->id)->firstOrFail();
    }

    $oldData = $report->getOriginal();
    $report->update($data);

    activity()
        ->causedBy($authUser)
        ->performedOn($report)
        ->withProperties(['old' => $oldData, 'new' => $report->toArray()])
        ->log('ویرایش گزارش');

    // ✅ بعد از ویرایش به همون صفحه برگرد
    return redirect()->back()->with('success', 'گزارش با موفقیت ویرایش شد.');
}

public function destroy(Report $report, User $user = null)
{
    $authUser = Auth::user();

    if ($authUser->hasRole('Admin')) {
        $report = Report::where('id', $report->id)->firstOrFail();
    } elseif ($authUser->hasRole('Manager')) {
        $report = Report::where('id', $report->id)
            ->where(function($query) use ($authUser) {
                $query->where('user_id', $authUser->id)
                      ->orWhereIn('user_id', $authUser->employees->pluck('id'));
            })
            ->firstOrFail();
    } else {
        $report = Report::where('id', $report->id)
            ->where('user_id', $authUser->id)
            ->firstOrFail();
    }

    activity()
        ->causedBy($authUser)
        ->performedOn($report)
        ->withProperties(['action' => 'delete'])
        ->log('حذف گزارش');

    $report->delete();

    // ✅ به همون صفحه قبلی برگرد
    return redirect()->back()->with('success', 'گزارش با موفقیت حذف شد.');
}


}
