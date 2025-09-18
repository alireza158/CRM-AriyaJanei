<?php

namespace App\Http\Controllers;

use App\Models\ReferenceType;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ReferenceTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $referenceTypes = ReferenceType::paginate(15);

        // لاگ مشاهده لیست
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['action' => 'view_list'])
            ->log('مشاهده لیست نحوه‌های آشنایی');

        return view('admin.referenceType.index', compact('referenceTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // لاگ مشاهده فرم ایجاد
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['action' => 'view_create_form'])
            ->log('مشاهده فرم ایجاد نحوه‌ی آشنایی');

        return view('admin.referenceType.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:reference_types,name',
        ]);

        $referenceType = ReferenceType::create($data);

        // لاگ ایجاد
        activity()
            ->causedBy(auth()->user())
            ->performedOn($referenceType)
            ->withProperties(['new' => $data])
            ->log('ایجاد نحوه‌ی آشنایی جدید');

        return redirect()->route('admin.referenceType.index')
            ->with('success', 'نحوه‌ی آشنایی با موفقیت ثبت شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReferenceType $referenceType)
    {
        // لاگ مشاهده
        activity()
            ->causedBy(auth()->user())
            ->performedOn($referenceType)
            ->withProperties(['action' => 'view'])
            ->log('مشاهده نحوه‌ی آشنایی');

        return view('admin.referenceType.show', compact('referenceType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReferenceType $referenceType)
    {
        // لاگ مشاهده فرم ویرایش
        activity()
            ->causedBy(auth()->user())
            ->performedOn($referenceType)
            ->withProperties(['action' => 'view_edit_form'])
            ->log('مشاهده فرم ویرایش نحوه‌ی آشنایی');

        return view('admin.referenceType.edit', compact('referenceType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReferenceType $referenceType)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:reference_types,name,' . $referenceType->id,
        ]);

        $oldData = $referenceType->getOriginal();

        $referenceType->update($data);

        // لاگ ویرایش
        activity()
            ->causedBy(auth()->user())
            ->performedOn($referenceType)
            ->withProperties(['old' => $oldData, 'new' => $data])
            ->log('ویرایش نحوه‌ی آشنایی');

        return redirect()->route('admin.referenceType.index')
            ->with('success', 'نحوه‌ی آشنایی با موفقیت به‌روزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReferenceType $referenceType)
    {
        // لاگ حذف
        activity()
            ->causedBy(auth()->user())
            ->performedOn($referenceType)
            ->withProperties(['action' => 'delete'])
            ->log('حذف نحوه‌ی آشنایی');

        $referenceType->delete();

        return redirect()->route('admin.referenceType.index')
            ->with('success', 'نحوه‌ی آشنایی با موفقیت حذف شد.');
    }
}
