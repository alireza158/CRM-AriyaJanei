<x-layouts.app>
    <div class="container mt-5">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">➕ ایجاد محصول جدید</h5>
            </div>
            <div class="card-body">

                <form method="POST" action="{{ route('admin.products.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">نام محصول</label>
                        <input type="text" name="name" class="form-control" placeholder="مثلاً: گوشی آیفون 15" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">قیمت کالا</label>
                        <input type="text" id="price" name="price" class="form-control" placeholder="مثلاً: 25,000,000" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تعداد شرط</label>
                        <input type="number" name="condition" class="form-control" placeholder="مثلاً: 10" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">درصد پورسانت (%)</label>
                        <input type="number" name="percent" step="0.01" class="form-control" placeholder="مثلاً: 5" required>
                    </div>



                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            ❌ انصراف
                        </a>
                        <button type="submit" class="btn btn-success">
                            💾 ایجاد محصول
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const priceInput = document.getElementById('price');

        priceInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/[^0-9.]/g, '');
            const parts = value.split('.');
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            e.target.value = parts.join('.');
        });
    </script>
</x-layouts.app>
