<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ویرایش اطلاعیه
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('announcements.update', $announcement) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">عنوان</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $announcement->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">متن اطلاعیه</label>
                        <textarea name="message" rows="5" class="form-control" required>{{ old('message', $announcement->message) }}</textarea>
                    </div>

                    <div class="form-check mb-3">
                        <input type="hidden" name="is_active" value="0">
                        <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" @checked(old('is_active', $announcement->is_active))>
                        <label class="form-check-label" for="is_active">
                            اطلاعیه فعال باشد
                        </label>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                        <a href="{{ route('announcements.index') }}" class="btn btn-outline-secondary">بازگشت</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
