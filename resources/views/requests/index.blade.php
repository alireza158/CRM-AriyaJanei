<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">لیست درخواست‌ها</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="alert alert-success text-center mb-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-center mb-4">{{ session('error') }}</div>
        @endif

        <a href="{{ route('requests.create') }}" class="btn btn-primary mb-4">ثبت درخواست جدید</a>

        <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6" dir="rtl">
            <div class="overflow-x-auto">
                <table class="table table-bordered table-striped w-full text-center min-w-[700px] sm:min-w-full">
                    <thead>
                        <tr>
                            <th>کاربر</th>
                            <th>عنوان</th>
                            <th>توضیحات</th>
                            <th>تاریخ ثبت</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $ticket)
                            <tr>
                                <td class="whitespace-nowrap">{{ $ticket->user->name }}</td>
                                <td class="whitespace-nowrap">{{ $ticket->title }}</td>
                                <td class="text-start">{{ $ticket->description }}</td>
                                <td class="whitespace-nowrap">
                                    {{ \Hekmatinasser\Verta\Verta::instance($ticket->created_at)->format('Y/m/d') }}
                                    <br class="sm:hidden">
                                    {{ \Carbon\Carbon::parse($ticket->created_at)->format('H:i') }}
                                </td>
                                <td class="whitespace-nowrap">
                                    @switch($ticket->status)
                                        @case('pending')
                                            <span class="badge bg-warning">در انتظار تایید مدیر واحد</span>
                                            @break
                                        @case('manager_approved')
                                            <span class="badge bg-info">تایید مدیر واحد — منتظر تایید مدیر داخلی/ادمین</span>
                                            @break
                                        @case('final_approved')
                                            <span class="badge bg-success">تایید نهایی</span>
                                            @break
                                        @case('manager_rejected')
                                            <span class="badge bg-danger">رد توسط مدیر واحد</span>
                                            @break
                                        @case('internal_rejected')
                                            <span class="badge bg-danger">رد توسط مدیر داخلی/ادمین</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary">{{ $ticket->status }}</span>
                                    @endswitch
                                </td>
                                <td class="whitespace-nowrap">
                                    @php $user = Auth::user(); @endphp
<a href="{{ route('requests.show', $ticket->id) }}" class="btn btn-outline-primary btn-sm">نمایش</a>
                                    {{-- حذف توسط صاحب درخواست تا قبل از تایید نهایی --}}
                                    @if(in_array($ticket->status, ['pending','manager_approved']) && $ticket->user_id === $user->id)
                                        <form action="{{ route('requests.destroy', $ticket->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">حذف</button>
                                        </form>
                                    @endif

                                    {{-- مدیر واحد --}}
                                    @if($user->hasRole('Manager') && $ticket->status === 'pending' && $ticket->manager_id == $user->id)
                                        <form action="{{ route('requests.approve', $ticket->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-success btn-sm">تایید</button>
                                        </form>
                                        <form action="{{ route('requests.reject', $ticket->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-danger btn-sm">رد</button>
                                        </form>
                                    @endif

                                    {{-- مدیر داخلی یا ادمین --}}
                                    @if(($user->hasRole('Admin') || $user->hasAnyRole(['internalManager','InternalManager'])) && $ticket->status === 'manager_approved')
                                        <form action="{{ route('requests.approve', $ticket->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-success btn-sm">تایید مدیر داخلی / ادمین</button>
                                        </form>
                                        <form action="{{ route('requests.reject', $ticket->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <button class="btn btn-danger btn-sm">رد مدیر داخلی / ادمین</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">هیچ درخواستی ثبت نشده است.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
</x-app-layout>