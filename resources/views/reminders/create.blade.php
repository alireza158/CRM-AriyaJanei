<x-app-layout>
    <x-slot name="header">
        <h2>ایجاد یادآور جدید</h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm p-4">
            <form action="{{ route('reminders.store') }}" method="POST">
                @csrf

              {{--  <div class="mb-3">
                    <label for="user_id">کاربر</label>
                    <select name="user_id" class="form-control">
                        @foreach($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
 --}}
                <div class="mb-3">
                    <label for="title">عنوان</label>
                    <input type="text" name="title" class="form-control" required>
                    @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="description">توضیحات</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mb-3">

                        <label for="remind_at">زمان یادآور</label>
                        <input data-jdp data-jdp-time="true" type="text" id="remind_at" name="remind_at" class="form-control" required>


                    @error('remind_at') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">

                    <div>
                        <label for="remind_time" class="block font-medium text-gray-700">ساعت</label>
                        <input  type="text" name="remind_time" id="remind_time" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('start_time') }}">
                        @error('time')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="repeat">تکرار</label>
                    <select name="repeat" class="form-control">
                        <option value="once">یکبار</option>
                        <option value="daily">روزانه</option>
                        <option value="weekly">هفتگی</option>
                        <option value="monthly">ماهانه</option>
                    </select>
                </div>

                <button class="btn btn-primary">ایجاد یادآور</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>

    {{-- Flatpickr شمسی --}}
    <script>





    </script>
    <script>
          $(document).ready(function() {
            flatpickr("#remind_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

jalaliDatepicker.startWatch();
});

    </script>
</x-app-layout>
<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
