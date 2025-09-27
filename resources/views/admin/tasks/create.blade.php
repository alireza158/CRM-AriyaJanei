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

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.tasks.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="user_id" class="form-label">کاربر</label>
                     <select name="user_id" class="form-control">
    @foreach($users as $u)
        <option value="{{ $u->id }}">{{ $u->name }}</option>
    @endforeach
</select>

                        @error('user_id')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">عنوان تسک</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">توضیحات</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label">تاریخ</label>
                        <input type="text" name="date" id="date" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('date') }}">
                        @error('date')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">ایجاد تسک</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-date/dist/persian-date.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(document).ready(function() {
        $("#date").persianDatepicker({
            format: 'YYYY/MM/DD',
            initialValue: false
        });
     
    });
</script>
