<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2>لیست یادآورها</h2>
            <a href="{{ route('reminders.create') }}" class="btn btn-primary">ایجاد یادآور جدید</a>
        </div>
    </x-slot>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>عنوان</th>
                    <th>توضیحات</th>
                    <th>کاربر</th>
                    <th>زمان یادآور</th>
                    <th>تکرار</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reminders as $r)
                    <tr>
                        <td>{{ $r->title }}</td>
                        <td>{{ $r->description }}</td>
                        <td>{{ $r->user->name }}</td>
                        <td>{{ \Hekmatinasser\Verta\Verta::instance($r->remind_at)->format('Y/m/d H:i') }}</td>
                        <td>{{ ucfirst($r->repeat) }}</td>
                        <td>
                           {{--  <a href="{{ route('reminders.edit',$r->id) }}" class="btn btn-sm btn-info">ویرایش</a> --}}
                            <form action="{{ route('reminders.destroy',$r->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center">هیچ یادآوری ثبت نشده است</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $reminders->links() }}
    </div>
</x-app-layout>
