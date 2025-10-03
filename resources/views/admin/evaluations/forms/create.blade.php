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

            {{-- نقش ارزیابی‌کننده --}}
            {{-- نقش ارزیابی‌کننده --}}
<div class="mb-3">
    <label>نقش ارزیابی‌کننده</label>
    <select name="evaluator_role" class="form-select" required>
        <option value="ITUser">IT - کارمند</option>
        <option value="ITManager">IT - مدیر</option>
        <option value="StorageUser">انبار - کارمند</option>
        <option value="StorageManager">انبار - مدیر</option>
        <option value="SaleUser">فروش - کارمند</option>
        <option value="SaleManager">فروش - مدیر</option>
        <option value="AccountantUser">حسابداری - کارمند</option>
        <option value="AccountantManager">حسابداری - مدیر</option>
        <option value="InternalManager">مدیر داخلی</option>
        <option value="Admin">مدیر کل</option>
    </select>
</div>

{{-- نقش ارزیابی‌شونده --}}
<div class="mb-3">
    <label>نقش ارزیابی‌شونده</label>
    <select name="target_role" class="form-select" required>
        <option value="ITUser">IT - کارمند</option>
        <option value="ITManager">IT - مدیر</option>
        <option value="StorageUser">انبار - کارمند</option>
        <option value="StorageManager">انبار - مدیر</option>
        <option value="SaleUser">فروش - کارمند</option>
        <option value="SaleManager">فروش - مدیر</option>
        <option value="AccountantUser">حسابداری - کارمند</option>
        <option value="AccountantManager">حسابداری - مدیر</option>
        <option value="InternalManager">مدیر داخلی</option>
        <option value="Admin">مدیر کل</option>
    </select>
</div>


            <div class="mb-3">
                <label>بخش (اختیاری)</label>
                <select name="department_role" class="form-select">
                    <option value="">همه بخش‌ها</option>
                    <option value="IT">فناوری اطلاعات</option>
                    <option value="Storage">انبار</option>
                    <option value="Sale">فروش</option>
                    <option value="Accountant">حسابداری</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">ثبت فرم</button>
        </form>
    </div>
</x-app-layout>
