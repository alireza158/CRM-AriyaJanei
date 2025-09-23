<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-center text-gray-800">نمایش گزارش</h2>
    </x-slot>

    <div class="flex flex-col items-center justify-center px-4 py-8 space-y-12" dir="rtl">
        <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-6 space-y-6 border-t-4 border-green-500">
            @if(session('info'))
                <div class="mb-4 p-4 rounded bg-yellow-100 text-yellow-800 text-right">
                    {{ session('info') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 rounded bg-yellow-100 text-yellow-800 text-right">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="mb-4 p-4 rounded bg-white-100 text-green-800 text-right">
                    {{ session('success') }}
                </div>
            @endif
            <h3 class="text-xl font-bold text-gray-700 border-b pb-2 text-right">جزئیات گزارش</h3>

            <div class="space-y-3">
                <div class="text-right">
                    <h4 class="text-gray-600 font-semibold">عنوان:</h4>
                    <p class="text-gray-800">{{ $report->title }}</p>
                </div>

                <div class="text-right">
                    <h4 class="text-gray-600 font-semibold">توضیحات:</h4>
                    <p class="text-gray-800 whitespace-pre-line">{{ $report->description }}</p>
                </div>

                <div class="text-right">
                    <h4 class="text-gray-600 font-semibold">ارسال‌شده در:</h4>
                    <p class="text-gray-800">{{ $report->submitted_at->format('Y-m-d H:i') }}</p>
                </div>

                <div class="text-right">
                    <h4 class="text-gray-600 font-semibold">وضعیت:</h4>
                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full">
                        @if($report->status =="submitted")
                        <span class="badge bg-warning text-dark">خوانده نشده</span>
                        @elseif($report->status =="read")
                        <span class="badge bg-success">خوانده شده</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-6 space-y-6 border-t-4 border-blue-500">
            <h3 class="text-xl font-bold text-gray-700 border-b pb-2 text-right">ارسال بازخورد مدیر</h3>
            <form action="{{ route('admin.reports.feedback', [$report, $user]) }}"
                  method="POST"
                  class="space-y-6">
                @csrf
                @method('PUT')
                <div class="text-right">
                    <label for="feedback" class="block text-gray-700 font-medium mb-1">بازخورد:</label>
                    <textarea name="feedback"
                              id="feedback"
                              rows="4"
                              class="w-full border rounded-lg p-3 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 text-right"
                              dir="rtl"
                    >{{ $report->feedback ?? '' }}</textarea>
                </div>

                {{--!
                <div class="text-right">
                    <label for="rating" class="block text-gray-700 font-medium mb-1">امتیاز (1 تا 5):</label>
                    <input type="number"
                           name="rating"
                           id="rating"
                           min="1"
                           max="5"
                           value="{{ old('rating', $report->rating) }}"
                           class="w-24 border rounded-lg p-2 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 text-center"
                    >
                </div>
--}}
                <div class="text-center gap-4">
                    <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
                        ذخیره بازخورد
                    </button>
                    <a href="{{ route('admin.reports.index', $user) }}">
                        <button type="button"
                                class="px-6 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 focus:ring-2 focus:ring-gray-400">
                            بازگشت
                        </button>
                    </a>
                </div>

            </form>
        </div>

    </div>
</x-layouts.app>
