<?php
// app/Http/Controllers/EvaluationController.php
namespace App\Http\Controllers;

use App\Models\EvaluationForm;
use App\Models\EvaluationAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();

        $rolePriority = ['Admin','InternalManager','Owner','Manager','Marketer','Sale','IT','Storage','Accountant','User'];
        $role = null;
        foreach ($rolePriority as $r) {
            if ($roles->contains($r)) { $role = $r; break; }
        }

        $adminUser   = User::role('Owner')->first();
        $internalMgr = User::role('InternalManager')->first();

        $targets = collect([]);

        if (in_array($role, ['Marketer','Sale','IT','Storage','Accountant','User'])) {
            if ($user->manager_id) {
                $manager = User::find($user->manager_id);
                if ($manager) $targets->push($manager);
            }
            if ($adminUser)   $targets->push($adminUser);
            if ($internalMgr) $targets->push($internalMgr);
        }
        elseif ($role === 'Manager') {
            $targets = $user->employees;
        }
        elseif (in_array($role, ['Admin','InternalManager','Owner'])) {
            $targets = User::role('Manager')->get();
        }

        return view('evaluations.index', compact('targets'));
    }

    public function evaluate(User $target)
{
    $user = Auth::user();

    // نقش‌های ارزیاب و هدف
    $evaluatorRoles = $user->getRoleNames()->toArray();
    $targetRoles    = $target->getRoleNames()->toArray();

    // پیش‌فرض
    $evaluatorRole = null;
    $targetRole    = null;

    // اگر کاربر یا هدف رول Storage داشته باشن
    if (in_array('Storage', $evaluatorRoles)) {
        // اگه یوزر پرسنل انبار باشه
        if (in_array('User', $evaluatorRoles)) {
            $evaluatorRole = 'StorageUser';
        }
        // اگه یوزر مدیر انبار باشه
      if (in_array('Manager', $evaluatorRoles)) {
            $evaluatorRole = 'StorageManager';
        }
    }

    if (in_array('Storage', $targetRoles)) {
        if (in_array('Manager', $targetRoles)) {
            $targetRole = 'StorageManager';
        }
        if (in_array('User', $targetRoles)) {
            $targetRole = 'StorageUser';
        }
    }

    // همین روند رو می‌تونی برای IT، Sale، Accountant و ... ادامه بدی
    // مثال:
    if (in_array('IT', $evaluatorRoles)) {
        $evaluatorRole = in_array('Manager', $evaluatorRoles) ? 'ITManager' : 'ITUser';
    }
    if (in_array('IT', $targetRoles)) {
        $targetRole = in_array('Manager', $targetRoles) ? 'ITManager' : 'ITUser';
    }

    // جستجوی فرم براساس نقش مشخص‌شده
    $form = EvaluationForm::with('questions')
        ->where('evaluator_role', $evaluatorRole)
        ->where('target_role', $targetRole)
        ->first();

    if (! $form) {
        abort(404, 'فرم ارزیابی مناسب برای این ترکیب پیدا نشد.');
    }

    return view('evaluations.form', compact('form','target'));
}



    public function store(Request $request, User $target)
    {
        $user = Auth::user();

        foreach ($request->answers as $questionId => $score) {
            EvaluationAnswer::create([
                'question_id'    => $questionId,
                'user_id'        => $user->id,
                'target_user_id' => $target->id,
                'score'          => $score,
                'comment'        => $request->comments[$questionId] ?? null,
            ]);
        }

        return redirect()->route('evaluations.index')->with('success','✅ ارزیابی ثبت شد.');
    }
}
