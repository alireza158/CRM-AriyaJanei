<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-3 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                فاکتور شماره #{{ $invoice->id }}
            </h2>
            <h3>
                |
                <a href="{{ route('marketer.invoices.index', $invoice->customer) }}" class=" hover:underline">
                    بازگشت به لیست
                </a>
            </h3>
        </div>
    </x-slot>

    <style>
        @media print {
            body * { visibility: hidden; margin:0; padding:0;}
            .invoice-box, .invoice-box * { visibility: visible; }
            .invoice-box { position:absolute; top:0; left:0; width:100%; margin:0; padding:20px; box-shadow:none; border:none; }
            .no-print { display:none !important; }
            body { font-size:12pt; line-height:1.5; }
        }

        .invoice-box { font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height:1.6; color:#333; direction:rtl; text-align:right; }
        .invoice-header { border-bottom:2px solid #eee; padding-bottom:20px; margin-bottom:30px; }
        .invoice-title { font-size:24px; font-weight:bold; color:#2c3e50; }
        .invoice-details { background-color:#f9f9f9; padding:15px; border-radius:5px; margin-bottom:20px; }
        .thank-you { margin-top:50px; padding-top:20px; border-top:2px dashed #eee; font-style:italic; color:#555; }
        .print-btn { transition: all 0.3s ease; }
        .print-btn:hover { transform: translateY(-2px); box-shadow:0 4px 8px rgba(0,0,0,0.1); }
    </style>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-lg invoice-box">
                <div class="flex justify-between mb-6 no-print">
                    <button onclick="window.print()"
                        class="print-btn bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg">
                        چاپ فاکتور
                    </button>
                </div>

                <div class="flex justify-between invoice-header">
                    <div>
                        <h1 class="invoice-title">فاکتور فروش</h1>
                    </div>
                    <div class="text-rtl">
                        <p class="text-gray-600"><strong>تاریخ:</strong> {{ \Morilog\Jalali\Jalalian::fromDateTime($invoice->invoice_date)->format('Y/m/d') }}</p>
                        <p class="text-gray-600"><strong>وضعیت:</strong> <span class="text-green-600">پرداخت شده</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="invoice-details">
                        <h3 class="font-bold text-lg mb-3 text-blue-600">فروشنده</h3>
                      
                        <p><strong>بازاریاب:</strong> {{ auth()->user()->name }}</p>
                        <p><strong>تلفن:</strong> <span dir="ltr">{{ auth()->user()->phone }}</span></p>
                    </div>

                    <div class="invoice-details">
                        <h3 class="font-bold text-lg mb-3 text-blue-600">مشتری</h3>
                        <p><strong>نام:</strong> {{ $invoice->customer->name }}</p>
                        <p><strong>تاریخ ثبت:</strong> {{ \Morilog\Jalali\Jalalian::fromDateTime($invoice->created_at)->format('Y/m/d H:i') }}</p>
                    </div>
                </div>

                @if($invoice->description)
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-lg mb-2 text-blue-600">توضیحات:</h4>
                        <p class="whitespace-pre-wrap text-gray-700">{{ $invoice->description }}</p>
                    </div>
                @endif

              @if($invoice->attachments->count())
    <div class="mb-8 rtl-text no-print">
        <h3 class="font-bold text-lg mb-3 text-blue-600">پیوست‌های فاکتور</h3>

        @foreach($invoice->attachments as $attachment)
            @php
                $path = asset('storage/' . $attachment->path);
                $ext  = strtolower(pathinfo($attachment->path, PATHINFO_EXTENSION));
            @endphp

            {{-- Images --}}
            @if(in_array($ext, ['jpg','jpeg','png','webp','gif']))
                <img src="{{ $path }}"
                     alt="پیوست فاکتور {{ $loop->iteration }}"
                     class="max-h-96 rounded-lg border mb-4">

            {{-- PDF preview --}}
            @elseif($ext === 'pdf')
                <div class="mb-6">
                    <p class="text-sm text-gray-600 mb-2">PDF پیوست {{ $loop->iteration }}</p>
                    <iframe
                        src="{{ $path }}"
                        class="w-full rounded-lg border"
                        style="height: 600px;"
                    ></iframe>

                    <a href="{{ $path }}" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">
                        باز کردن / دانلود PDF
                    </a>
                </div>

            {{-- HTML preview --}}
            @elseif(in_array($ext, ['html','htm']))
                <div class="mb-6">
                    <p class="text-sm text-gray-600 mb-2">HTML پیوست {{ $loop->iteration }}</p>
                    <iframe
                        src="{{ $path }}"
                        class="w-full rounded-lg border"
                        style="height: 600px;"
                        sandbox="allow-same-origin allow-scripts allow-forms allow-popups"
                    ></iframe>

                    <a href="{{ $path }}" target="_blank" class="text-blue-600 hover:underline mt-2 inline-block">
                        باز کردن HTML در تب جدید
                    </a>
                </div>

            {{-- Other files --}}
            @else
                <div class="mb-3">
                    <a href="{{ $path }}"
                       target="_blank"
                       class="text-blue-600 hover:underline">
                        دانلود فایل پیوست {{ $loop->iteration }} ({{ $ext }})
                    </a>
                </div>
            @endif
        @endforeach
    </div>
@endif

       

                <div class="thank-you">
                    <p class="text-center text-lg">با تشکر از اعتماد شما</p>
                    <p class="text-center text-sm text-gray-500 mt-2">در صورت هرگونه سوال با شماره {{ config('app.phone') }} تماس بگیرید</p>
                </div>

                <div class="mt-8 text-xs text-gray-500 text-center no-print">
                    <p>این فاکتور به صورت خودکار تولید شده و نیاز به مهر و امضا ندارد</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
