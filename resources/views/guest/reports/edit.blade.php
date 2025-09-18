<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center gap-3" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ویرایش گزارش
            </h2>
            |
            <a href="{{ route('guest.reports.index') }}">
                <p>
                    بازگشت
                </p>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">
                <form action="{{ route('guest.reports.update', $report) }}"
                      method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 text-right">عنوان</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $report->title) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right"
                               dir="rtl">
                        @error('title')<p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 text-right">توضیحات</label>
                        <textarea name="description" id="description" rows="5"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right"
                                  dir="rtl">{{ old('description', $report->description) }}</textarea>
                        @error('description')<p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex justify-start gap-4">
                        <a href="{{ route('guest.reports.index') }}">
                            <button type="button"
                                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                بازگشت
                            </button>
                        </a>
                        @if($report->status === \App\Models\Report::STATUS_DRAFT)
                            <button type="submit" name="action" value="save"
                                    class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                                ذخیره پیش‌نویس
                            </button>
                            <a href="{{ route('guest.reports.submit', $report ) }}">
                                <button type="button" name="action" value="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    ارسال نهایی
                                </button>
                            </a>
                        @elseif($report->status === \App\Models\Report::STATUS_SUBMITTED || \App\Models\Report::STATUS_DRAFT)
                            <span class="px-4 py-2 bg-gray-200 text-gray-600 rounded-md">
                                گزارش قفل شده ({{ $report->status }})
                            </span>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
