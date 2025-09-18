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
                    <th>عملیات</th>
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
                    <td>
                        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">ویرایش</a>

                        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" class="d-inline" onsubmit="return confirm('آیا مطمئن هستید؟');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

</x-app-layout>
