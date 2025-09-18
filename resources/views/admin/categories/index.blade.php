<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-3 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                مدیریت دسته‌بندی‌ها
            </h2>
            <h3>
                <a href="{{ route('admin.categories.create') }}" class="hover:font-bold">
                    ایجاد دسته‌بندی جدید
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full table-auto border-collapse border border-gray-200 text-right">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-right">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">نام دسته‌بندی</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $category->name }}</td>

                            <td class="border border-gray-300 px-4 py-2 text-right">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-green-600 hover:underline">ویرایش</a>
                                |
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')" class="text-red-600 hover:underline bg-transparent border-none p-0 m-0">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">دسته‌بندی‌ای یافت نشد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
