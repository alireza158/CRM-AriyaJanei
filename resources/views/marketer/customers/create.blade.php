<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ایجاد مشتری جدید
            </h2>
            |
            <h3>
                <a href="{{ route('marketer.customers.index') }}" class="text-gray-600 hover:underline">
                    بازگشت
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">
                <form action="{{ route('marketer.customers.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 text-right">نام</label>
                            <input type="text" name="name" id="name" value="" required class="mt-1 block w-full border-gray-300 rounded-md text-right" dir="rtl"/>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 text-right">شماره تلفن</label>
                            <input type="text" name="phone" id="phone"
                                   value="{{ old('phone') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md text-right @error('phone') is-invalid @enderror">

                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                               </div>

                               <div>
                                <label for="DISC" class="block text-sm font-medium text-gray-700 text-right">DISC</label>
                                <select name="DISC" id="DISC"
                                        class="mt-1 block w-full border-gray-300 rounded-md text-right" dir="rtl">
                                    <option value="">-- انتخاب کنید --</option>
                                    <option value="D">D</option>
                                    <option value="I">I</option>
                                    <option value="S">S</option>
                                    <option value="C">C</option>
                                </select>
                            </div>

                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 text-right">آدرس</label>
                            <textarea name="address" id="address" class="mt-1 block w-full border-gray-300 rounded-md text-right" dir="rtl"></textarea>
                        </div>
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 text-right">دسته‌بندی</label>
                            <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md text-right" dir="rtl">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="reference_type_id" class="block text-sm font-medium text-gray-700 text-right">منبع</label>
                            <select name="reference_type_id" id="reference_type_id" class="mt-1 block w-full border-gray-300 rounded-md text-right" dir="rtl">
                                @foreach($referenceTypes as $ref)
                                    <option value="{{ $ref->id }}" {{ old('reference_type_id') == $ref->id ? 'selected' : '' }}>{{ $ref->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-start gap-4">
                        <a href="{{  route('marketer.customers.index') }} ">
                            <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">بازگشت</button>
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
