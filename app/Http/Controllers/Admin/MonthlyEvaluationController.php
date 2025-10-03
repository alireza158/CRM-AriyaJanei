<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvaluationAnswer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian; // برای تاریخ شمسی

class MonthlyEvaluationController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', Carbon::now()->month);
        $year  = $request->input('year', Carbon::now()->year);

        $answers = EvaluationAnswer::with(['evaluator','target','question'])
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('created_at','desc')
            ->get();

        // گروه‌بندی: هر ارزیابی‌کننده به هر ارزیابی‌شونده
        $grouped = $answers->groupBy(function($item) {
            return $item->evaluator->id . '_' . $item->target->id;
        });

        return view('admin.evaluations.monthly', [
            'grouped' => $grouped,
            'month'   => $month,
            'year'    => $year
        ]);
    }
}
