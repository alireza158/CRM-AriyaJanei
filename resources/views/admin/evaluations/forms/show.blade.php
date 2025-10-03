{{-- resources/views/admin/evaluations/forms/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">مدیریت سوالات فرم: {{ $form->title }}</h2>
    </x-slot>

    <div class="p-4">
        {{-- فرم اضافه کردن سوال --}}
        <form method="POST" action="{{ route('admin.evaluations.forms.addQuestion',$form) }}" class="mb-4">
            @csrf
            <div class="mb-2">
                <label>متن سوال</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>توضیح (اختیاری)</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">➕ افزودن سوال</button>
        </form>

        {{-- لیست سوالات --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>سوال</th>
                    <th>توضیحات</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($form->questions as $q)
                    <tr>
                        <td>{{ $q->title }}</td>
                        <td>{{ $q->description }}</td>
                        <td>
                            <form action="{{ route('admin.evaluations.questions.delete',$q) }}" method="POST" onsubmit="return confirm('حذف شود؟')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">🗑 حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
