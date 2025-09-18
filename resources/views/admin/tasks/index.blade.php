<x-app-layout>
    <div class="container mt-4">
        <h3 class="mb-4 font-semibold">📋 مدیریت تسک‌ها</h3>

        <a href="{{ route('admin.tasks.create') }}" class="btn btn-primary">ایجاد تسک جدید</a>
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>کاربر</th>
                    <th>عنوان</th>
                    <th>تاریخ</th>
                    <th>وضعیت</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->user->name }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ \Hekmatinasser\Verta\Verta::instance($task->date)->format('Y/m/d') }}</td>
                    <td>
                        @if($task->completed)
                            <span class="badge bg-success">انجام شد</span>
                        @else
                            <span class="badge bg-warning">در حال انجام</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
