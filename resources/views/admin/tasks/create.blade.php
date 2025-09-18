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
                        <select name="user_id" id="user_id" class="form-select" required>
                            <option value="">انتخاب کاربر</option>
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
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
                        <input type="date" name="date" id="date" class="form-control" value="{{ old('date', now()->format('Y-m-d')) }}" required>
                        @error('date')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">ایجاد تسک</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
