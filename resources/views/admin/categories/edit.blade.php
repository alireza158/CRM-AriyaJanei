<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            ویرایش دسته‌بندی
        </h2>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <label for="name" class="block text-gray-700 font-medium text-right">نام دسته‌بندی</label>
                        <input 
                            type="text" 
                            id="name"
                            name="name" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-right font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                            value="{{ old('name', $category->name) }}" 
                            placeholder="نام دسته‌بندی را وارد کنید"
                            required
                        >
                        @error('name')
                        <p class="text-red-600 text-sm mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 justify-end pt-4">
                        <a href="{{ route('admin.categories.index') }}" class="inline-block">
                            <button type="button" class="bg-gray-500 text-white px-6 py-2 rounded-md hover:bg-gray-600 font-medium transition-colors duration-200">
                                بازگشت
                            </button>
                        </a>
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 font-medium transition-colors duration-200">
                            به‌روزرسانی
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
