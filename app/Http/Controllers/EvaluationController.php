<?php
// app/Http/Controllers/EvaluationController.php
namespace App\Http\Controllers;

use App\Models\EvaluationForm;
use App\Models\EvaluationAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
class EvaluationController extends Controller
{
    // نمایش لیست افرادی که باید ارزیابی شوند
    // app/Http/Controllers/EvaluationController.php
public function index()
{
    $user = Auth::user();
    $roles = $user->getRoleNames(); // همه رول‌های کاربر

    // اولویت‌بندی رول‌ها
    $rolePriority = ['Admin','InternalManager','Owner','Manager','Marketer','Sale','IT','Storage','Accountant'];
    $role = null;
    foreach ($rolePriority as $r) {
        if ($roles->contains($r)) {
            $role = $r;
            break;
        }
    }

    $adminId = 1; // مدیر کل
    $internalManagerId = 2; // مدیر داخلی

    $targets = collect([]);

    if (in_array($role, ['Marketer','Sale','IT','Storage','Accountant'])) {
        // پرسنل → فقط مدیر خودش + مدیر کل + مدیر داخلی
        if ($user->manager_id) {
            $manager = User::find($user->manager_id);
            if ($manager) $targets->push($manager);
        }
        $targets = $targets->merge(User::whereIn('id', [$adminId, $internalManagerId])->get());
    }
    elseif ($role === 'Manager') {
        // مدیر → پرسنل خودش
        $targets = $user->employees;
    }
    elseif (in_array($role,['Admin','InternalManager','Owner'])) {
        // مدیر کل / مدیر داخلی / صاحب → مدیران واحدها
        $targets = User::role('Manager')->get();
    }

    return view('evaluations.index', compact('targets'));
}

public function evaluate(User $target)
{
    $user = Auth::user();
    $roles = $user->getRoleNames();

    // پیدا کردن نقش اصلی
    $rolePriority = ['Admin','InternalManager','Owner','Manager','Marketer','Sale','IT','Storage','Accountant'];
    $role = null;
    foreach ($rolePriority as $r) {
        if ($roles->contains($r)) {
            $role = $r;
            break;
        }
    }

    $targetRole = $target->getRoleNames()->first();

    $form = EvaluationForm::with('questions')
        ->where('evaluator_role',$role)
        ->where('target_role',$targetRole)
        ->where(function($q) use ($user) {
            if ($user->unit_id) $q->whereNull('unit_id')->orWhere('unit_id',$user->unit_id);
        })
        ->firstOrFail();

    return view('evaluations.form', compact('form','target'));
}

public function store(Request $request, User $target)
{
    $user = Auth::user();

    foreach ($request->answers as $questionId => $score) {
        EvaluationAnswer::create([
            'question_id' => $questionId,
            'user_id' => $user->id,
            'target_user_id' => $target->id,
            'score' => $score,
            'comment' => $request->comments[$questionId] ?? null,
        ]);
    }

    return redirect()->route('evaluations.index')->with('success','ارزیابی ثبت شد ✅');
}

}
