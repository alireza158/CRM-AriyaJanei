<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">
            لیست مرخصی‌ها
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="alert alert-success text-center mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center mb-4">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('leaves.create') }}" class="btn btn-primary mb-4">ایجاد مرخصی جدید</a>

        <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6" dir="rtl">
            <div class="overflow-x-auto">
                <table class="table table-bordered table-striped w-full text-center min-w-[700px] sm:min-w-full">
                    <thead>
                        <tr>
                            <th>کارمند</th>
                            <th>نوع مرخصی</th>
                            <th>شروع</th>
                            <th>پایان</th>
                            <th>توضیحات</th>
                            <th>تاریخ ارائه درخواست</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaves as $leave)
                            <tr>
                                <td class="whitespace-nowrap">{{ $leave->user->name }}</td>
                                <td class="whitespace-nowrap">{{ $leave->leave_type }}</td>
                                <td class="whitespace-nowrap">
                                    {{ \Hekmatinasser\Verta\Verta::instance($leave->start_date)->format('Y/m/d') }}
                                    <br class="sm:hidden">
                                    {{ \Carbon\Carbon::parse($leave->start_time)->format('H:i') }}
                                </td>
                                <td class="whitespace-nowrap">
                                    {{ \Hekmatinasser\Verta\Verta::instance($leave->end_date)->format('Y/m/d') }}
                                    <br class="sm:hidden">
                                    {{ \Carbon\Carbon::parse($leave->end_time)->format('H:i') }}
                                </td>
                                <td>{{ $leave->reason }}</td>
                                <td class="whitespace-nowrap">
                                    {{ \Hekmatinasser\Verta\Verta::instance($leave->created_at)->format('Y/m/d') }}
                                    <br class="sm:hidden">
                                    {{ \Carbon\Carbon::parse($leave->created_at)->format('H:i') }}
                                </td>
                                {{-- وضعیت (badge) --}}
<td class="whitespace-nowrap">
    @switch($leave->status)
        @case('pending')
            <span class="badge bg-warning">در انتظار تایید مدیر واحد</span>
            @break

        @case('manager_approved')
            <span class="badge bg-info">تأیید مدیر واحد — منتظر تایید مدیر داخلی/ادمین</span>
            @break

        @case('internal_approved')
           {{--  <span class="badge bg-primary">تأیید مدیر داخلی/ادمین — منتظر تایید حسابداری</span>--}}
                       <span class="badge bg-success">تأیید نهایی</span>

            @break

        @case('accounting_approved')
            <span class="badge bg-indigo">تأیید حسابداری — منتظر تأیید نهایی</span>
            @break

        @case('final_approved')
            <span class="badge bg-success">تأیید نهایی</span>
            @break

        @case('manager_rejected')
            <span class="badge bg-danger">رد توسط مدیر واحد</span>
            @break

        @case('internal_rejected')
            <span class="badge bg-danger">رد توسط مدیر داخلی/ادمین</span>
            @break

        @case('accounting_rejected')
            <span class="badge bg-danger">رد توسط حسابداری</span>
            @break

        @default
            <span class="badge bg-secondary">{{ $leave->status }}</span>
    @endswitch
</td>

{{-- عملیات (تایید / رد) --}}
<td class="whitespace-nowrap">
    @php $user = Auth::user(); @endphp

    {{-- مدیر واحد --}}
    @if($user->hasRole('Manager') && $leave->status === 'pending' && $leave->manager_id == $user->id)
        <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="d-inline">
            @csrf @method('PATCH')
            <button class="btn btn-success btn-sm">تایید</button>
        </form>
        <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="d-inline">
            @csrf @method('PATCH')
            <button class="btn btn-danger btn-sm">رد</button>
        </form>
    @endif

    {{-- مدیر داخلی یا ادمین --}}
    @if(($user->hasRole('Admin') || $user->hasRole('internalManager')) && $leave->status === 'manager_approved')
        <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="d-inline">
            @csrf @method('PATCH')
            <button class="btn btn-success btn-sm">تایید مدیر داخلی / ادمین</button>
        </form>
        <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="d-inline">
            @csrf @method('PATCH')
            <button class="btn btn-danger btn-sm">رد مدیر داخلی / ادمین</button>
        </form>
    @endif

    {{-- حسابداری --}}
    @if($user->hasRole('Accountant') && $leave->status === 'internal_approved')
        <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="d-inline">
            @csrf @method('PATCH')
            <button class="btn btn-success btn-sm">تایید حسابداری</button>
        </form>
        <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="d-inline">
            @csrf @method('PATCH')
            <button class="btn btn-danger btn-sm">رد حسابداری</button>
        </form>
    @endif
</td>



                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">هیچ مرخصی‌ای ثبت نشده است.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $leaves->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
