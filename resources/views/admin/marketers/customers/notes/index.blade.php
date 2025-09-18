<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                لیست یادداشت‌های مشتری: {{ $customer->name }}
            </h2>
            |
            <h3>
                <a href="{{ route('admin.marketers.customers.notes.create', ['marketer' => $marketer->id, 'customer' => $customer->id]) }}" class="hover:underline">
                    یادداشت جدید
                </a>
            </h3>
            |
            <h3>
                <a href="{{ route('admin.marketers.customers.index', ['marketer' => $marketer->id]) }}" class="hover:underline">
                    بازگشت به مشتریان
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
                        <th class="border border-gray-300 px-4 py-2 text-right">عنوان</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">محتوا</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">تاریخ</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($notes as $note)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $note->title }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ Str::limit($note->content, 50) }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $note->created_at->format('Y-m-d') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">
                                <a href="{{ route('admin.marketers.customers.notes.show', ['marketer' => $marketer->id, 'customer' => $customer->id, 'note' => $note->id]) }}" class="text-blue-600 hover:underline">مشاهده</a>
                                |
                                <a href="{{ route('admin.marketers.customers.notes.edit', ['marketer' => $marketer->id, 'customer' => $customer->id, 'note' => $note->id]) }}" class="text-yellow-600 hover:underline">ویرایش</a>
                                |
                                <form action="{{ route('admin.marketers.customers.notes.destroy', ['marketer' => $marketer->id, 'customer' => $customer->id, 'note' => $note->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')" class="text-red-600 hover:underline bg-transparent border-none p-0 m-0">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">یادداشتی یافت نشد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $notes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
