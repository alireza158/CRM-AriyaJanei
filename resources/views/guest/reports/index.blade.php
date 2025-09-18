{{--<x-layouts.app>--}}
{{--    <x-slot name="header">--}}
{{--        <div class="flex items-center gap-4">--}}
{{--            <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--                فهرست گزارش‌ها--}}
{{--            </h2>--}}
{{--            |--}}
{{--            <a href="{{ route('guest.reports.create') }}"--}}
{{--               class=" hover:underline">--}}
{{--                ایجاد گزارش جدید--}}
{{--            </a>--}}
{{--        </div>--}}
{{--    </x-slot>--}}

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
{{--            <div class="bg-white shadow-sm sm:rounded-lg p-6">--}}
{{--                @if(session('info'))--}}
{{--                    <div class="mb-4 p-4 rounded bg-yellow-100 text-yellow-800">--}}
{{--                        {{ session('info') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                @if(session('error'))--}}
{{--                    <div class="mb-4 p-4 rounded bg-yellow-100 text-yellow-800">--}}
{{--                        {{ session('error') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <table class="min-w-full table-auto border-collapse border border-gray-200">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th class="border border-gray-300 px-4 py-2">#</th>--}}
{{--                        <th class="border border-gray-300 px-4 py-2">عنوان</th>--}}
{{--                        <th class="border border-gray-300 px-4 py-2">توضیحات</th>--}}
{{--                        <th class="border border-gray-300 px-4 py-2">تاریخ ایجاد</th>--}}
{{--                        <th class="border border-gray-300 px-4 py-2">وضعیت</th>--}}
{{--                        <th class="border border-gray-300 px-4 py-2">عملیات</th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @forelse($reports as $report)--}}
{{--                        <tr>--}}
{{--                            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>--}}
{{--                            <td class="border border-gray-300 px-4 py-2">{{ $report->title ?? '-' }}</td>--}}
{{--                            <td class="border border-gray-300 px-4 py-2 truncate max-w-xs">{{ Str::limit($report->description, 50) }}</td>--}}
{{--                            <td class="border border-gray-300 px-4 py-2">{{ \Morilog\Jalali\Jalalian::fromDateTime($report->created_at)->format('Y-m-d') }}</td>--}}
{{--                            <td class="border border-gray-300 px-4 py-2 text-center">--}}
{{--                                @if($report->status === \App\Models\Report::STATUS_SUBMITTED)--}}
{{--                                    <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">خوانده نشده</span>--}}
{{--                                @elseif($report->status === \App\Models\Report::STATUS_READ)--}}
{{--                                    <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">خوانده شده</span>--}}
{{--                                @else--}}
{{--                                    <span class="inline-block px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">پیش‌نویس</span>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap">--}}
{{--                                <a href="{{ route('guest.reports.show', $report) }}"--}}
{{--                                   class="text-blue-600 hover:underline">مشاهده</a>--}}
{{--                                |--}}
{{--                                <a href="{{ route('guest.reports.edit', $report) }}"--}}
{{--                                   class="text-green-600 hover:underline">ویرایش</a>--}}
{{--                                |--}}
{{--                                <form action="{{ route('guest.reports.destroy', $report) }} "--}}
{{--                                      method="POST" class="inline">--}}
{{--                                    @csrf--}}
{{--                                    @method('post')--}}
{{--                                    <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')"--}}
{{--                                            class="text-red-600 hover:underline bg-transparent border-none p-0 m-0">--}}
{{--                                        حذف--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @empty--}}
{{--                        <tr>--}}
{{--                            <td colspan="5" class="text-center py-4 text-gray-500">گزارشی یافت نشد.</td>--}}
{{--                        </tr>--}}
{{--                    @endforelse--}}
{{--                    </tbody>--}}
{{--                </table>--}}

{{--                <div class="mt-4">--}}
{{--                    {{ $reports->links() }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</x-layouts.app>--}}

<x-reports.index
    :reports="$reports"
    prefix="guest"                                           
    :createLink="route('guest.reports.create')"
    :backLink="route('dashboard')"
    backLinkText="داشبورد"
    header="فهرست گزارشات"
/>
