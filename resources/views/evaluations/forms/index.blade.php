{{-- resources/views/admin/evaluations/forms/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">لیست فرم‌های ارزیابی</h2>
    </x-slot>

    <div class="p-4">
        <a href="{{ route('admin.evaluations.forms.create') }}" class="btn btn-primary mb-3">➕ فرم جدید</a>

        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>عنوان</th>
                    <th>نقش ارزیابی‌کننده</th>
                    <th>نقش ارزیابی‌شونده</th>
                    <th>واحد</th>
                    <th>تعداد سوالات</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($forms as $form)
                    <tr>
                        <td>{{ $form->title }}</td>
                        <td>{{ $form->evaluator_role }}</td>
                        <td>{{ $form->target_role }}</td>
                        <td>{{ $form->unit_id ?? '-' }}</td>
                        <td>{{ $form->questions->count() }}</td>
                        <td>
                            <a href="{{ route('admin.evaluations.forms.show',$form) }}" class="btn btn-info btn-sm">مدیریت سوالات</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $forms->links() }}
        </div>
    </div>
</x-app-layout>
