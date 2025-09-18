<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            جزئیات مشتری: {{ $customer->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 gap-4">
                    <div><strong>نام:</strong> {{ $customer->name }}</div>
                    <div><strong>ایمیل:</strong> {{ $customer->email ?? '-' }}</div>
                    <div><strong>تلفن:</strong> {{ $customer->phone ?? '-' }}</div>
                    <div><strong>آدرس:</strong> {{ $customer->address ?? '-' }}</div>
                    <div><strong>دسته‌بندی:</strong> {{ $customer->category->name }}</div>
                    <div><strong>منبع:</strong> {{ $customer->referenceType->name }}</div>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('marketer.customers.edit', $customer) }}" class="px-4 py-2  text-black rounded-md hover:font-bold">ویرایش</a>
                    <a href="{{ route('marketer.customers.index') }}" class="px-4 py-2  text-black rounded-md hover:font-bold">بازگشت</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
