<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">فرم‌های رضایت مشتری</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" dir="rtl">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(auth()->user()->hasRole('customer_review'))
            <div class="mb-4">
                <a href="{{ route('customer-satisfaction-forms.create') }}" class="btn btn-primary">+ فرم رضایت مشتری جدید</a>
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg p-4">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>تاریخ</th>
                        <th>مشتری</th>
                        <th>روش ارسال</th>
                        <th>رضایت</th>
                        <th>ارجاع به</th>
                        <th>ثبت‌کننده</th>
                        <th>نتیجه</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($forms as $form)
                        <tr>
                            <td>{{ $form->id }}</td>
                            <td>{{ \Hekmatinasser\Verta\Verta::instance($form->submitted_at)->format('Y/m/d') }}</td>
                            <td>{{ $form->customer_name }} {{ $form->customer_family }}</td>
                            <td>
                                @switch($form->shipping_method)
                                    @case('barbari') باربری @break
                                    @case('tipax') تیپاکس @break
                                    @case('rahmati') رحمتی @break
                                    @case('ghafari') غفاری @break
                                    @case('nadi') نادی @break
                                    @default حضوری
                                @endswitch
                            </td>
                            <td>
                                @if($form->satisfaction_status === 'satisfied')
                                    <span class="badge bg-success">راضی</span>
                                @else
                                    <span class="badge bg-danger">ناراضی</span>
                                @endif
                            </td>
                            <td>{{ optional($form->assignedToUser)->name ?? '—' }}</td>
                            <td>{{ optional($form->createdByUser)->name ?? '—' }}</td>
                            <td>{{ $form->result ? 'ثبت شده' : 'ثبت نشده' }}</td>
                            <td>
                                <a href="{{ route('customer-satisfaction-forms.show', $form) }}" class="btn btn-sm btn-outline-primary">مشاهده</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">فرمی ثبت نشده است.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $forms->links() }}
        </div>
    </div>
</x-app-layout>
