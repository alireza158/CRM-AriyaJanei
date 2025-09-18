<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4 items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                نمایش یادداشت: {{ $note->title }}
            </h2>
            |
            <h3>
                <a href="{{ route('marketer.customer.notes.index', ['customer' => $customer->id]) }}" class="hover:underline">
                    بازگشت به لیست یادداشت‌ها
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6 text-right">

                <div>
                    <h3 class="font-medium text-lg text-gray-700">محتوا:</h3>
                    <p class="text-gray-800 whitespace-pre-line text-justify">{{ $note->content }}</p>
                </div>
                <div>
                    <h3 class="font-medium text-lg text-gray-700">تاریخ ایجاد:</h3>
                    <p class="text-gray-800">{{ $note->created_at->format('Y-m-d H:i') }}</p>
                </div>
                <!--
                <div class="flex gap-4 justify-start">
                    <a href="{{ route('marketer.customer.notes.edit', ['customer' => $customer->id, 'note' => $note->id]) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded px-4 py-2">
                        ویرایش
                    </a>
                    <form action="{{ route('marketer.customer.notes.destroy', ['customer' => $customer->id, 'note' => $note->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')"
                                class="bg-red-600 hover:bg-red-700 text-white font-medium rounded px-4 py-2">
                            حذف
                        </button>
                    </form>
                </div>
                  -->
            </div>
        </div>
    </div>
</x-layouts.app>
