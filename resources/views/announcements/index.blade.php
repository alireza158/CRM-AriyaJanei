<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مدیریت اطلاعیه‌ها
        </h2>
    </x-slot>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">لیست اطلاعیه‌ها</h4>

            @if(auth()->user()->hasAnyRole(['Admin', 'internalManager', 'InternalManager']))
                <a href="{{ route('announcements.create') }}" class="btn btn-primary">
                    ایجاد اطلاعیه جدید
                </a>
            @endif
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>متن</th>
                                <th>ثبت‌کننده</th>
                                <th>وضعیت</th>
                                <th>تاریخ ثبت (شمسی)</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($announcements as $announcement)
                                <tr>
                                    <td>{{ $announcement->title }}</td>
                                    <td>{{ $announcement->message }}</td>
                                    <td>{{ $announcement->creator?->name ?? '---' }}</td>
                                    <td>
                                        @if($announcement->is_active)
                                            <span class="badge bg-success">فعال</span>
                                        @else
                                            <span class="badge bg-secondary">غیرفعال</span>
                                        @endif
                                    </td>
                                    <td>{{ \Hekmatinasser\Verta\Verta::instance($announcement->created_at)->format('Y/m/d H:i') }}</td>
                                    <td>
                                        @if(auth()->user()->hasAnyRole(['Admin', 'internalManager', 'InternalManager']))
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a href="{{ route('announcements.edit', $announcement) }}" class="btn btn-sm btn-outline-primary">ویرایش</a>

                                                <form method="POST" action="{{ route('announcements.toggleActive', $announcement) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm {{ $announcement->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                                        {{ $announcement->is_active ? 'غیرفعال‌سازی' : 'فعال‌سازی' }}
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('announcements.destroy', $announcement) }}" onsubmit="return confirm('از حذف این اطلاعیه مطمئن هستید؟');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">هنوز اطلاعیه‌ای ثبت نشده است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            {{ $announcements->links() }}
        </div>
    </div>
</x-app-layout>
