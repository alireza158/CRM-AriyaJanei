<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4 items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ویرایش یادداشت: {{ $note->title }}
            </h2>
            |
            <h3>
                <a href="{{ route('marketer.customer.notes.show', ['customer' => $customer->id, 'note' => $note->id]) }}" class="hover:underline">
                    بازگشت به نمایش
                </a>
            </h3>
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
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('marketer.customer.notes.update', ['customer' => $customer->id, 'note' => $note->id]) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <!-- محتوا -->
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-medium mb-2 text-right">محتوا:</label>
                        <textarea name="content" id="content" rows="5"
                                  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 text-right"
                                  dir="rtl">{{ old('content', $note->content) }}</textarea>
                        @error('content')
                        <p class="text-red-600 text-sm mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- دکمه بروزرسانی -->
                    <div class="flex justify-start">
                        <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white font-medium rounded px-5 py-2">
                            ذخیره تغییرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
