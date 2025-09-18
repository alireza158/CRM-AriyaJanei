<x-app-layout>
    <div class="container mt-5">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">📦 لیست محصولات</h5>
                <a href="{{ route('admin.products.create') }}" class="btn btn-light btn-sm">➕ افزودن محصول</a>
            </div>
            <div class="card-body">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>نام محصول</th>
                                <th>قیمت</th>
                                <th>تعداد شرط</th>
                                <th>درصد پورسانت</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td class="fw-bold">{{ $product->name }}</td>
                                <td>{{ number_format($product->price) }} <span class="text-muted">تومان</span></td>
                                <td>{{ $product->condition }}</td>
                                <td><span class="badge bg-success">{{ $product->percent * 100 }}%</span></td>
                                <td class="text-center">
                                    <a href="{{ route('admin.products.edit', $product) }}"
                                       class="btn btn-sm btn-warning me-1">✏️ ویرایش</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('آیا مطمئن هستی؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">🗑️ حذف</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <html lang="fa" dir="rtl">
</x-app-layout>
