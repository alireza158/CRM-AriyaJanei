<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-right">
            جزئیات مشتری: {{ $customer->name }} (شناسه: {{ $customer->display_customer_id }})
        </h2>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 gap-4 text-right">
                    <div><strong>شناسه مشتری:</strong> {{ $customer->display_customer_id }}</div>
                    <div><strong>نام:</strong> {{ $customer->name }}</div>

                    <div><strong>تلفن:</strong> {{ $customer->phone ?? '-' }}</div>
                    <div><strong>DISC:</strong> {{ $customer->DISC ?? '-' }}</div>
                    <div><strong>آدرس:</strong> {{ $customer->address ?? '-' }}</div>
                    <div><strong>دسته‌بندی:</strong> {{ $customer->category->name }}</div>
                    <div><strong>منبع:</strong> {{ $customer->referenceType->name }}</div>
{{--                    <div><strong>بازاریاب:</strong> {{ $customer->marketer->name }}</div>--}}
                </div>

                <div class="mt-6 flex justify-start space-x-reverse space-x-4">
                    <a href="{{ route('marketer.customers.edit', $customer) }}" class="px-4 py-2 text-black rounded-md hover:font-bold">ویرایش</a>
                    <a href="{{ route('marketer.customers.index') }}" class="px-4 py-2 text-black rounded-md hover:font-bold">بازگشت</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
