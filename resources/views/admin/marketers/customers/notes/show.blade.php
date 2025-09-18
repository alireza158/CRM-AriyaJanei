<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight font-vazir">
                نمایش یادداشت: {{ $note->title }}
            </h2>
            |
            <h3>
                <a href="{{ route('admin.marketers.customers.notes.index', ['marketer' => $marketer->id, 'customer' => $customer->id]) }}" class="hover:underline font-vazir">
                    بازگشت به لیست یادداشت‌ها
                </a>
            </h3>
            |
            <h3>
                <a href="{{ route('admin.marketers.customers.index', ['marketer' => $marketer->id]) }}" class="hover:underline font-vazir">
                    بازگشت به مشتریان
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-6">
                <div>
                    <h3 class="font-medium text-lg text-gray-700 font-vazir">عنوان:</h3>
                    <p class="text-gray-800 font-vazir">{{ $note->title }}</p>
                </div>
                <div>
                    <h3 class="font-medium text-lg text-gray-700 font-vazir">محتوا:</h3>
                    <p class="text-gray-800 whitespace-pre-line font-vazir">{{ $note->content }}</p>
                </div>
                <div>
                    <h3 class="font-medium text-lg text-gray-700 font-vazir">تاریخ ایجاد:</h3>
                    <p class="text-gray-800 font-vazir">{{ $note->created_at->format('Y-m-d H:i') }}</p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('admin.marketers.customers.notes.edit', ['marketer' => $marketer->id, 'customer' => $customer->id, 'note' => $note->id]) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded px-4 py-2 font-vazir">
                        ویرایش
                    </a>
                    <form action="{{ route('admin.marketers.customers.notes.destroy', ['marketer' => $marketer->id, 'customer' => $customer->id, 'note' => $note->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')"
                                class="bg-red-600 hover:bg-red-700 text-white font-medium rounded px-4 py-2 font-vazir">
                            حذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
