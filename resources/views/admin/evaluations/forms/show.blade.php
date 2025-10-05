<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">مدیریت سوالات فرم: {{ $form->title }}</h2>
    </x-slot>

    <div class="container py-4">
        {{-- فرم اضافه کردن سوال --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.evaluations.forms.addQuestion',$form) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">متن سوال</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">توضیح (اختیاری)</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            ➕ افزودن سوال
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- لیست سوالات --}}
        <div class="table-responsive shadow-sm">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>سوال</th>
                        <th>توضیحات</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($form->questions as $q)
                        <tr>
                            <td>{{ $q->title }}</td>
                            <td>{{ $q->description ?? '-' }}</td>
                            <td>
                                <form action="{{ route('admin.evaluations.questions.delete',$q) }}" method="POST" class="d-inline" onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این سوال را حذف کنید؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        🗑 حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">سوالی موجود نیست.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
