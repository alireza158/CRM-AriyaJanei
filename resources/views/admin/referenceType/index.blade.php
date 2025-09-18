<x-layouts.app>
    <x-slot name="header">
        <div class="d-flex gap-3 align-items-center justify-content-between" dir="rtl">
            <h2 class="fw-semibold">
                مدیریت نوع آشنایی (Reference Type)
            </h2>
            <h3>
                <a href="{{ route('admin.referenceType.create') }}" class="btn btn-primary btn-sm">
                    ایجاد نوع آشنایی جدید
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container" dir="rtl">
            <div class="card shadow-sm">
                <div class="card-body">
                    <table class="table table-bordered table-hover text-end align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>#</th>
                                <th>نام نوع آشنایی</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($referenceTypes as $referenceType)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $referenceType->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.referenceType.edit', $referenceType) }}" class="btn btn-success btn-sm me-1">
                                            ویرایش
                                        </a>
                                        <form action="{{ route('admin.referenceType.destroy', $referenceType) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')" class="btn btn-danger btn-sm">
                                                حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">
                                        نوع آشنایی‌ای یافت نشد.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

{{--                    <div class="mt-3">--}}
{{--                        {{ $referenceTypes->links() }}--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
