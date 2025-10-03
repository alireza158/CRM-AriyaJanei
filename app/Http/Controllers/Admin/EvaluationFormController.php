<?php
// app/Http/Controllers/Admin/EvaluationFormController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EvaluationForm;
use App\Models\EvaluationQuestion;
use Illuminate\Http\Request;

class EvaluationFormController extends Controller
{
    // لیست فرم‌ها
    public function index()
    {
        $forms = EvaluationForm::with('questions')->paginate(10);
        return view('admin.evaluations.forms.index', compact('forms'));
    }

    // ساخت فرم جدید
    public function create()
    {
        return view('admin.evaluations.forms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'evaluator_role' => 'required|string',
            'target_role'    => 'required|string',
            'unit_id'        => 'nullable|integer',
        ]);

        EvaluationForm::create($request->all());

        return redirect()->route('admin.evaluations.forms.index')
            ->with('success','فرم ارزیابی با موفقیت ایجاد شد.');
    }

    // نمایش سوالات یک فرم
    public function show(EvaluationForm $form)
    {
        $form->load('questions');
        return view('admin.evaluations.forms.show', compact('form'));
    }

    // اضافه کردن سوال
    public function addQuestion(Request $request, EvaluationForm $form)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $form->questions()->create($request->only('title','description'));

        return back()->with('success','سوال اضافه شد.');
    }

    // حذف سوال
    public function deleteQuestion(EvaluationQuestion $question)
    {
        $question->delete();
        return back()->with('success','سوال حذف شد.');
    }
}
