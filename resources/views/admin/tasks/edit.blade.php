<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ویرایش تسک
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">

                <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block font-medium text-gray-700">عنوان تسک</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium text-gray-700">توضیحات</label>
                        <textarea name="description" id="description" class="mt-1 block w-full border-gray-300 rounded-md">{{ old('description', $task->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block font-medium text-gray-700">تاریخ</label>
                        <input type="date" name="date" id="date" value="{{ old('date', \Carbon\Carbon::parse($task->date)->format('Y-m-d')) }}">

                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            ذخیره تغییرات
                        </button>
                        <a href="{{ route('admin.tasks.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                            بازگشت
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
