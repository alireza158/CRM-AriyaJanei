<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">ویرایش تسک</h2>
    </x-slot>

    @php
        $dueBase = $task->due_at ?? \Carbon\Carbon::parse($task->date)->startOfDay();
    @endphp

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">
                <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block font-medium text-gray-700">عنوان تسک</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium text-gray-700">توضیحات</label>
                        <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="due_date" class="block font-medium text-gray-700">تاریخ تحویل</label>
                            <input data-jdp type="text" name="due_date" id="due_date" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('due_date', \Hekmatinasser\Verta\Verta::instance($dueBase)->format('Y/m/d')) }}" required>
                            @error('due_date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label for="due_time" class="block font-medium text-gray-700">ساعت تحویل</label>
                            <input type="time" name="due_time" id="due_time" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('due_time', $task->due_at ? $task->due_at->format('H:i') : '09:00') }}" required>
                            @error('due_time')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">ذخیره تغییرات</button>
                        <a href="{{ route('admin.tasks.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<link rel="stylesheet" href="{{ asset('lib/persian-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('lib/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('lib/jalalidatepicker.min.css') }}">

<script src="{{ asset('lib/jquery.min.js') }}"></script>
<script src="{{ asset('lib/persian-date.min.js') }}"></script>
<script src="{{ asset('lib/persian-datepicker.min.js') }}"></script>
<script src="{{ asset('lib/flatpickr.min.js') }}"></script>
<script src="{{ asset('lib/jalalidatepicker.min.js') }}"></script>
<script>
    $(document).ready(function () {
        jalaliDatepicker.startWatch();

        flatpickr("#due_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    });
</script>
