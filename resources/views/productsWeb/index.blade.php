<x-layouts.app>
    <x-slot name="header">
        <h2 class="fw-bold h4">مدیریت محصولات</h2>
    </x-slot>

    <div class="container mt-4" dir="rtl">
        {{-- پیام موفقیت / خطا --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- جدول محصولات --}}
        <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">لیست محصولات</div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0 text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>نام محصول</th>
                            <th>تنوع‌ها</th>
                            <th>قیمت</th>
                            <th>تخفیف</th>
                            <th>قیمت نهایی</th>
                            <th>موجودی</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr class="table-primary">
                                <td colspan="6" class="text-start">
                                    <strong>{{ $product['title'] ?? '—' }}</strong>
                                    <small class="text-muted">({{ $product['slug'] ?? '' }})</small>
                                </td>
                            </tr>

                            @foreach($product['varieties'] ?? [] as $variety)
                            <tr>
                                <td>—</td>

                                {{-- نام تنوع یا ویژگی --}}
                                <td>
                                    @if(!empty($variety['name']))
                                        {{ $variety['name'] }}
                                    @elseif(!empty($variety['attributes']))
                                        @foreach($variety['attributes'] as $attribute)
                                            {{ $attribute['label'] ?? $attribute['name'] ?? '—' }}:
                                            {{ $attribute['pivot']['value'] ?? $attribute['value'] ?? '—' }}
                                        @endforeach
                                    @else
                                        —
                                    @endif
                                </td>

                                {{-- قیمت --}}
                                <td>{{ number_format($variety['price'] ?? $product['price'] ?? 0) }} تومان</td>

                                {{-- تخفیف --}}
                                <td>
                                    @php
                                        $discount = $variety['final_price']['discount'] ?? $product['major_final_price']['discount'] ?? 0;
                                    @endphp
                                    {{ $discount > 0 ? number_format($discount) . ' تومان' : '—' }}
                                </td>

                                {{-- قیمت نهایی --}}
                                <td>
                                    {{ number_format($variety['final_price']['final_price'] ?? $product['major_final_price']['final_price'] ?? $variety['price'] ?? $product['price'] ?? 0) }}
                                </td>

                                {{-- موجودی --}}
                                <td>{{ $variety['quantity'] ?? 0 }}</td>
                            </tr>
                        @endforeach



                            @if(empty($product['varieties']))
                                <tr>
                                    <td>—</td>
                                    <td>—</td>
                                    <td>{{ number_format($product['price'] ?? 0) }} تومان</td>
                                    <td>{{ ($product['major_final_price']['discount'] ?? 0) > 0 ? number_format($product['major_final_price']['discount']) . ' تومان' : '—' }}</td>
                                    <td>{{ number_format($product['major_final_price']['final_price'] ?? $product['price'] ?? 0) }} تومان</td>
                                    <td>—</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="6">هیچ محصولی موجود نیست.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- صفحه‌بندی --}}
        <div class="mt-3 d-flex justify-content-center">
            <nav>
                <ul class="pagination">
                    {{-- دکمه صفحه قبلی --}}
                    <li class="page-item {{ $pagination['current_page'] <= 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] - 1]) }}">قبلی</a>
                    </li>

                    {{-- شماره صفحات --}}
                    @for($i = 1; $i <= $pagination['last_page']; $i++)
                        <li class="page-item {{ $pagination['current_page'] == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- دکمه صفحه بعد --}}
                    <li class="page-item {{ $pagination['current_page'] >= $pagination['last_page'] ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ request()->fullUrlWithQuery(['page' => $pagination['current_page'] + 1]) }}">بعدی</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</x-layouts.app>
