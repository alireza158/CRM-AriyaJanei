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
use Intervention\Image\Facades\Image;
use Morilog\Jalali\Jalalian;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Marketer|User|Manager');
    }
private function allowedReportUserIds(): array
{
    $authId = Auth::id();

    // پیشفرض: فقط گزارش‌های خود فرد
    $ids = [$authId];

    // دسترسی ویژه: کاربر 35 گزارش‌های کاربر 31 رو هم ببینه
    if ($authId == 35) {
        $ids[] = 31;
    }

    return array_values(array_unique($ids));
}

    public function index(User $user)
    {
        $authUser = Auth::user();
        $view = $authUser->hasRole('Marketer') ? 'user.reports.index' : 'user.reports.index';

       $allowedIds = $this->allowedReportUserIds();

$reports = Report::whereIn('user_id', $allowedIds)
    ->orderBy('created_at', 'desc')
    ->paginate(15);

        activity()
            ->causedBy($authUser)
            ->withProperties(['user_id' => $authUser->id, 'action' => 'view_list'])
            ->log('مشاهده لیست گزارش‌ها');

        return view($view, compact('reports'));
    }

   public function reportsManagment(Request $request)
{
    $auth = Auth::user();
    $yesterday = Carbon::yesterday();

    // این IDها کلاً در هیچ لیستی نمایش داده نشوند
    $excludedUserIds = [17, 43, 42, 32, 1, 30, 36, 26];

    $validated = $request->validate([
        'user_id'    => 'nullable|integer|exists:users,id',
        'date_from'  => 'nullable|string',
        'date_to'    => 'nullable|string',
    ]);

    $selectedUserId = isset($validated['user_id']) ? (int) $validated['user_id'] : null;
    $dateFromInput = $validated['date_from'] ?? null;
    $dateToInput = $validated['date_to'] ?? null;
    $dateFrom = $this->normalizeFilterDate($dateFromInput);
    $dateTo = $this->normalizeFilterDate($dateToInput);

    if ($dateFromInput && !$dateFrom) {
        return back()->withInput()->with('error', 'فرمت تاریخ شروع معتبر نیست.');
    }

    if ($dateToInput && !$dateTo) {
        return back()->withInput()->with('error', 'فرمت تاریخ پایان معتبر نیست.');
    }

    if ($dateFrom && $dateTo && $dateTo->lt($dateFrom)) {
        return back()->withInput()->with('error', 'تاریخ پایان باید بزرگ‌تر یا مساوی تاریخ شروع باشد.');
    }

    // =======================
    // Admin
    // =======================
    if ($auth->hasRole('Admin')) {
        $availableUsers = User::query()
            ->whereNotIn('id', $excludedUserIds)
            ->whereHas('roles', function ($q) {
                $q->whereIn('name', ['User', 'Marketer', 'Manager']);
            })
            ->orderBy('name')
            ->get(['id', 'name']);

        // کاربرانی که دیروز گزارش submitted/read ثبت نکرده‌اند (به جز excluded ها)
        $usersWithoutYesterdayReport = User::query()
            ->whereNotIn('id', $excludedUserIds)
            ->whereHas('roles', function ($q) {
                $q->whereIn('name', ['User', 'Marketer', 'Manager']);
            })
            ->whereDoesntHave('reports', function ($q) use ($yesterday) {
                $q->whereDate('submitted_at', $yesterday->toDateString())
                    ->whereIn('status', [Report::STATUS_SUBMITTED, Report::STATUS_READ]);
            })
            ->orderBy('name')
            ->get();

        // جدول گزارش‌ها (به جز excluded ها)
        $reportsQuery = Report::query()
            ->whereIn('status', [Report::STATUS_SUBMITTED, Report::STATUS_READ])
            ->whereHas('user', function ($q) use ($excludedUserIds) {
                $q->whereNotIn('id', $excludedUserIds);
            });
    } else {
        // =======================
        // Manager: فقط کارمندهای خودش
        // =======================
        $manager = $auth;

        $availableUsers = User::query()
            ->where('manager_id', $manager->id)
            ->whereNotIn('id', $excludedUserIds)
            ->orderBy('name')
            ->get(['id', 'name']);

        $usersWithoutYesterdayReport = User::query()
            ->where('manager_id', $manager->id)
            ->whereNotIn('id', $excludedUserIds)
            ->whereDoesntHave('reports', function ($q) use ($yesterday) {
                $q->whereDate('submitted_at', $yesterday->toDateString())
                    ->whereIn('status', [Report::STATUS_SUBMITTED, Report::STATUS_READ]);
            })
            ->orderBy('name')
            ->get();

        $reportsQuery = Report::query()
            ->whereIn('status', [Report::STATUS_SUBMITTED, Report::STATUS_READ])
            ->whereHas('user', function ($q) use ($manager, $excludedUserIds) {
                $q->where('manager_id', $manager->id)
                    ->whereNotIn('id', $excludedUserIds);
            });
    }

    if ($selectedUserId) {
        $reportsQuery->where('user_id', $selectedUserId);
    }

    if ($dateFrom) {
        $reportsQuery->whereDate('created_at', '>=', $dateFrom->toDateString());
    }

    if ($dateTo) {
        $reportsQuery->whereDate('created_at', '<=', $dateTo->toDateString());
    }

    $reports = $reportsQuery
        ->with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(15)
        ->withQueryString();

    return view('user.reports.reportsManagment', compact(
        'reports',
        'usersWithoutYesterdayReport',
        'availableUsers',
        'selectedUserId',
        'dateFrom',
        'dateTo'
    ));
}

private function normalizeFilterDate(?string $value): ?Carbon
{
    if (!$value) {
        return null;
    }

    $value = trim($value);
    if ($value === '') {
        return null;
    }

    // اعداد فارسی/عربی => انگلیسی
    $value = str_replace(
        ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'],
        ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
        $value
    );

    // 1404/01/10 -> 1404-01-10
    $normalized = str_replace('/', '-', $value);

    try {
        // تاریخ میلادی
        return Carbon::parse($normalized)->startOfDay();
    } catch (\Throwable $e) {
        try {
            // تاریخ شمسی
            return Jalalian::fromFormat('Y-m-d', $normalized)->toCarbon()->startOfDay();
        } catch (\Throwable $e) {
            return null;
        }
    }
}


    public function feedback(Request $request, Report $report)
    {
        if (!in_array($report->status, [Report::STATUS_SUBMITTED, Report::STATUS_READ])) {
            abort(404);
        }

        $data = $request->validate([
            'feedback'   => 'nullable|string',
            'rating'     => 'nullable|integer|min:1|max:5',
            'voice'      => 'nullable|string', // data URL (Base64)
            'voice_file' => 'nullable|file|mimetypes:audio/webm,audio/ogg,audio/mpeg,audio/mp4,audio/x-m4a,audio/wav,audio/3gpp,audio/3gpp2',
        ]);

        // 1) اگر ضبط مستقیم (Base64 data URL) آمده باشد
        if ($request->filled('voice')) {
            $dataUrl = $request->input('voice');

            if (preg_match('/^data:(audio\\/[a-zA-Z0-9.+\\-]+);base64,/', $dataUrl, $m)) {
                $mime = strtolower($m[1]);
                $base64 = substr($dataUrl, strpos($dataUrl, ',') + 1);
                $binary = base64_decode($base64);

                // پسوند مناسب بر اساس MIME
                $ext = match($mime) {
                    'audio/webm' => 'webm',
                    'audio/ogg'  => 'ogg',
                    'audio/mpeg' => 'mp3',
                    'audio/mp4', 'audio/x-m4a' => 'm4a',
                    'audio/wav'  => 'wav',
                    default      => 'webm',
                };

                $fileName = 'voices/' . uniqid('', true) . '.' . $ext;
                Storage::disk('public')->put($fileName, $binary);
                $data['voice_path'] = $fileName;
            }
        }
        // 2) در غیر این صورت اگر فایل فالبک آپلود شده باشد
        elseif ($request->hasFile('voice_file')) {
            $data['voice_path'] = $request->file('voice_file')->store('voices', 'public');
        }

        $oldData = $report->getOriginal();
        $report->update($data);

        activity()
            ->causedBy(Auth::user())
            ->performedOn($report)
            ->withProperties(['old' => $oldData, 'new' => $data])
            ->log('ثبت بازخورد برای گزارش');

       $reportTitle = $report->title ?? ('گزارش #' . $report->id);

$feedbackText = trim((string) $report->feedback);
if ($feedbackText === '') {
    $feedbackText = '— بدون متن بازخورد —';
}

Notification::create([
    'user_id' => $report->user_id,
    'title'   => "بازخورد جدید برای: {$reportTitle}",
    'message' => "بازخورد ثبت‌شده: {$feedbackText}",
    'seen'    => false,
]);


        return back()->with('success', 'بازخورد و ویس با موفقیت ذخیره شد.');
    }

    public function create(User $user)
    {
        $authUser = Auth::user();

        $view = $authUser->hasRole('Admin') ? 'user.reports.create'
            : ($authUser->hasRole('Marketer') ? 'user.reports.create' : 'user.reports.create');

        activity()
            ->causedBy($authUser)
            ->withProperties(['action' => 'view_create_form'])
            ->log('مشاهده فرم ایجاد گزارش');

        return view($view, $authUser->hasRole('Admin') ? compact('user') : []);
    }

   public function store(Request $request, User $user)
{
    $authUser = Auth::user();

    // بررسی تکرار گزارش روزانه
    $alreadySubmitted = Report::where('user_id', $authUser->id)
        ->whereDate('submitted_at', now()->toDateString())
        ->exists();


    $unlimitedPhone = '099999';

    if ($authUser->phone != $unlimitedPhone) {

        // فقط برای کاربران معمولی محدودیت اعمال شود
        $reportCount = Report::where('user_id', $authUser->id)
            ->whereDate('submitted_at', now()->toDateString())
            ->count();

        // محدودیت تعداد گزارش‌ها در روز (مثال: 1 بار)
        $maxReportsPerDay = 1;

        if ($reportCount >= $maxReportsPerDay) {
            return redirect()->back()->with('error', 'امکان ثبت بیش از یک گزارش در روز وجود ندارد.');
        }
    }

    
    // اعتبارسنجی داده‌ها
    $data = $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'required|string',
        'attachments.*' => 'nullable|file|max:10240',
        'successful_calls' => 'nullable|integer|min:0',
        'unsuccessful_calls' => 'nullable|integer|min:0',
    ]);

    $data['submitted_at'] = now();
    $data['user_id'] = $authUser->id;
    $data['status'] = Report::STATUS_SUBMITTED;

    // ایجاد گزارش
    $report = Report::create($data);

    // 📎 ذخیره فایل‌ها (بدون تغییر)
    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            if (str_starts_with($file->getMimeType(), 'image/')) {
                $fileName = 'report_attachments/' . uniqid() . '.jpg';
                $path = storage_path('app/public/' . $fileName);

                if ($file->getMimeType() === 'image/jpeg') {
                    $image = imagecreatefromjpeg($file->getPathname());
                } elseif ($file->getMimeType() === 'image/png') {
                    $image = imagecreatefrompng($file->getPathname());
                } else {
                    $image = null;
                }

                if ($image) {
                    $width = imagesx($image);
                    $height = imagesy($image);
                    $maxWidth = 1200;

                    if ($width > $maxWidth) {
                        $ratio = $maxWidth / $width;
                        $newWidth = $maxWidth;
                        $newHeight = intval($height * $ratio);

                        $resized = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagejpeg($resized, $path, 70);
                        imagedestroy($resized);
                    } else {
                        imagejpeg($image, $path, 70);
                    }

                    imagedestroy($image);

                    $report->attachments()->create([
                        'file_path' => $fileName,
                        'type' => 'image/jpeg',
                    ]);
                }
            } else {
                $path = $file->store('report_attachments', 'public');

                $report->attachments()->create([
                    'file_path' => $path,
                    'type' => $file->getMimeType(),
                ]);
            }
        }
    }

    // 🧾 لاگ ارسال گزارش شامل تماس‌ها
    activity()
        ->causedBy($authUser)
        ->performedOn($report)
        ->withProperties([
            'title' => $data['title'] ?? null,
           
            'description' => $data['description'],
        ])
        ->log('ارسال گزارش با تماس‌ها و فایل‌ها');

    // مسیر بازگشت بر اساس نقش
    $route = 'user.reports.index';

    // 🔔 نوتیفیکیشن برای مدیران و ادمین‌ها
    $managerIds = User::role(['Admin', 'Manager'])->pluck('id')->toArray();
    $uniqueIds = array_unique($managerIds);

    foreach ($uniqueIds as $id) {
        Notification::create([
            'user_id' => $id,
            'title' => 'گزارش کار جدید',
            'message' => "گزارش جدیدی ثبت شده است.",
            'seen' => false,
        ]);
    }

    return redirect()->route($route, $authUser->id)
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

        if ($authUser->hasRole('Marketer')) {
            $route = 'user.reports.index';
        } elseif ($authUser->hasRole('Manager')) {
            $route = 'user.reports.index';
        } else {
            $route = 'user.reports.index';
        }

        return redirect()->route($route, $report)
            ->with('success', 'گزارش ارسال شد.');
    }

   public function show(Report $report, User $user = null)
{
    $authUser = Auth::user();

    // =====================
    // Admin / Manager
    // =====================
    if ($authUser->hasRole('Admin') || $authUser->hasRole('Manager')) {
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
            ->log('مشاهده گزارش توسط ادمین/مدیر');

        return view('reports.show', compact('report', 'user'));
    }

    // =====================
    // سایر کاربران (از جمله 35)
    // =====================
    $allowedIds = $this->allowedReportUserIds();

    if (!in_array($report->user_id, $allowedIds)) {
        abort(403);
    }

    // ✅ اگر 35 گزارش‌های 31 رو دید => خوانده شده بزن
    if ($authUser->id == 35 && $report->user_id == 31) {
        // فقط گزارش‌های ارسالی/خوانده‌شده قابل مشاهده باشند
      

        if ($report->status === Report::STATUS_SUBMITTED) {
            $report->markAsRead();
        }
    }

    activity()
        ->causedBy($authUser)
        ->performedOn($report)
        ->withProperties(['action' => 'view'])
        ->log('مشاهده گزارش');

    return view('user.reports.show', compact('report'));
}


    public function edit(Report $report, User $user = null)
    {
        $authUser = Auth::user();

        if ($authUser->hasRole('Admin')) {
            $report = Report::where('id', $report->id)->firstOrFail();
        } elseif ($authUser->hasRole('Manager')) {
            $report = Report::where('id', $report->id)->firstOrFail();
        } else {
            $report = Report::where('user_id', $authUser->id)->where('id', $report->id)->firstOrFail();
        }

        $view = 'user.reports.edit';

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
        'successful_calls' => 'nullable|integer|min:0',
        'unsuccessful_calls' => 'nullable|integer|min:0',
    ]);

    $authUser = Auth::user();

    if ($authUser->hasRole('Admin')) {
        $report = Report::where('id', $report->id)->firstOrFail();
    } elseif ($authUser->hasRole('Manager')) {
        $report = Report::where('id', $report->id)->firstOrFail();
    } else {
        $report = Report::where('user_id', $authUser->id)->where('id', $report->id)->firstOrFail();
    }

    $oldData = $report->getOriginal();
    $report->update($data);

    activity()
        ->causedBy($authUser)
        ->performedOn($report)
        ->withProperties(['old' => $oldData, 'new' => $report->toArray()])
        ->log('ویرایش گزارش (با بروزرسانی تماس‌ها)');

    return redirect()->back()->with('success', 'گزارش با موفقیت بروزرسانی شد.');
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

        return redirect()->back()->with('success', 'گزارش با موفقیت حذف شد.');
    }
}
