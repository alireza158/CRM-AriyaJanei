<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-5 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ویرایش فاکتور #{{ $invoice->id }}{{ $marketer->name }} / {{ $invoice->customer->name }} برای
            </h2>
                |            <h3>
                <a href="{{ route('admin.marketers.invoices.index', [$marketer, $invoice->customer]) }}" class=" hover:underline">
                    بازگشت به لیست فاکتورها
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-8" dir="rtl">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-6" style="font-family: 'Vazir', 'Tahoma', sans-serif;">
                <form action="{{ route('admin.marketers.invoices.update', [
                  'marketer' =>$marketer,
                  'customer'=> $invoice->customer,
                  'invoice' =>$invoice]) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="invoice_date" class="block text-gray-700 text-sm font-medium mb-2">تاریخ فاکتور</label>
                        <input type="date" name="invoice_date" id="invoice_date"
                               value="{{ old('invoice_date', \Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d')) }}"
                               class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('invoice_date') border-red-500 @enderror text-right">
                        @error('invoice_date')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="items-container" class="space-y-4">
                        <template id="item-row-template">
                            <div class="item-row bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1">محصول</label>
                                        <select name="items[__index__][product_id]"
                                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 product-select text-right">
                                            <option value="" data-price="0">-- انتخاب محصول --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}"
                                                        data-price="{{ $product->price }}">
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('items.__index__.product_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1">تعداد</label>
                                        <input type="number" name="items[__index__][quantity]" min="1"
                                               value="{{ old('items.__index__.quantity', 1) }}"
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 quantity-input text-right">
                                        @error('items.__index__.quantity')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1">قیمت واحد</label>
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

                        @foreach(old('items', $invoice->items->map->only(['product_id','quantity','unit_price'])->toArray()) as $i => $oldItem)
                            <div class="item-row bg-white border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1">محصول</label>
                                        <select name="items[{{ $i }}][product_id]"
                                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 product-select text-right">
                                            <option value="" data-price="0">-- انتخاب محصول --</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}"
                                                        data-price="{{ $product->price }}"
                                                    @selected($oldItem['product_id'] == $product->id)>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('items.'.$i.'.product_id')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1">تعداد</label>
                                        <input type="number" name="items[{{ $i }}][quantity]" min="1"
                                               value="{{ old('items.'.$i.'.quantity', $oldItem['quantity']) }}"
                                               class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 quantity-input text-right">
                                        @error('items.'.$i.'.quantity')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-gray-700 text-sm font-medium mb-1">قیمت واحد</label>
                                        <div class="flex items-center h-10 border border-gray-300 rounded-md px-3 py-2 bg-gray-50 text-sm price-display text-right">
                                            {{ number_format(old('items.'.$i.'.unit_price', $oldItem['unit_price'])) }}
                                        </div>
                                        <input type="hidden" name="items[{{ $i }}][unit_price]"
                                               class="unit-price-input"
                                               value="{{ old('items.'.$i.'.unit_price', $oldItem['unit_price']) }}">
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
                    </div>

                    <div class="mb-6">
                        <button type="button" onclick="addItem()"
                                class="bg-blue-100 hover:bg-blue-200 text-blue-800 px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            افزودن محصول جدید
                        </button>
                        @error('items')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-gray-700 text-sm font-medium mb-2">توضیحات (اختیاری)</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror text-right"
                                  style="direction: rtl; text-align: right;">{{ old('description', $invoice->description) }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3 space-x-reverse">
                        <a href="{{ route('admin.marketers.invoices.index', [$marketer, $invoice->customer]) }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                            انصراف
                        </a>
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md text-sm font-medium transition duration-150 ease-in-out shadow-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            ذخیره تغییرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let itemIndex = {{ count(old('items', $invoice->items)) }};

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
