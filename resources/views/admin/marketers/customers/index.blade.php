<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">مدیریت مشتریان</h2>
    </x-slot>

    <link href="https://lib.arvancloud.ir/bootstrap/5.3.0-alpha1/css/bootstrap.rtl.min.css" rel="stylesheet">

    <div class="container mt-4" dir="rtl">

        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <div class="row g-2">

                    <div class="col-md-3">
                        <a href="{{ route('admin.marketers.customers.create', ['marketer' => $marketer->id]) }}"
                           class="btn btn-success w-100">
                            مشتری جدید
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.marketers.customers.export.excel', ['marketer' => $marketer->id]) }}"
                           class="btn btn-outline-success w-100">
                            خروجی اکسل مشتری‌ها
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.marketers.index') }}"
                           class="btn btn-outline-secondary w-100">
                            بازگشت به لیست بازاریابان
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
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>تلفن</th>
                            <th>دسته‌بندی</th>
                            <th>منبع</th>
                            <th>فاکتورها</th>
                            <th>یادداشت‌ها</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email ?? '-' }}</td>
                                <td>{{ $customer->phone ?? '-' }}</td>
                                <td>{{ $customer->category->name ?? '-' }}</td>
                                <td>{{ $customer->referenceType->name ?? '-' }}</td>

                                <td>
                                    <a href="{{ route('admin.marketers.invoices.index', [$marketer->id, $customer->id]) }}"
                                       class="btn btn-sm btn-info">
                                        فاکتور
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('admin.marketers.customers.notes.index', [$marketer->id, $customer->id]) }}"
                                       class="btn btn-sm btn-primary">
                                        مشاهده یادداشت‌ها
                                    </a>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.marketers.customers.edit', [
                                            'marketer' => $marketer->id,
                                            'customer' => $customer->id,
                                        ]) }}"
                                           class="btn btn-sm btn-primary">
                                            ویرایش
                                        </a>

                                        <form action="{{ route('admin.marketers.customers.destroy', [
                                            'marketer' => $marketer->id,
                                            'customer' => $customer->id
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
                                <td colspan="9" class="text-muted py-4">
                                    مشتری‌ای یافت نشد.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-3">
                    {{ $customers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>