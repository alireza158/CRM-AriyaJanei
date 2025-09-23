<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Marketer|User');
    }
    public function indexForManager()
    {
        $manager = auth()->user();

        // اطمینان از اینکه واقعا مدیر است


        // گرفتن گزارش‌های تمام کارمندانی که manager_id = id همین مدیر هست
        $reports = Report::whereIn('user_id', function ($query) use ($manager) {
            $query->select('id')
                  ->from('users')
                  ->where('manager_id', $manager->id);
        })->with('user')->latest()->paginate(15);

        return view('user.reports.index', compact('reports'));
    }

    public function index(User $user)
    {
        if (Auth::user()->hasRole('Admin')) {
            $reports = Report::where('user_id', $user->id)
                ->whereIn('status', [Report::STATUS_SUBMITTED, Report::STATUS_READ])
                ->orderBy('created_at', 'desc')
                ->paginate(15);
            $view = $user->hasRole('Marketer') ? 'admin.marketers.reports.index' : 'admin.guests.reports.index';

            activity()
                ->causedBy(Auth::user())
                ->withProperties(['user_id' => $user->id, 'action' => 'view_list'])
                ->log('مشاهده لیست گزارش‌ها');

            return view($view, compact('user', 'reports'));
        }



        $authUser = Auth::user();
        $view = $authUser->hasRole('Marketer') ? 'marketer.reports.index' : 'user.reports.index';
        $reports = Report::where('user_id', $authUser->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        activity()
            ->causedBy($authUser)
            ->withProperties(['user_id' => $authUser->id, 'action' => 'view_list'])
            ->log('مشاهده لیست گزارش‌ها');

        return view($view, compact('reports'));
    }

    public function feedback(Request $request, Report $report, User $user)
    {
        if (!Auth::user()->hasRole('Admin')) abort(403);

        if (!in_array($report->status, [Report::STATUS_SUBMITTED, Report::STATUS_READ])) {
            abort(404);
        }

        $data = $request->validate([
            'feedback' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $oldData = $report->getOriginal();
        $report->update($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties(['old' => $oldData, 'new' => $data])
            ->log('ثبت بازخورد برای گزارش');

        return redirect()->route('admin.reports.show', [$report, $user])
            ->with('success', 'بازخورد و امتیاز با موفقیت ذخیره شد.');
    }

    public function create(User $user)
    {
        $authUser = Auth::user();

        $view = $authUser->hasRole('Admin') ? 'admin.reports.create' :
            ($authUser->hasRole('Marketer') ? 'marketer.reports.create' : 'user.reports.create');

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
        $userId = $authUser->hasRole('Admin') ? $user->id : $authUser->id;

        $data['submitted_at']= now();
        $data['user_id'] = $userId;
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

        $route = $authUser->hasRole('Admin') ? 'admin.reports.index' :
            ($authUser->hasRole('Marketer') ? 'marketer.reports.index' : 'user.reports.index');

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

        $route = $authUser->hasRole('Marketer') ? 'marketer.reports.index' : 'user.reports.index';

        return redirect()->route($route, $report)
            ->with('success', 'گزارش ارسال شد.');
    }

    public function show(Report $report, User $user = null)
    {
        $authUser = Auth::user();
        if ($authUser->hasRole('Admin')) {
            if (!in_array($report->status, [Report::STATUS_SUBMITTED, Report::STATUS_READ])) abort(404);
            if ($report->status === Report::STATUS_SUBMITTED) $report->markAsRead();

            activity()
                ->causedBy($authUser)
                ->performedOn($report)
                ->withProperties(['action' => 'view'])
                ->log('مشاهده گزارش توسط ادمین');

            return view('admin.reports.show', compact('report', 'user'));
        }

        $report = Report::where('user_id', $authUser->id)->where('id', $report->id)->firstOrFail();

        activity()
            ->causedBy($authUser)
            ->performedOn($report)
            ->withProperties(['action' => 'view'])
            ->log('مشاهده گزارش');

        return view('reports.show', compact('report'));
    }

    public function edit(Report $report, User $user = null)
    {
        $authUser = Auth::user();

        $report = $authUser->hasRole('Admin') ? Report::where('user_id', $user->id)->where('id', $report->id)->firstOrFail()
            : Report::where('user_id', $authUser->id)->where('id', $report->id)->firstOrFail();

        $view = $authUser->hasRole('Admin') ? 'admin.reports.edit' :
            ($authUser->hasRole('Marketer') ? 'marketer.reports.edit' : 'user.reports.edit');

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
        $route = $authUser->hasRole('Admin') ? 'admin.reports.index' :
            ($authUser->hasRole('Marketer') ? 'marketer.reports.index' : 'user.reports.index');

        $oldData = $report->getOriginal();
        $report->update($data);

        activity()
            ->causedBy($authUser)
            ->performedOn($report)
            ->withProperties(['old' => $oldData, 'new' => $report->toArray()])
            ->log('ویرایش گزارش');

        $userId = $authUser->hasRole('Admin') ? $user->id : $authUser->id;
        return redirect()->route($route, $userId);
    }

    public function destroy(Report $report, User $user = null)
    {
        $authUser = Auth::user();
        $route = $authUser->hasRole('Admin') ? 'admin.reports.index' :
            ($authUser->hasRole('Marketer') ? 'marketer.reports.index' : 'user.reports.index');

        activity()
            ->causedBy($authUser)
            ->performedOn($report)
            ->withProperties(['action' => 'delete'])
            ->log('حذف گزارش');

        $report->delete();

        return redirect()->route($route, $authUser->hasRole('Admin') ? $user->id : null);
    }
}
