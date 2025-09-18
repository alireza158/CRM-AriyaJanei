<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            ایجاد دسته‌بندی جدید
        </h2>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-right font-medium">نام دسته‌بندی</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-right" value="{{ old('name') }}" placeholder="نام دسته‌بندی را وارد کنید">
                        @error('name')
                        <p class="text-red-600 text-sm mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2 justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-medium">
                            ذخیره
                        </button>
                        <a href="{{ route('admin.categories.index') }}">
                            <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700 font-medium">
                                بازگشت
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
