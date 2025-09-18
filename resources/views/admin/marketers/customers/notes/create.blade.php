<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ایجاد یادداشت جدید برای: {{ $customer->name }}
            </h2>
            |
            <h3>
                <a href="{{ route('admin.marketers.customers.notes.index', ['marketer' => $marketer->id, 'customer' => $customer->id]) }}" class="hover:underline">
                    بازگشت به لیست یادداشت‌ها
                </a>
            </h3>
            |
            <h3>
                <a href="{{ route('admin.marketers.customers.index', ['marketer' => $marketer->id]) }}" class="hover:underline">
                    بازگشت به مشتریان
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">
                <form action="{{ route('admin.marketers.customers.notes.store', ['marketer' => $marketer->id, 'customer' => $customer->id]) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium mb-2 text-right">عنوان:</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 text-right" dir="rtl">
                        @error('title')
                        <p class="text-red-600 text-sm mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-medium mb-2 text-right">محتوا:</label>
                        <textarea name="content" id="content" rows="5"
                                  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 text-right" dir="rtl">{{ old('content') }}</textarea>
                        @error('content')
                        <p class="text-red-600 text-sm mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-start">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded px-5 py-2">
                            ذخیره یادداشت
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>

