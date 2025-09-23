<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ایجاد گزارش جدید
            </h2>
            |
            <p>
                <a href="{{ route('admin.reports.index', $user) }}"
                   class=" hover:underline">
                    بازکشت به لیست گزارشات
                </a>
            </p>
        </div>
    </x-slot>
    <div class="py-12" dir="rtl">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form  action="{{ route('admin.reports.store', $user->id) }}"  enctype="multipart/form-data"
                      method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 text-right">عنوان</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right"
                               dir="rtl">
                        @error('title')<p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 text-right">توضیحات</label>
                        <textarea name="description" id="description" rows="5"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right"
                                  dir="rtl">{{ old('description') }}</textarea>
                        @error('description')<p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.reports.index', $user) }}">
                            <button class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="button">
                                بازگشت
                            </button>
                        </a>


                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            ذخیره
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
