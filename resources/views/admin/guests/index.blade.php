<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-3" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                مدیریت مهمانان
            </h2>
            <h3>
                <a href="{{ route('admin.guests.create') }}">ایجاد کاربر مهمان</a>
            </h3>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" dir="rtl">
                <table class="min-w-full table-auto border-collapse border border-gray-200 text-right">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-right">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">نام</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">تلفن</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">نقش</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">گزارشات</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($guests as $item)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $item->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $item->phone }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">
                                @foreach($item->getRoleNames() as $role)
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-1 px-2.5 py-0.5 rounded">
                                        {{ $role }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-right hover:font-bold">
                                <a href="{{ route('admin.reports.index', $item->id) }}">
                                    مشاهده گزارش
                                </a>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-right">
                                <a href="{{ route('admin.guests.edit', $item->id) }}" class="text-green-600 hover:underline">ویرایش</a>
                                |
                                <form action="{{ route('admin.guests.destroy', $item->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')" class="text-red-600 hover:underline bg-transparent border-none p-0 m-0">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @if($guests->isEmpty())
                    <p class="mt-4 text-center text-gray-500">کاربری یافت نشد.</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
