<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-5 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                 مشتری : {{ $customer->name }}
            </h2>
            |
            <h3>
                <a href="{{ route('marketer.invoices.index', [$customer]) }}" class=" hover:underline">
                    بازگشت به لیست فاکتورها
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6">
                <form action="{{ route('marketer.invoices.store', [$customer]) }}" method="POST" class="text-right">
                    @csrf

                    <div class="mb-6">
                        <label for="invoice_date" class="block text-gray-700 text-sm font-medium mb-2 text-right">تاریخ فاکتور</label>
                        <input type="date" name="invoice_date" id="invoice_date"
                               value="{{ old('invoice_date', now()->format('Y-m-d')) }}"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right @error('invoice_date') border-red-500 @enderror">
                        @error('invoice_date')
                        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="items-container" class="space-y-3">
                        <template id="item-row-template">
                            <div class="item-row bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1 text-right">محصول</label>
                                        <select name="items[__index__][product_id]"
                                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 product-select text-right">
                                            <option value="" data-price="0">-- انتخاب محصول --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}"
                                                        data-price="{{ $product->price }}"
                                                    @selected(old('items.__index__.product_id') == $product->id)>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('items.__index__.product_id')
                                        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1 text-right">تعداد</label>
                                        <input type="number" name="items[__index__][quantity]" min="1"
                                               value="{{ old('items.__index__.quantity', 1) }}"
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 quantity-input text-right">
                                        @error('items.__index__.quantity')
                                        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1 text-right">قیمت واحد</label>
                                        <div class="flex items-center h-10 border border-gray-300 rounded-md px-3 py-2 bg-gray-50 text-sm price-display text-right">
                                            {{ old('items.__index__.unit_price', 0) ? number_format(old('items.__index__.unit_price', 0)) : 0 }}
                                        </div>
                                        <input type="hidden" name="items[__index__][unit_price]"
                                               class="unit-price-input" value="{{ old('items.__index__.unit_price', 0) }}">
                                    </div>

                                    <div class="flex items-end justify-end">
                                        <button type="button" onclick="removeItem(this)"
                                                class="text-red-600 hover:text-red-800 text-sm font-medium transition duration-150 ease-in-out flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            حذف
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        @if(old('items'))
                            @foreach(old('items') as $index => $item)
                                <div class="item-row bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <div>
                                            <label class="block text-gray-700 text-sm font-medium mb-1 text-right">محصول</label>
                                            <select name="items[{{ $index }}][product_id]"
                                                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 product-select text-right">
                                                <option value="" data-price="0">-- انتخاب محصول --</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}"
                                                            data-price="{{ $product->price }}"
                                                        @selected($item['product_id'] == $product->id)>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('items.'.$index.'.product_id')
                                            <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 text-sm font-medium mb-1 text-right">تعداد</label>
                                            <input type="number" name="items[{{ $index }}][quantity]" min="1"
                                                   value="{{ $item['quantity'] }}"
                                                   class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 quantity-input text-right">
                                            @error('items.'.$index.'.quantity')
                                            <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="block text-gray-700 text-sm font-medium mb-1 text-right">قیمت واحد</label>
                                            <div class="flex items-center h-10 border border-gray-300 rounded-md px-3 py-2 bg-gray-50 text-sm price-display text-right">
                                                {{ $item['unit_price'] ? number_format($item['unit_price']) : 0 }}
                                            </div>
                                            <input type="hidden" name="items[{{ $index }}][unit_price]"
                                                   class="unit-price-input" value="{{ $item['unit_price'] }}">
                                        </div>

                                        <div class="flex items-end justify-end">
                                            <button type="button" onclick="removeItem(this)"
                                                    class="text-red-600 hover:text-red-800 text-sm font-medium transition duration-150 ease-in-out flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                حذف
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="mb-6">
                        <button type="button" onclick="addItem()"
                                class="bg-blue-100 hover:bg-blue-200 text-blue-800 px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            افزودن محصول جدید
                        </button>
                        @error('items')<p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 text-sm font-medium mb-2 text-right">توضیحات (اختیاری)</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-right @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out shadow-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            ذخیره فاکتور
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let itemIndex = {{ old('items') ? count(old('items')) : 0 }};

        function addItem() {
            const template = document.getElementById('item-row-template').innerHTML;
            const html = template.replace(/__index__/g, itemIndex++);
            document.getElementById('items-container').insertAdjacentHTML('beforeend', html);
            initLastRow();
        }

        function removeItem(btn) {
            btn.closest('.item-row').remove();
        }

        function initLastRow() {
            const rows = document.querySelectorAll('.item-row');
            const row = rows[rows.length - 1];
            const select = row.querySelector('.product-select');
            const priceDisplay = row.querySelector('.price-display');
            const hiddenInput = row.querySelector('.unit-price-input');

            select.addEventListener('change', function() {
                const price = parseFloat(this.selectedOptions[0].dataset.price) || 0;
                priceDisplay.textContent = price.toLocaleString('fa-IR');
                hiddenInput.value = price;
            });

            if (select.value) {
                const price = parseFloat(select.selectedOptions[0].dataset.price) || 0;
                priceDisplay.textContent = price.toLocaleString('fa-IR');
                hiddenInput.value = price;
            }
        }

        document.querySelectorAll('.item-row').forEach(row => {
            const select = row.querySelector('.product-select');
            const priceDisplay = row.querySelector('.price-display');
            const hiddenInput = row.querySelector('.unit-price-input');

            select.addEventListener('change', function() {
                const price = parseFloat(this.selectedOptions[0].dataset.price) || 0;
                priceDisplay.textContent = price.toLocaleString('fa-IR');
                hiddenInput.value = price;
            });

            if (select.value) {
                const price = parseFloat(select.selectedOptions[0].dataset.price) || 0;
                priceDisplay.textContent = price.toLocaleString('fa-IR');
                hiddenInput.value = price;
            }
        });

        if (itemIndex === 0) {
            addItem();
        }
    </script>
</x-layouts.app>
