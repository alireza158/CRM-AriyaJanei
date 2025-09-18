<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ایجاد نحوه‌ی آشنایی جدید
            </h2>
            <p>
                <a href="{{ route('admin.referenceType.index') }}"> بازگشت </a>
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">
                <form method="POST" action="{{ route('admin.referenceType.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 text-right">نام نحوه‌ی آشنایی</label>
                        <input type="text" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-right" value="{{ old('name') }}" placeholder="نام نحوه‌ی آشنایی را وارد کنید">
                        @error('name')
                        <p class="text-red-600 text-sm mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        ذخیره
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
