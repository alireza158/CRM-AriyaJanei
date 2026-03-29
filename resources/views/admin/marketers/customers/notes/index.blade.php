<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">لیست یادداشت‌های مشتری: {{ $customer->name }} (شناسه: {{ $customer->display_customer_id }})</h2>
    </x-slot>

    <link href="https://lib.arvancloud.ir/bootstrap/5.3.0-alpha1/css/bootstrap.rtl.min.css" rel="stylesheet">

    <div class="container mt-4" dir="rtl">

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="row g-2">

                    <div class="col-md-3">
                        <a href="{{ route('admin.marketers.customers.notes.create', ['marketer' => $marketer->id, 'customer' => $customer->id]) }}"
                           class="btn btn-success w-100">
                            یادداشت جدید
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.marketers.customers.index', ['marketer' => $marketer->id]) }}"
                           class="btn btn-outline-secondary w-100">
                            بازگشت به مشتریان
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>محتوا</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($notes as $note)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $note->title }}</td>
                                <td>{{ Str::limit($note->content, 50) }}</td>
                                <td>{{ $note->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2 flex-wrap">
                                        <a href="{{ route('admin.marketers.customers.notes.show', [
                                            'marketer' => $marketer->id,
                                            'customer' => $customer->id,
                                            'note' => $note->id
                                        ]) }}"
                                           class="btn btn-sm btn-info">
                                            مشاهده
                                        </a>

                                        <a href="{{ route('admin.marketers.customers.notes.edit', [
                                            'marketer' => $marketer->id,
                                            'customer' => $customer->id,
                                            'note' => $note->id
                                        ]) }}"
                                           class="btn btn-sm btn-primary">
                                            ویرایش
                                        </a>

                                        <form action="{{ route('admin.marketers.customers.notes.destroy', [
                                            'marketer' => $marketer->id,
                                            'customer' => $customer->id,
                                            'note' => $note->id
                                        ]) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('آیا مطمئن هستید؟')"
                                                    class="btn btn-sm btn-danger">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-muted py-4">
                                    یادداشتی یافت نشد.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $notes->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
