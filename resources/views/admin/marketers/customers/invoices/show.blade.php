<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-3 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                فاکتور شماره #{{ $invoice->id }}
            </h2>
            <h3>

                |
                <a href="{{ route('admin.marketers.invoices.index', [$marketer, $invoice->customer]) }}" class=" hover:underline">
                    بازگشت به لیست
                </a>
            </h3>
        </div>
    </x-slot>

    <style>
        @media print {
            body * {
                visibility: hidden;
                margin: 0;
                padding: 0;
            }
            .invoice-box, .invoice-box * {
                visibility: visible;
            }
            .invoice-box {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                margin: 0;
                padding: 20px;
                box-shadow: none;
                border: none;
            }
            .no-print {
                display: none !important;
            }
            .page-break {
                page-break-after: always;
            }
            body {
                font-size: 12pt;
                line-height: 1.5;
            }
            table {
                page-break-inside: auto;
            }
            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }

        .invoice-box {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            direction: rtl;
            text-align: right;
        }

        .invoice-header {
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .invoice-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .total-row {
            font-weight: bold;
            background-color: #f5f5f5;
        }

        .thank-you {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px dashed #eee;
            font-style: italic;
            color: #555;
        }

        .print-btn {
            transition: all 0.3s ease;
        }

        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* RTL specific styles */
        .rtl-table {
            direction: rtl;
        }

        .rtl-table th,
        .rtl-table td {
            text-align: right;
            padding: 12px 8px;
        }

        .rtl-table th:first-child,
        .rtl-table td:first-child {
            text-align: center;
        }

        .rtl-text {
            direction: rtl;
            text-align: right;
        }

        .ltr-text {
            direction: ltr;
            text-align: left;
        }

        .flex-rtl {
            flex-direction: row-reverse;
        }

        .justify-rtl {
            justify-content: flex-start;
        }

        .justify-rtl-reverse {
            justify-content: flex-end;
        }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-lg invoice-box">

                <div class="flex justify-end mb-6 space-x-3 no-print flex-rtl">
                    <button onclick="window.print()"
                            class="print-btn bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        چاپ فاکتور
                    </button>
                </div>

                <div class="flex justify-between items-center invoice-header flex-rtl">
                    <div class="rtl-text">
                        <h1 class="invoice-title">فاکتور فروش</h1>
                        <p class="text-gray-600 mt-1">شماره: INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="rtl-text">
                        <p class="text-gray-600"><strong>تاریخ:</strong> {{ \Morilog\Jalali\Jalalian::fromDateTime($invoice->invoice_date)->format('Y/m/d') }}</p>
                        <p class="text-gray-600"><strong>وضعیت:</strong> <span class="text-green-600">پرداخت شده</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="invoice-details rtl-text">
                        <h3 class="font-bold text-lg mb-3 text-blue-600">فروشنده</h3>
                        <p><strong>نام:</strong> {{ config('app.name') }}</p>
                        <p><strong>بازاریاب:</strong> {{ $marketer->name }}</p>
                        <p><strong>تلفن:</strong> <span class="ltr-text">{{ $marketer->phone }}</span></p>
                    </div>

                    <div class="invoice-details rtl-text">
                        <h3 class="font-bold text-lg mb-3 text-blue-600">مشتری</h3>
                        <p><strong>نام:</strong> {{ $invoice->customer->name }}</p>
                        <p><strong>تاریخ خرید:</strong> {{ \Morilog\Jalali\Jalalian::fromDateTime($invoice->created_at)->format('Y/m/d H:i') }}</p>
                    </div>
                </div>

                <div class="mb-8">
                    <table class="w-full border-collapse rtl-table">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-3">#</th>
                            <th class="border border-gray-300 px-4 py-3">نام محصول</th>
                            <th class="border border-gray-300 px-4 py-3">تعداد</th>
                            <th class="border border-gray-300 px-4 py-3">قیمت واحد (ریال)</th>
                            <th class="border border-gray-300 px-4 py-3">مبلغ (ریال)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @foreach($invoice->items as $index => $item)
                            @php
                                $subtotal = $item->quantity * $item->unit_price;
                                $total += $subtotal;
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $index+1 }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $item->product->name }}</td>
                                <td class="border border-gray-300 px-4 py-2 ltr-text">{{ number_format($item->quantity) }}</td>
                                <td class="border border-gray-300 px-4 py-2 ltr-text">{{ number_format($item->unit_price) }}</td>
                                <td class="border border-gray-300 px-4 py-2 ltr-text">{{ number_format($subtotal) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="total-row">
                            <td colspan="4" class="font-bold px-4 py-3 border border-gray-300">جمع کل:</td>
                            <td class="font-bold px-4 py-3 border border-gray-300 ltr-text">{{ number_format($total) }} ریال</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>

                @if($invoice->description)
                    <div class="mt-6 bg-gray-50 p-4 rounded-lg rtl-text">
                        <h4 class="font-semibold text-lg mb-2 text-blue-600">توضیحات:</h4>
                        <p class="whitespace-pre-wrap text-gray-700">{{ $invoice->description }}</p>
                    </div>
                @endif

                <div class="thank-you rtl-text">
                    <p class="text-center text-lg">با تشکر از اعتماد شما</p>
                    <p class="text-center text-sm text-gray-500 mt-2">در صورت هرگونه سوال با شماره <span class="ltr-text">{{ config('app.phone') }}</span> تماس بگیرید</p>
                </div>

                <div class="mt-8 text-xs text-gray-500 text-center no-print rtl-text">
                    <p>این فاکتور به صورت خودکار تولید شده و نیاز به مهر و امضا ندارد</p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
