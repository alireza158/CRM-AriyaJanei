<!-- <x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ایجاد گزارش جدید
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
{{--                <form action="{{ Route::has('admin.reports.store') ? route('admin.reports.store') : (Route::has('marketer.reports.store') ? route('marketer.reports.store') : route('guest.reports.store')) }}"--}}
                <form action="{{ route('admin.reports.store', $user->id) }}"
                      method="POST">
                    @csrf
{{--                    @if(Auth::user()->hasRole('Admin'))--}}
{{--                        <input type="hidden" name="user_id" value="{{ $user->id }}">--}}
{{--                    @endif--}}

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">عنوان</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">توضیحات</label>
                        <textarea name="description" id="description" rows="5"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            ذخیره
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app> -->
