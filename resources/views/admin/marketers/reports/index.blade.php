
<x-layouts.app>

    @props([
        'reports',
        'prefix' => 'admin',
        'user' => null,
        'createLink' => null,
        'backLink' => null,
        'backLinkText' => 'بازگشت',
        'header' => 'فهرست گزارشات'
    ])

    <div class="container py-4" dir="rtl">
        {{-- هدر --}}
        <div class="d-flex align-items-center gap-3 mb-3">
            <h2 class="fw-semibold fs-4 mb-0">{{ $header }}</h2>
            @if($backLink)
                <span>|</span>
                <a href="{{ $backLink }}" class="text-decoration-none">{{ $backLinkText }}</a>
            @endif
            @if($createLink)
                <a href="{{ $createLink }}" class="ms-auto btn btn-primary btn-sm">ایجاد گزارش جدید</a>
            @endif
        </div>

        {{-- پیام‌های session --}}
        @foreach (['info', 'success', 'error'] as $msg)
            @if(session($msg))
                <div class="alert alert-{{ $msg === 'error' ? 'danger' : ($msg === 'success' ? 'success' : 'warning') }} alert-dismissible fade show text-end" role="alert">
                    {{ session($msg) }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endforeach

        {{-- جدول گزارش‌ها --}}
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>تاریخ ایجاد</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->title ?? '-' }}</td>
                                <td class="text-truncate" style="max-width: 200px;">{{ Str::limit($report->description, 50) }}</td>
                                <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($report->created_at)->format('Y/m/d') }}</td>
                                <td>
                                    @if($report->status === \App\Models\Report::STATUS_SUBMITTED)
                                        <span class="badge bg-warning text-dark">خوانده نشده</span>
                                    @elseif($report->status === \App\Models\Report::STATUS_READ)
                                        <span class="badge bg-success">خوانده شده</span>
                                    @else
                                        <span class="badge bg-secondary">پیش‌نویس</span>
                                    @endif
                                </td>
                                <td class="d-flex justify-content-center gap-1 flex-wrap">
                                    <a href="{{ route("{$prefix}.reports.show", $user ? [$report, $user] : $report) }}"
                                       class="btn btn-sm btn-primary">مشاهده</a>
                                    <a href="{{ route("{$prefix}.reports.edit", $user ? [$report, $user] : $report) }}"
                                       class="btn btn-sm btn-success">ویرایش</a>
                                    <form action="{{ route("{$prefix}.reports.destroy", $user ? [$report, $user] : $report) }}"
                                          method="POST" class="d-inline" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">گزارشی یافت نشد.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- صفحه‌بندی --}}
                @if(method_exists($reports, 'links'))
                <div class="mt-3 px-3">
                    {{ $reports->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

</x-layouts.app>


