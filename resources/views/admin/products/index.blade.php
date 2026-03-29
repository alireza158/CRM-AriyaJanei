<x-app-layout>
    <div class="container mt-4">

        <!-- اکشن‌ها -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('admin.syncUserProducts') }}" class="btn btn-warning">
                <i class="bi bi-arrow-repeat"></i> همگام‌سازی محصولات برای همه کاربران
            </a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> افزودن محصول
            </a>
            <a href="{{ route('admin.products.products') }}" class="btn btn-info text-white">
                <i class="bi bi-pencil-square"></i> ویرایش محصولات
            </a>
        </div>

        <!-- فرم انتخاب کاربر -->
        <form method="GET" action="{{ route('admin.commissions') }}" class="row g-2 mb-4 align-items-center">
            <div class="col-md-6">
                <select name="user_id" class="form-select">
                    <option value="">-- انتخاب کاربر --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i> نمایش
                </button>
            </div>
        </form>

        <!-- جدول پورسانت‌ها -->
        @if($selectedUser)
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">💰 پورسانت‌های {{ $selectedUser->name }}</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered mb-0 align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>محصول</th>
                                    <th>قیمت</th>
                                    <th>تعداد شرط</th>
                                    <th>درصد پورسانت</th>
                                    <th>تعداد فروش</th>
                                    <th>پورسانت نهایی</th>
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($selectedUser->userProducts as $up)
                                <tr>
                                    <td class="fw-bold">{{ $up->product->name }}</td>
                                    <td>{{ number_format($up->product->price, 0, '.', ',') }} تومان</td>
                                    <td>{{ $up->product->condition }}</td>
                                    <td><span class="badge bg-success">{{ $up->product->percent * 100 }}%</span></td>
                                    <td>{{ $up->sales }}</td>
                                    <td class="text-primary fw-bold">{{ number_format($up->commission) }}</td>
                                    <td>
                                        <form action="{{ route('admin.updateSales', $up) }}" method="POST" class="d-flex justify-content-center">
                                            @csrf
                                            @method('PUT')
                                            <input type="number"
                                                   name="sales"
                                                   value="{{ $up->sales }}"
                                                   class="form-control form-control-sm me-2 w-50 text-center"
                                                   placeholder="فروش">
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="bi bi-save"></i> ذخیره
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
