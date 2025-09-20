<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">
            لیست مرخصی‌ها
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded text-center mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded text-center mb-4">
                {{ session('error') }}
            </div>
        @endif

        <a href="{{ route('leaves.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">ایجاد مرخصی جدید</a>

        <div class="bg-white shadow-sm rounded-lg p-4 md:p-6" dir="rtl">

            <!-- جدول برای دسکتاپ -->
            <div class="hidden md:block overflow-x-auto">
                <table class="table-auto w-full text-center border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">کارمند</th>
                            <th class="border px-4 py-2">نوع مرخصی</th>
                            <th class="border px-4 py-2">شروع</th>
                            <th class="border px-4 py-2">پایان</th>
                            <th class="border px-4 py-2">توضیحات</th>
                            <th class="border px-4 py-2">تاریخ ارائه درخواست</th>
                            <th class="border px-4 py-2">وضعیت</th>
                            <th class="border px-4 py-2">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leaves as $leave)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2">{{ $leave->user->name }}</td>
                                <td class="border px-4 py-2">{{ $leave->leave_type }}</td>
                                <td class="border px-4 py-2">
                                    {{ \Hekmatinasser\Verta\Verta::instance($leave->start_date)->format('Y/m/d') }}
                                    {{ \Carbon\Carbon::parse($leave->start_time)->format('H:i') }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ \Hekmatinasser\Verta\Verta::instance($leave->end_date)->format('Y/m/d') }}
                                    {{ \Carbon\Carbon::parse($leave->end_time)->format('H:i') }}
                                </td>
                                <td class="border px-4 py-2">{{ $leave->reason }}</td>
                                <td class="border px-4 py-2">
                                    {{ \Hekmatinasser\Verta\Verta::instance($leave->created_at)->format('Y/m/d') }}
                                    {{ \Carbon\Carbon::parse($leave->created_at)->format('H:i') }}
                                </td>
                                <td class="border px-4 py-2">
                                    @switch($leave->status)
                                        @case('pending')
                                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-sm">در انتظار تایید مدیر واحد</span>
                                            @break
                                        @case('manager_approved')
                                            <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded text-sm">در انتظار مسئول حضور و غیاب → تایید مدیر واحد</span>
                                            @break
                                        @case('accounting_approved')
                                            <span class="bg-indigo-200 text-indigo-800 px-2 py-1 rounded text-sm">در انتظار تایید مدیر داخلی → تایید مسئول حضور و غیاب</span>
                                            @break
                                        @case('final_approved')
                                            <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-sm">تایید نهایی</span>
                                            @break
                                        @case('manager_rejected')
                                        @case('accounting_rejected')
                                        @case('final_rejected')
                                            <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-sm">رد شده</span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="border px-4 py-2 space-x-1">
                                    @if(Auth::user()->role === 'manager' && $leave->status === 'pending' && Auth::user()->id === $leave->manager_id)
                                        <form action="{{ route('leaves.approve', $leave->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-sm">تایید</button>
                                        </form>
                                        <form action="{{ route('leaves.reject', $leave->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-sm">رد</button>
                                        </form>
                                    @endif
                                    <!-- سایر نقش‌ها مشابه -->
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-gray-400 py-4">هیچ مرخصی‌ای ثبت نشده است.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- کارت‌ها برای موبایل -->
            <div class="md:hidden space-y-4">
                @forelse($leaves as $leave)
                    <div class="bg-gray-50 p-4 rounded shadow">
                        <p><strong>کارمند:</strong> {{ $leave->user->name }}</p>
                        <p><strong>نوع مرخصی:</strong> {{ $leave->leave_type }}</p>
                        <p><strong>شروع:</strong> {{ \Hekmatinasser\Verta\Verta::instance($leave->start_date)->format('Y/m/d') }} {{ \Carbon\Carbon::parse($leave->start_time)->format('H:i') }}</p>
                        <p><strong>پایان:</strong> {{ \Hekmatinasser\Verta\Verta::instance($leave->end_date)->format('Y/m/d') }} {{ \Carbon\Carbon::parse($leave->end_time)->format('H:i') }}</p>
                        <p><strong>توضیحات:</strong> {{ $leave->reason }}</p>
                        <p><strong>تاریخ درخواست:</strong> {{ \Hekmatinasser\Verta\Verta::instance($leave->created_at)->format('Y/m/d') }} {{ \Carbon\Carbon::parse($leave->created_at)->format('H:i') }}</p>
                        <p><strong>وضعیت:</strong>
                            @switch($leave->status)
                                @case('pending')
                                    در انتظار تایید مدیر واحد
                                    @break
                                @case('manager_approved')
                                    در انتظار مسئول حضور و غیاب → تایید مدیر واحد
                                    @break
                                @case('accounting_approved')
                                    در انتظار تایید مدیر داخلی → تایید مسئول حضور و غیاب
                                    @break
                                @case('final_approved')
                                    تایید نهایی
                                    @break
                                @case('manager_rejected')
                                @case('accounting_rejected')
                                @case('final_rejected')
                                    رد شده
                                    @break
                            @endswitch
                        </p>
                    </div>
                @empty
                    <p class="text-center text-gray-400">هیچ مرخصی‌ای ثبت نشده است.</p>
                @endforelse
            </div>

            <div class="mt-4">
                {{ $leaves->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
