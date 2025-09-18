<x-layouts.app>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-2">
            <h2 class="fw-semibold fs-4 text-dark mb-0">
                مشاهده گزارش
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="card shadow-sm border-0" dir="rtl">
                    <div class="card-body">
                        <div class="mb-3">
                            <h5 class="fw-bold text-end">عنوان:</h5>
                            <p class="text-end mb-0">{{ $report->title ?? '-' }}</p>
                        </div>

                        <div class="mb-3">
                            <h5 class="fw-bold text-end">توضیحات:</h5>
                            <p class="text-end mb-0" style="white-space: pre-line;">
                                {{ $report->description }}
                            </p>
                        </div>

                        <div class="mb-3">
                            <h5 class="fw-bold text-end">تاریخ ایجاد:</h5>
                            <p class="text-end mb-0">
                                {{ \Morilog\Jalali\Jalalian::fromDateTime($report->created_at)->format('Y/m/d H:i') }}
                            </p>
                        </div>

                        <div class="d-flex justify-content-start">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                بازگشت
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
