<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-5 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $marketer->name ?? '' }} / {{ $customer->name ?? '' }}
            </h2>
            <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">بازگشت</a>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">

                <form action="{{ route('marketer.invoices.store', $customer) }}" method="POST" class="text-right" enctype="multipart/form-data">
                    @csrf
                    @if(isset($invoice))
                        @method('PUT')
                    @endif

                    {{-- تاریخ فاکتور --}}
                    <div class="mb-6">
                        <label for="invoice_date" class="block text-gray-700 text-sm font-medium mb-2 text-right">تاریخ فاکتور</label>
                        <input type="date" name="invoice_date" id="invoice_date"
                               value="{{ old('invoice_date', $invoice->invoice_date ?? now()->format('Y-m-d')) }}"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right @error('invoice_date') border-red-500 @enderror">
                        @error('invoice_date')
                        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- توضیحات --}}
                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 text-sm font-medium mb-2 text-right">توضیحات (اختیاری)</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right @error('description') border-red-500 @enderror">{{ old('description', $invoice->description ?? '') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- فایل پیوست --}}
                  <div class="mb-6">
    <label for="attachments" class="block text-gray-700 text-sm font-medium mb-2 text-right">
        آپلود فایل‌ها (اختیاری)
    </label>

    <input type="file"
           name="attachments[]"
           id="attachments"
           multiple
           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right">

    @error('attachments')
        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
    @enderror

    @error('attachments.*')
        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
    @enderror

    @if(isset($invoice) && $invoice->attachments->count())
        <div class="mt-3 text-right">
            <p class="font-semibold mb-2">فایل‌های پیوست شده:</p>

            @foreach($invoice->attachments as $attachment)
                @php
                    $ext = strtolower(pathinfo($attachment->path, PATHINFO_EXTENSION));
                @endphp

                <div class="mb-2">
                    @if(in_array($ext, ['jpg','jpeg','png']))
                        <img src="{{ asset('storage/'.$attachment->path) }}"
                             alt="پیوست فاکتور"
                             class="h-24 rounded border mb-1 inline-block">
                    @endif

                    <a href="{{ asset('storage/'.$attachment->path) }}"
                       target="_blank"
                       class="text-blue-600 hover:underline mr-2">
                        مشاهده فایل {{ $loop->iteration }}
                    </a>
                </div>
            @endforeach
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
