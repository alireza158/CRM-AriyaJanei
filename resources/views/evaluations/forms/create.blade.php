{{-- resources/views/admin/evaluations/forms/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">ایجاد فرم ارزیابی جدید</h2>
    </x-slot>

    <div class="p-4">
        <form method="POST" action="{{ route('admin.evaluations.forms.store') }}">
            @csrf
            <div class="mb-3">
                <label>عنوان فرم</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>نقش ارزیابی‌کننده</label>
                <select name="evaluator_role" class="form-select" required>
                    <option value="User">کارمند</option>
                    <option value="Manager">مدیر واحد</option>
                    <option value="InternalManager">مدیر داخلی</option>
                    <option value="Admin">مدیر کل</option>
                </select>
            </div>

            <div class="mb-3">
                <label>نقش ارزیابی‌شونده</label>
                <select name="target_role" class="form-select" required>
                    <option value="User">کارمند</option>
                    <option value="Manager">مدیر واحد</option>
                    <option value="InternalManager">مدیر داخلی</option>
                    <option value="Admin">مدیر کل</option>
                </select>
            </div>

            <div class="mb-3">
                <label>شناسه واحد (اختیاری)</label>
                <input type="number" name="unit_id" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">ثبت فرم</button>
        </form>
    </div>
</x-app-layout>
