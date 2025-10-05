<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">لیست فرم‌های ارزیابی</h2>
    </x-slot>

    <div class="container py-4">
        <div class="mb-3 text-end">
            <a href="{{ route('admin.evaluations.forms.create') }}" class="btn btn-primary">
                ➕ ایجاد فرم جدید
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>عنوان</th>
                        <th>ارزیاب</th>
                        <th>ارزیابی‌شونده</th>
                        <th>واحد / بخش</th>
                        <th>تعداد سوالات</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $form)
                        <tr>
                            <td>{{ $form->title }}</td>
                            <td>
                                @switch($form->evaluator_role)
                                    @case('ITUser') IT - کارمند @break
                                    @case('ITManager') IT - مدیر @break
                                    @case('StorageUser') انبار - کارمند @break
                                    @case('StorageManager') انبار - مدیر @break
                                    @case('SaleUser') فروش - کارمند @break
                                    @case('SaleManager') فروش - مدیر @break
                                    @case('MarketerUser') مارکتر - کارمند @break
                                    @case('MarketerManager') مارکتر - مدیر @break
                                    @case('InternalManager') مدیر داخلی @break
                                    @case('Owner') مدیر کل @break
                                    @default {{ $form->evaluator_role }}
                                @endswitch
                            </td>
                            <td>
                                @switch($form->target_role)
                                    @case('ITUser') IT - کارمند @break
                                    @case('ITManager') IT - مدیر @break
                                    @case('StorageUser') انبار - کارمند @break
                                    @case('StorageManager') انبار - مدیر @break
                                    @case('SaleUser') فروش - کارمند @break
                                    @case('SaleManager') فروش - مدیر @break
                                    @case('MarketerUser') مارکتر - کارمند @break
                                    @case('MarketerManager') مارکتر - مدیر @break
                                    @case('InternalManager') مدیر داخلی @break
                                    @case('Owner') مدیر کل @break
                                    @default {{ $form->target_role }}
                                @endswitch
                            </td>
                            <td>{{ $form->department_role ?? ($form->unit_id ?? '-') }}</td>
                            <td>{{ $form->questions->count() }}</td>
                            <td>
                                <a href="{{ route('admin.evaluations.forms.show',$form) }}" class="btn btn-info btn-sm mb-1">
                                    مدیریت سوالات
                                </a>
                                <form action="{{ route('admin.evaluations.forms.destroy', $form) }}" method="POST" class="d-inline" onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید این فرم را حذف کنید؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1">حذف فرم</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $forms->links('pagination::bootstrap-5') }}
        </div>
    </div>
</x-app-layout>
