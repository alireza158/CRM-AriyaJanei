<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-dark text-white text-center">
                <h4 class="m-0">📊 گزارش فعالیت‌ها</h4>
            </div>
            <div class="card-body">

                <!-- فیلتر و جستجو -->
                <form method="GET" action="{{ route('admin.activityLogs.index') }}" class="row g-2 mb-4">
                    <div class="col-md-3">
                        <input type="text" name="search" value="{{ $search }}" class="form-control"
                               placeholder="جستجو در عملیات یا مدل">
                    </div>
                    <div class="col-md-3">
                        <select name="user_id" class="form-select">
                            <option value="">همه کاربران</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ $userId == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="action" class="form-select">
                            <option value="">همه عملیات</option>
                            @foreach($actions as $act)
                                <option value="{{ $act }}" {{ $action == $act ? 'selected' : '' }}>
                                    {{ $act }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex">
                        <button type="submit" class="btn btn-primary me-2">🔍 جستجو</button>
                        <a href="{{ route('admin.activityLogs.index') }}" class="btn btn-secondary">♻️ ریست</a>
                    </div>
                </form>

                <!-- جدول لاگ‌ها -->
                <table class="table table-bordered table-striped table-hover text-center align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>کاربر</th>
                            <th>عملیات</th>
                            <th>مدل</th>
                            <th>تغییرات</th>
                            <th>تاریخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr>
                                <td>{{ $log->causer?->name ?? 'سیستم' }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ class_basename($log->subject_type) }} #{{ $log->subject_id }}</td>
                                <td>
                                    @if($log->properties)
                                        <pre class="text-start small bg-light p-2 rounded" style="max-height: 150px; overflow:auto;">
{{ json_encode($log->properties, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                                        </pre>
                                    @endif
                                </td>
                                <td>{{ jdate($log->created_at)->format('Y/m/d H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted">هیچ لاگی پیدا نشد</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $logs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
