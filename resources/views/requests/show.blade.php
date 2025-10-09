<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">جزئیات درخواست</h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto px-4 sm:px-6 lg:px-8" dir="rtl">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <div class="d-flex justify-content-between items-center mb-4 no-print">
                <a href="{{ route('requests.index') }}" class="btn btn-secondary">بازگشت</a>
                <a href="{{ route('requests.print', $ticket->id) }}" target="_blank" class="btn btn-outline-secondary">چاپ</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <tbody>
                        <tr>
                            <th class="w-40">شماره درخواست</th>
                            <td>{{ $ticket->id }}</td>
                        </tr>
                        <tr>
                            <th>کاربر</th>
                            <td>{{ $ticket->user->name }}</td>
                        </tr>
                        <tr>
                            <th>عنوان</th>
                            <td>{{ $ticket->title }}</td>
                        </tr>
                        <tr>
                            <th>توضیحات</th>
                            <td class="text-start">{{ $ticket->description }}</td>
                        </tr>
                        <tr>
                            <th>وضعیت</th>
                            <td>
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
                        </tr>
                        <tr>
                            <th>مدیر واحد</th>
                            <td>{{ optional($ticket->manager)->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>مدیر داخلی/ادمین</th>
                            <td>{{ optional($ticket->superManager)->name ?? '—' }}</td>
                        </tr>
                        <tr>
                            <th>تاریخ ثبت</th>
                            <td>
                                {{ $ticket->created_at->format('Y/m/d') }} — {{ $ticket->created_at->format('H:i') }}
                            </td>
                        </tr>
                        <tr>
                            <th>آخرین تغییر وضعیت</th>
                            <td>
                                {{ $ticket->updated_at->format('Y/m/d') }} — {{ $ticket->updated_at->format('H:i') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4 no-print">
         </div>
        </div>
    </div>

    <style>
        @media print { .no-print { display: none !important; } }
    </style>
</x-app-layout>