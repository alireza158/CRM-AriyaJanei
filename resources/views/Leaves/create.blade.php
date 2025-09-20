<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">
            ثبت مرخصی جدید
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg p-6" dir="rtl">
            <form action="{{ route('leaves.store') }}" method="POST">
                @csrf
                @if(session('success'))
                <div class="alert alert-success mt-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager'))
                    <div class="mb-4">
                        <label for="user_id" class="block font-medium text-gray-700">انتخاب کارمند</label>
                        <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                <div class="mb-4">
                    <label for="leave_type">نوع مرخصی</label>
                    <select name="leave_type" id="leave_type" class="form-control" required>
                        <option value="">انتخاب کنید</option>
                        <option value="اضظراری">اضظراری</option>
                        <option value="استعلاجی">استعلاجی</option>
                        <option value="استحقاقی">استحقاقی</option>
                    </select>
                    @error('type')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="start_date" class="block font-medium text-gray-700">تاریخ شروع</label>
                        <input type="text" id="start_date" name="start_date" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('start_date') }}">
                                         @error('start_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="start_time" class="block font-medium text-gray-700">ساعت شروع</label>
                        <input type="text" name="start_time" id="start_time" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('start_time') }}">
                        @error('start_time')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="end_date" class="block font-medium text-gray-700">تاریخ پایان</label>
                        <input type="text" name="end_date" id="end_date" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('end_date') }}">
                        @error('end_date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="end_time" class="block font-medium text-gray-700">ساعت پایان</label>
                        <input type="text" name="end_time" id="end_time" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('end_time') }}">
                        @error('end_time')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="mb-4">
                    <label for="reason" class="block font-medium text-gray-700">توضیحات</label>
                    <textarea name="reason" id="reason" rows="3" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('reason') }}</textarea>
                    @error('reason')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-start gap-4 mt-6">
                    <a href="{{ route('leaves') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">بازگشت</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">ثبت مرخصی</button>
                </div>
            </form>
        </div>


    </div>
</x-app-layout>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {
        $("#start_date").persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValue: false
        });
        $("#end_date").persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValue: false
        });
    });
</script>
<script>

    if(window.innerWidth > 768){ // فقط دسکتاپ
    flatpickr("#start_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
    flatpickr("#end_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    });
}

</script>
