<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                مشاهده گزارش
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4" dir="rtl">
                <div>
                    <h3 class="text-lg font-medium text-right">عنوان:</h3>
                    <p class="text-right">{{ $report->title ?? '-' }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-right">توضیحات:</h3>
                    <p class="whitespace-pre-line text-right">{{ $report->description }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-right">تاریخ ایجاد:</h3>
                    <p class="text-right">{{ \Morilog\Jalali\Jalalian::fromDateTime($report->created_at)->format('Y-m-d H:i') }}</p>
                </div>
                <div class="flex justify-start space-x-reverse space-x-2">
                    <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">بازگشت</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
