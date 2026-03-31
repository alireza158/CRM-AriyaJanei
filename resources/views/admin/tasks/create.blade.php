<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <h2 class="fw-semibold fs-4 mb-0">ایجاد تسک جدید</h2>
            <a href="{{ route('admin.tasks.index') }}">لیست تسک‌ها</a>
        </div>
    </x-slot>

    <div class="py-4 container">
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <form action="{{ route('admin.tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">کاربر</label>
                        <select name="user_id" class="form-control">
                            @foreach($users as $u)
                                <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>{{ $u->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">عنوان تسک</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        @error('title')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">توضیحات</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                        @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="due_date" class="form-label">تاریخ تحویل</label>
                            <input data-jdp type="text" name="due_date" id="due_date" class="form-control" value="{{ old('due_date') }}" required>
                            @error('due_date')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label for="due_time" class="form-label">ساعت تحویل</label>
                            <input type="time" name="due_time" id="due_time" class="form-control" value="{{ old('due_time') }}" required>
                            @error('due_time')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">ایجاد تسک</button>
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
