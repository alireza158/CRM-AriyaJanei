<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">ثبت فرم رضایت مشتری</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8" dir="rtl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <form action="{{ route('customer-satisfaction-forms.store') }}" method="POST">
                @csrf

                <div class="mb-3 hidden">
                    <label class="form-label">تاریخ ثبت فرم</label>
                    <input type="date" name="submitted_at" class="form-control" value="{{ old('submitted_at', now()->toDateString()) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">تاریخ ارسال بار </label>
                    <input
                        type="text"
                        name="shipment_sent_at_fa"
                        class="form-control"
                        data-jdp
                        autocomplete="off"
                        placeholder="مثال: 1404/11/21"
                        value="{{ old('shipment_sent_at_fa') }}"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label class="form-label">نام مشتری</label>
                    <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">نام خانوادگی مشتری</label>
                    <input type="text" name="customer_family" class="form-control" value="{{ old('customer_family') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">روش ارسال</label>
                    <select name="shipping_method" class="form-select" required>
                        <option value="">انتخاب کنید</option>
                        <option value="barbari" @selected(old('shipping_method') === 'barbari')>باربری</option>
                        <option value="tipax" @selected(old('shipping_method') === 'tipax')>تیپاکس</option>
                        <option value="rahmati" @selected(old('shipping_method') === 'rahmati')>رحمتی</option>
                        <option value="ghafari" @selected(old('shipping_method') === 'ghafari')>غفاری</option>
                        <option value="nadi" @selected(old('shipping_method') === 'nadi')>نادی</option>
                        <option value="hozori" @selected(old('shipping_method') === 'hozori')>حضوری</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">وضعیت رضایت</label>
                    <select name="satisfaction_status" class="form-select" required>
                        <option value="">انتخاب کنید</option>
                        <option value="satisfied" @selected(old('satisfaction_status') === 'satisfied')>راضی</option>
                        <option value="unsatisfied" @selected(old('satisfaction_status') === 'unsatisfied')>ناراضی</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">ارجاع به کاربر </label>
                    <select name="assigned_to_user_id" class="form-select" required>
                        <option value="">انتخاب کنید</option>
                        @foreach($reviewUsers as $reviewUser)
                            <option value="{{ $reviewUser->id }}" @selected((int) old('assigned_to_user_id') === $reviewUser->id)>
                                {{ $reviewUser->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">توضیح ارجاع (اختیاری)</label>
                    <textarea name="referral_note" class="form-control" rows="3">{{ old('referral_note') }}</textarea>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('customer-satisfaction-forms.index') }}" class="btn btn-secondary">بازگشت</a>
                    <button type="submit" class="btn btn-primary">ثبت فرم</button>
                </div>
            </form>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('lib/jalalidatepicker.min.css') }}">
    <script src="{{ asset('lib/jalalidatepicker.min.js') }}"></script>
    <script>
        jalaliDatepicker.startWatch();
    </script>
</x-app-layout>
