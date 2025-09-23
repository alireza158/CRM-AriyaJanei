<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-center text-gray-800">نمایش گزارش</h2>
    </x-slot>

    <div class="flex flex-col items-center justify-center px-4 py-8 space-y-12" dir="rtl">

        <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-6 space-y-6 border-t-4 border-green-500">
            <h3 class="text-xl font-bold text-gray-700 border-b pb-2">جزئیات گزارش</h3>
            <div class="space-y-3">
                <div>
                    <h4 class="text-gray-600 font-semibold">عنوان:</h4>
                    <p class="text-gray-800">{{ $report->title }}</p>
                </div>
                <div>
                    <h4 class="text-gray-600 font-semibold">توضیحات:</h4>
                    <p class="text-gray-800 whitespace-pre-line">{{ $report->description }}</p>
                </div>
                <div>
                    <h4 class="text-gray-600 font-semibold">ارسال‌شده در:</h4>
                    <p class="text-gray-800">{{ \Morilog\Jalali\Jalalian::fromDateTime($report->submitted_at)->format('Y-m-d H:i') }}</p>
                </div>
                <div>
                    <h4 class="text-gray-600 font-semibold">وضعیت:</h4>
                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full">
                        @if($report->status =="submitted")
                        <span class="badge bg-warning text-dark">خوانده نشده</span>
                        @elseif($report->status =="read")
                        <span class="badge bg-success">خوانده شده</span>
                        @endif
                    </span>
                </div>

                {{-- بخش نمایش فایل‌ها --}}
                @if($report->attachments->count())
                <div class="mb-3">
                    <h5 style="text-align: right; padding-bottom: 20px;" class="fw-bold ">فایل‌ها و تصاویر:</h5>
                    <ul class="list-unstyled text-end">
                        @foreach($report->attachments as $attachment)
                            <li class="mb-2">
                                @if(Str::startsWith($attachment->type, 'image'))
                                    <img src="{{ Storage::url($attachment->file_path) }}"
                                         alt="تصویر گزارش"
                                         class="img-fluid mb-1 clickable-image"
                                         style="max-height: 200px; cursor: pointer;"
                                         data-bs-toggle="modal"
                                         data-bs-target="#imageModal"
                                         data-src="{{ Storage::url($attachment->file_path) }}">
                                @endif

                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
        </div>
        @if($report->status === \App\Models\Report::STATUS_SUBMITTED || $report->status === \App\Models\Report::STATUS_READ)
            <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-6 space-y-6 border-t-4 border-blue-500">
                <h3 class="text-xl font-bold text-gray-700 border-b pb-2">بازخورد و امتیاز مدیر</h3>
                <div class="space-y-4">
                    <div>
                        <h4 class="text-gray-600 font-semibold">بازخورد:</h4>
                        <p class="text-gray-800 whitespace-pre-line">
                            {{ $report->feedback ?? 'هنوز بازخوردی ثبت نشده.' }}
                        </p>
                    </div>
                    {{--!
                    <div>
                        <h4 class="text-gray-600 font-semibold">امتیاز:</h4>
                        <p class="text-gray-800">
                            {{ $report->rating !== null ? $report->rating : '—' }}
                        </p>
                    </div>
                    --}}
                </div>
            </div>
        @endif
        <div class="flex justify-start space-x-reverse space-x-2">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">بازگشت</a>
        </div>
    </div>
        <!-- Modal برای نمایش تصویر -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img src="" id="modalImage" class="img-fluid w-100" alt="تصویر گزارش">
            </div>
        </div>
    </div>
</div>
</x-layouts.app>
<script>
    document.querySelectorAll('.clickable-image').forEach(img => {
        img.addEventListener('click', function() {
            document.getElementById('modalImage').src = this.dataset.src;
        });
    });
</script>
