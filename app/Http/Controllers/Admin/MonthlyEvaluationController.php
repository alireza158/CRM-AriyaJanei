<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvaluationAnswer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class MonthlyEvaluationController extends Controller
{
    public function index(Request $request)
    {
        // ترجیح پارامترهای شمسی (jy, jm)؛ نگاشت year/month میلادی در صورت ارسال
        $nowJ = Jalalian::now();
        $jy = (int) $request->input('jy', $nowJ->getYear());
        $jm = (int) $request->input('jm', $nowJ->getMonth());

        if ($request->filled('year') || $request->filled('month')) {
            $gy = (int) $request->input('year', Carbon::now()->year);
            $gm = (int) $request->input('month', Carbon::now()->month);
            $gStart = Carbon::create($gy, $gm, 1)->startOfMonth();
            $jFromG = Jalalian::fromCarbon($gStart);
            $jy = $jFromG->getYear();
            $jm = $jFromG->getMonth();
        }

        // اعتبارسنجی ساده
        if ($jm < 1 || $jm > 12) { $jm = $nowJ->getMonth(); }
        if ($jy < 1395 || $jy > 1500) { $jy = $nowJ->getYear(); }

        // بازه‌ی دقیق ماه شمسی → Carbon
        $firstJ      = new Jalalian($jy, $jm, 1);
        $daysInMonth = $firstJ->getMonthDays();
        $start       = $firstJ->toCarbon()->startOfDay();
        $end         = (new Jalalian($jy, $jm, $daysInMonth))->toCarbon()->endOfDay();

        // فیلترهای اختیاری
        $evaluatorId = $request->integer('evaluator_id');   // = user_id
        $targetId    = $request->integer('target_id');      // = target_user_id

        // کوئری
        $answers = EvaluationAnswer::query()
            ->with([
                'question:id,title',
                'evaluator:id,name',     // فرض بر این‌که ریلیشن evaluator -> user_id تعریف شده
                'target:id,name',        // و ریلیشن target -> target_user_id
            ])
            ->whereBetween('created_at', [$start, $end])
            ->when($evaluatorId, fn($q) => $q->where('user_id', $evaluatorId))
            ->when($targetId, fn($q) => $q->where('target_user_id', $targetId))
            ->orderBy('user_id')                // ✅ به‌جای evaluator_id
            ->orderBy('target_user_id')         // ✅
            ->orderBy('created_at')
            ->get();

        // گروه‌بندی هر «ارزیاب → ارزیابی‌شونده»
        $grouped = $answers->groupBy(fn($a) => $a->user_id . '_' . $a->target_user_id); // ✅

        return view('admin.evaluations.monthly', [
            'grouped'       => $grouped,
            'jy'            => $jy,
            'jm'            => $jm,
            'evaluator_id'  => $evaluatorId,
            'target_id'     => $targetId,
        ]);
    }
}
