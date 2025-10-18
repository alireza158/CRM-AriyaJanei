<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ویرایش گزارش
            </h2>
            |
            <a href="{{ route('marketer.reports.index') }}" class="hover:underline">
                بازگشت
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">
                @if(session('info'))
                    <div class="mb-4 p-4 rounded bg-yellow-100 text-yellow-800 text-right">
                        {{ session('info') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 p-4 rounded bg-red-100 text-red-800 text-right">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="mb-4 p-4 rounded bg-green-100 text-green-800 text-right">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('marketer.reports.update', $report) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 text-right">عنوان</label>
                        <input type="text" name="title" id="title"
                               value="{{ old('title', $report->title) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right"
                                {{--@if($report->status !== \App\Models\Report::STATUS_DRAFT) disabled @endif--}}
                        >
                        @error('title')<p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 text-right">توضیحات</label>
                        <textarea name="description" id="description" rows="5"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right"
                                  {{-- @if($report->status !== \App\Models\Report::STATUS_DRAFT) disabled @endif--}}
                        >{{ old('description', $report->description) }}</textarea>
                        @error('description')<p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>@enderror
                    </div>
                    @if($user->hasRole('Marketer'))
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    <div>
        <label for="successful_calls" class="block text-sm font-medium text-gray-700 text-right">
            تعداد تماس‌های موفق
        </label>
        <input type="number" name="successful_calls" id="successful_calls"
               value="{{ old('successful_calls', $report->successful_calls) }}"
               min="0"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right"
               dir="rtl">
        @error('successful_calls')
            <p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="unsuccessful_calls" class="block text-sm font-medium text-gray-700 text-right">
            تعداد تماس‌های ناموفق
        </label>
        <input type="number" name="unsuccessful_calls" id="unsuccessful_calls"
               value="{{ old('unsuccessful_calls', $report->unsuccessful_calls) }}"
               min="0"
               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right"
               dir="rtl">
        @error('unsuccessful_calls')
            <p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>
        @enderror
    </div>
</div>
@endif
                    <div class="flex justify-start gap-4">
                        <a href="{{ route('marketer.reports.index') }}">
                            <button type="button"
                                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                بازگشت
                            </button>
                        </a>

                       {{--  @if($report->status === \App\Models\Report::STATUS_DRAFT)--}}

                          {{--   <a href="{{ route('marketer.reports.submit', $report ) }}">--}}
                                <button type="submit" name="action" value="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
به روز رسانی
                                </button>
                            {{-- </a>--}}
                            {{--!
                        @elseif($report->status === \App\Models\Report::STATUS_SUBMITTED || \App\Models\Report::STATUS_DRAFT)
                            <span class="px-4 py-2 bg-gray-200 text-gray-600 rounded-md">
                                گزارش قفل شده ({{ $report->status }})
                            </span>
                        !--}}
                       {{-- @endif--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
