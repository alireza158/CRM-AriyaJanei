<x-layouts.app>
    <div class="container mt-5">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">✏️ ویرایش محصول</h5>
            </div>
            <div class="card-body">

                <form method="POST" action="{{ route('admin.products.update', $product) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">نام محصول</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $product->name) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">قیمت</label>
                        <input type="text"
                               id="price"
                               name="price"
                               value="{{ old('price', number_format($product->price ?? 0)) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">تعداد شرط</label>
                        <input type="number"
                               name="condition"
                               value="{{ old('condition', $product->condition) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">درصد پورسانت (%)</label>
                        <input type="number"
                               step="0.01"
                               name="percent"
                               value="{{ old('percent', $product->percent * 100) }}"
                               class="form-control"
                               required>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">❌ انصراف</a>
                        <button type="submit" class="btn btn-success">💾 ذخیره تغییرات</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <html lang="fa" dir="rtl">
    <script>
    const priceInput = document.getElementById('price');

    priceInput.addEventListener('input', function(e) {
        let cursorPosition = e.target.selectionStart;
        let rawValue = e.target.value.replace(/,/g, '');

        if (rawValue === '' || isNaN(rawValue)) {
            e.target.value = '';
            return;
        }

        let formattedValue = parseInt(rawValue).toLocaleString('en-US');
        e.target.value = formattedValue;

        let newCursorPosition = formattedValue.length - (rawValue.length - cursorPosition);
        e.target.setSelectionRange(newCursorPosition, newCursorPosition);
    });
    </script>
</x-layouts.app>
