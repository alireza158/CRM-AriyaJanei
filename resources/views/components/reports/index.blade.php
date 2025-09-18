@props([
    'reports',
    'prefix',
    'user' => null,
    'createLink' => null,
    'backLink' => null,
    'backLinkText' => null,
    'header' => 'فهرست گزارش‌ها',
])

<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $header }}
            </h2>

            {{-- Back Link --}}
            @if(!empty($backLink))
                |
                <p>
                    <a href="{{ $backLink }}" class="hover:underline">
                        {{ $backLinkText }}
                    </a>
                </p>
            @endif

            {{-- Create Link --}}
            @if(!empty($createLink))
                |
                <a href="{{ $createLink }}" class="hover:underline">
                    ایجاد گزارش جدید
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                {{-- Flash Messages --}}
                @if(session('info'))
                    <div class="mb-4 p-4 rounded bg-yellow-100 text-yellow-800 text-right">
                        {{ session('info') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 p-4 rounded bg-yellow-100 text-yellow-800 text-right">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="mb-4 p-4 rounded bg-green-100 text-green-800 text-right">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Reports Table --}}
                <table class="min-w-full table-auto border-collapse border border-gray-200" dir="rtl">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-right">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">عنوان</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">توضیحات</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">تاریخ ایجاد</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">وضعیت</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($reports as $report)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $report->title ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right truncate max-w-xs">{{ Str::limit($report->description, 50) }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ \Morilog\Jalali\Jalalian::fromDateTime($report->created_at)->format('Y-m-d') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                @if($report->status === \App\Models\Report::STATUS_SUBMITTED)
                                    <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">خوانده نشده</span>
                                @elseif($report->status === \App\Models\Report::STATUS_READ)
                                    <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">خوانده شده</span>
                                @else
                                    <span class="inline-block px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">پیش‌نویس</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2 whitespace-nowrap text-right">
                                {{-- Operation Links --}}
                                @if($user)
                                    <a href="{{ route($prefix . '.reports.show', [$report, $user]) }}" class="text-blue-600 hover:underline">مشاهده</a>
                                    |
                                    <a href="{{ route($prefix . '.reports.edit', [$report, $user]) }}" class="text-green-600 hover:underline">ویرایش</a>
                                    |
                                    <form action="{{ route($prefix . '.reports.destroy', [$report, $user]) }}" method="POST" class="inline" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                        @csrf
                                        @method('post')
                                        <button type="submit" class="text-red-600 hover:underline bg-transparent border-none p-0 m-0">حذف</button>
                                    </form>
                                @else
                                    <a href="{{ route($prefix . '.reports.show', $report) }}" class="text-blue-600 hover:underline">مشاهده</a>
                                    |
                                    <a href="{{ route($prefix . '.reports.edit', $report) }}" class="text-green-600 hover:underline">ویرایش</a>
                                    |
                                    <form action="{{ route($prefix . '.reports.destroy', $report) }}" method="POST" class="inline" onsubmit="return confirm('آیا مطمئن هستید؟')">
                                        @csrf
                                        @method('post')
                                        <button type="submit" class="text-red-600 hover:underline bg-transparent border-none p-0 m-0">حذف</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">گزارشی یافت نشد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-4 text-right">
                    {{ $reports->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
