<!-- <x-layouts.app>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                فهرست گزارش‌ها
            </h2>
            <a href="{{ route('admin.reports.create', $user) }}"
               class=" hover:underline">
                ایجاد گزارش جدید
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full table-auto border-collapse border border-gray-200">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">عنوان</th>
                        <th class="border border-gray-300 px-4 py-2">توضیحات</th>
                        <th class="border border-gray-300 px-4 py-2">تاریخ ایجاد</th>
                        <th class="border border-gray-300 px-4 py-2">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $report->title ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 truncate max-w-xs">{{ Str::limit($report->description, 50) }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $report->created_at->format('Y-m-d') }}</td>
                            <td class="border border-gray-296 px-4 py-2 whitespace-nowrap">
{{--                                <a href="{{ route(\Auth::user()->hasRole('Admin') ? 'admin.reports.show' : (\Auth::user()->hasRole('Marketer') ? 'marketer.reports.show' : 'guest.reports.show'),--}}
{{--                                        (\Auth::user()->hasRole('Admin') ? ['report_id' => $report->id, 'user_id' => $user->id] : ['report_id' => $report->id])) }}"--}}
{{--                                   class="text-blue-600 hover:underline">مشاهده</a>--}}
                                |
{{--                                <a href="{{ route(\Auth::user()->hasRole('Admin') ? 'admin.reports.edit' : (\Auth::user()->hasRole('Marketer') ? 'marketer.reports.edit' : 'guest.reports.edit'),--}}
{{--                                        (\Auth::user()->hasRole('Admin') ? ['report' => $report->id, 'user_id' => $user->id] : ['report' => $report->id])) }}"--}}
{{--                                   class="text-green-600 hover:underline">ویرایش</a>--}}
                                |
{{--                                <form action="{{ route(\Auth::user()->hasRole('Admin') ? 'admin.reports.destroy' : (\Auth::user()->hasRole('Marketer') ? 'marketer.reports.destroy' : 'guest.reports.destroy'),--}}
{{--                                        (\Auth::user()->hasRole('Admin') ? ['report' => $report->id, 'user_id' => $user->id] : ['report' => $report->id])) }}"--}}
{{--                                      method="POST" class="inline">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')"--}}
{{--                                            class="text-red-600 hover:underline bg-transparent border-none p-0 m-0">--}}
{{--                                        حذف--}}
{{--                                    </button>--}}
{{--                                </form>--}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">گزارشی یافت نشد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app> -->
