<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">
            لیست مرخصی‌ها
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
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

        <div class="bg-white shadow-sm rounded-lg p-6" dir="rtl">
            <table class="table table-bordered table-striped w-full text-center">
                <thead>
                    <tr>
                        <th>کارمند</th>
                        <th>نوع مرخصی</th>
                        <th>شروع</th>
                        <th>پایان</th>
                        <th>توضیحات</th>
                        <th>تاریخ ارائه درخواست</th> <!-- ستون جدید -->
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaves as $leave)
                        <tr>
                            <td>{{ $leave->user->name }}</td>
                            <td>{{ $leave->leave_type }}</td>
                            <td>
                                {{ \Hekmatinasser\Verta\Verta::instance($leave->start_date)->format('Y/m/d') }}
                                {{ \Carbon\Carbon::parse($leave->start_time)->format('H:i') }}
                            </td>
                            <td>
                                {{ \Hekmatinasser\Verta\Verta::instance($leave->end_date)->format('Y/m/d') }}
                                {{ \Carbon\Carbon::parse($leave->end_time)->format('H:i') }}
                            </td>
                            <td>{{ $leave->reason }}</td>
                            <td>
                                {{ \Hekmatinasser\Verta\Verta::instance($leave->created_at)->format('Y/m/d') }}
                                {{ \Carbon\Carbon::parse($leave->created_at)->format('H:i') }}
                            </td>
                            <td>
                                @switch($leave->status)
                                    @case('pending')
                                        <span class="badge bg-warning"> در انتظار تایید مدیر واحد</span>
                                        @break
                                    @case('manager_approved')
                                        <span class="badge bg-info">در انتظار مسئول حضور و غیاب → تایید مدیر واحد</span>
                                        @break
                                    @case('accounting_approved')
                                        <span class="badge bg-primary">در انتظار تایید مدیر داخلی → تایید مسئول حضور و غیاب </span>
                                        @break
                                    @case('final_approved')
                                        <span class="badge bg-success">تایید نهایی</span>
                                        @break
                                    @case('manager_rejected')
                                        <span class="badge bg-danger">رد توسط مدیر واحد</span>
                                        @break
                                    @case('accounting_rejected')
                                        <span class="badge bg-danger">رد توسط مسئول حضور و غیاب</span>
                                        @break
                                    @case('final_rejected')
                                        <span class="badge bg-danger">رد توسط مدیر داخلی</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                {{-- دکمه‌ها فقط وقتی نمایش داده میشن که مرحله‌ی مربوطه باشه --}}
                                @if(Auth::user()->role === 'manager' && $leave->status === 'pending' && Auth::user()->id ===$leave->manager_id )
                                    <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">تایید</button>
                                    </form>
                                    <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm">رد</button>
                                    </form>
                                @endif

                                @if(Auth::user()->role === 'accountant' && $leave->status === 'manager_approved')
                                    <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">تایید</button>
                                    </form>
                                    <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm">رد</button>
                                    </form>
                                @endif

                                @if(Auth::user()->role === 'internalManager' && $leave->status === 'accounting_approved')
                                    <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm">تایید نهایی</button>
                                    </form>
                                    <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-danger btn-sm">رد</button>
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

            <div class="mt-4">
                {{ $leaves->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
