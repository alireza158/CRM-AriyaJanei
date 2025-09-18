<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            ایجاد مشتری جدید
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">
                <form action="{{ route('admin.marketers.customers.store', ['marketer' => $marketer->id] ) }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 text-right">نام</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full border-gray-300 rounded-md text-right" dir="rtl"/>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 text-right">ایمیل</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full border-gray-300 rounded-md text-right" dir="rtl"/>
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 text-right">تلفن</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 block w-full border-gray-300 rounded-md text-right" dir="rtl"/>
                        </div>
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 text-right">آدرس</label>
                            <textarea name="address" id="address" class="mt-1 block w-full border-gray-300 rounded-md text-right" dir="rtl">{{ old('address') }}</textarea>
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
                        <a href="{{ route('admin.marketers.customers.index', $marketer) }}">
                            <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="button">
                                بازگشت
                            </button>
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">ذخیره</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
