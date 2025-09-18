<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4 items-center">


            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ایجاد یادداشت جدید برای: {{ $customer->name }}
            </h2>
            |
            <h3>
                <a href="{{ route('marketer.customer.notes.index', ['customer' => $customer->id]) }}" class="hover:underline">
                    بازگشت به لیست یادداشت‌ها
                </a>
            </h3>
            |
            <h3>
                <a href="{{ route('marketer.customers.index') }}" class="hover:underline">
                    بازگشت به مشتریان
                </a>
            </h3>
            |
            <h3>
                <a href="{{ route('marketer.customers.create') }}" class="hover:underline">
                   ایجاد مشتری جدید
                </a>
            </h3>
        </div>
    </x-slot>
    @if (session('success'))
    <div id="toast"
         class="fixed bottom-4 right-4 bg-green-500 text-black px-4 py-2 rounded shadow-lg z-50">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('toast').remove();
        }, 8000); // بعد ۴ ثانیه محو بشه
    </script>
@endif
    <div class="py-12" dir="rtl">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

                <form action="{{ route('marketer.customer.notes.store', ['customer' => $customer->id]) }}" method="POST">
                    @csrf


                    <!-- محتوا -->
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700 font-medium mb-2 text-right">محتوا:</label>
                        <textarea name="content" id="content" rows="5"
                                  class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 text-right"
                                  dir="rtl">{{ old('content') }}</textarea>
                        @error('content')
                        <p class="text-red-600 text-sm mt-1 text-right">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- دکمه ارسال -->
                    <div class="flex justify-start">
                        <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium rounded px-5 py-2">
                            ذخیره یادداشت
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>
