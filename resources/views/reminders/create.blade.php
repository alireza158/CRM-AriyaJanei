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
                    <input type="text" id="remind_at" name="remind_at" class="form-control" required>
                    @error('remind_at') <div class="text-danger">{{ $message }}</div> @enderror
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

    {{-- Flatpickr شمسی --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fa.js"></script>
    <script>
        flatpickr("#remind_at", {
            enableTime: true,
            time_24hr: true,
            locale: "fa",
            dateFormat: "Y-m-d H:i",
        });
    </script>
</x-app-layout>
