<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-5 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $customer->name ?? '' }} (شناسه: {{ $customer->display_customer_id ?? '-' }}) - فاکتور
            </h2>
            <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">بازگشت</a>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">

                <form action="{{ $action }}" method="POST" class="text-right" enctype="multipart/form-data">
                    @csrf
                    @if(isset($invoice))
                        @method('PUT')
                    @endif

                    {{-- تاریخ فاکتور --}}
                    <div class="mb-6">
                        <label for="invoice_date" class="block text-gray-700 text-sm font-medium mb-2 text-right">
                            تاریخ فاکتور
                        </label>
                        <input type="date" name="invoice_date" id="invoice_date"
                               value="{{ old('invoice_date', $invoice->invoice_date ?? now()->format('Y-m-d')) }}"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right @error('invoice_date') border-red-500 @enderror">
                        @error('invoice_date')
                        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- توضیحات --}}
                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 text-sm font-medium mb-2 text-right">
                            توضیحات (اختیاری)
                        </label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right @error('description') border-red-500 @enderror">{{ old('description', $invoice->description ?? '') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- فایل پیوست (عکس/پی‌دی‌اف) --}}
                    <div class="mb-6">
                        <label for="attachment" class="block text-gray-700 text-sm font-medium mb-2 text-right">
                            آپلود فایل (عکس یا PDF - اختیاری)
                        </label>
                        <input type="file" name="attachment" id="attachment"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right @error('attachment') border-red-500 @enderror">
                        @error('attachment')
                        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                        @enderror

                        @if(isset($invoice) && $invoice->attachment_path)
                            <div class="mt-3 space-y-2">
                                <p class="text-sm text-gray-600">فایل فعلی:</p>
                                @php
                                    $ext = strtolower(pathinfo($invoice->attachment_path, PATHINFO_EXTENSION));
                                @endphp

                                @if(in_array($ext, ['jpg','jpeg','png']))
                                    <img src="{{ asset('storage/'.$invoice->attachment_path) }}"
                                         alt="پیوست فاکتور"
                                         class="max-h-64 rounded-md border">
                                @else
                                    <a href="{{ asset('storage/'.$invoice->attachment_path) }}"
                                       target="_blank"
                                       class="text-blue-600 hover:underline">
                                        مشاهده فایل
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out shadow-sm flex items-center">
                            ذخیره فاکتور
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layouts.app>
