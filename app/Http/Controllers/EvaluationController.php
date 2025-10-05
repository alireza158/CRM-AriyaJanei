<?php
// app/Http/Controllers/EvaluationController.php
namespace App\Http\Controllers;

use App\Models\EvaluationForm;
use App\Models\EvaluationAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
if(in_array('Owner', $targetRoles)){
      $targetRole = 'Owner';
        $evaluatorRole = 'User';
}elseif(in_array('InternalManager', $targetRoles)){
$targetRole = 'InternalManager';
        $evaluatorRole = 'User';
}else{
    // اگر کاربر یا هدف رول Storage داشته باشن
    if (in_array('StorageUser', $evaluatorRoles)) {
        // اگه یوزر پرسنل انبار باشه
       
            $evaluatorRole = 'StorageUser';
        
        // اگه یوزر مدیر انبار باشه
    
    }elseif (in_array('StorageManager', $evaluatorRoles)) {
            $evaluatorRole = 'StorageManager';
        }

        
    if (in_array('StorageUser', $targetRoles)) {
      
            $targetRole = 'StorageUser';
       
        
    }elseif (in_array('StorageManager', $targetRoles)) {
            $targetRole = 'StorageManager';
        }




           if (in_array('ITUser', $evaluatorRoles)) {
        // اگه یوزر پرسنل انبار باشه
       
            $evaluatorRole = 'ITUser';
        
        // اگه یوزر مدیر انبار باشه
    
    }elseif (in_array('ITManager', $evaluatorRoles)) {
            $evaluatorRole = 'ITManager';
        }

    if (in_array('ITUser', $targetRoles)) {
      
            $targetRole = 'ITUser';
       
        
    }elseif (in_array('ITManager', $targetRoles)) {
            $targetRole = 'ITManager';
        }


   if (in_array('MarketerUser', $evaluatorRoles)) {
        // اگه یوزر پرسنل انبار باشه
       
            $evaluatorRole = 'MarketerUser';
        
        // اگه یوزر مدیر انبار باشه
    
    }elseif (in_array('MarketerManager', $evaluatorRoles)) {
            $evaluatorRole = 'MarketerManager';
        }

    if (in_array('MarketerUser', $targetRoles)) {
      
            $targetRole = 'MarketerUser';
       
        
    }elseif (in_array('MarketerManager', $targetRoles)) {
            $targetRole = 'MarketerManager';
        }

        
 if (in_array('SaleUser', $evaluatorRoles)) {
        // اگه یوزر پرسنل انبار باشه
       
            $evaluatorRole = 'SaleUser';
        
        // اگه یوزر مدیر انبار باشه
    
    }elseif (in_array('SalerManager', $evaluatorRoles)) {
            $evaluatorRole = 'SaleManager';
        }

    if (in_array('SaleUser', $targetRoles)) {
      
            $targetRole = 'SaleUser';
       
        
    }elseif (in_array('SaleManager', $targetRoles)) {
            $targetRole = 'SaleManager';
        }

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

    // 1) اعتبارسنجی سمت سرور
   $validated = $request->validate([
    'answers'   => ['required', 'array', 'min:1'],
    'answers.*' => ['required', 'integer', 'between:1,5'],
]);


    DB::transaction(function () use ($validated, $user, $target) {
        foreach ($validated['answers'] as $questionId => $score) {
            // 2) جلوگیری از رکورد تکراری: اگر قبلاً پاسخ داده، همان را آپدیت کن
            \App\Models\EvaluationAnswer::updateOrCreate(
                [
                    'question_id'    => $questionId,
                    'user_id'        => $user->id,
                    'target_user_id' => $target->id,
                ],
                [
                    'score'   => (int) $score,
                    'comment' => null,
                ]
            );
        }
    });

    return redirect()
        ->route('evaluations.index')
        ->with('success', '✅ ارزیابی با موفقیت ثبت شد.');
}
}
