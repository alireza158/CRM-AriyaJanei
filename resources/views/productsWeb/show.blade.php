<x-layouts.app>
    <x-slot name="header">
        <h2 class="fw-bold h4">جزئیات محصول</h2>
    </x-slot>

    <div class="container mt-4" dir="rtl">
        @if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

        <div class="mb-3">
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-sm">بازگشت</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">
                {{ $product['title'] ?? '—' }}
                <small class="text-muted">({{ $product['slug'] ?? '' }})</small>
            </div>
            <div class="card-body">
                @php
                    $pBase  = data_get($product, '__pricing.base', 0);
                    $pFinal = data_get($product, '__pricing.final', $pBase);
                    $pDisc  = data_get($product, '__pricing.discount', max(0, $pBase - $pFinal));
                @endphp

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <div class="mb-2"><strong>دسته:</strong> {{ $product['__category_name'] ?? '—' }}</div>
                        <div class="mb-2"><strong>قیمت پایه:</strong> {{ number_format($pBase) }} تومان</div>
                        <div class="mb-2"><strong>تخفیف:</strong> {{ $pDisc > 0 ? number_format($pDisc).' تومان' : '—' }}</div>
                        <div class="mb-2"><strong>قیمت نهایی:</strong> {{ number_format($pFinal) }} تومان</div>
                    </div>

                    <div class="col-12 col-md-6">
                        @php $attributes = data_get($product, 'attributes') ?? data_get($product, 'specs') ?? []; @endphp
                        @if(!empty($attributes))
                            <div class="card">
                                <div class="card-header">مشخصات</div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        @foreach($attributes as $attr)
                                            <li class="mb-1">
                                                <strong>{{ $attr['label'] ?? $attr['name'] ?? '—' }}:</strong>
                                                <span>{{ data_get($attr, 'pivot.value') ?? ($attr['value'] ?? '—') }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if(!empty($product['varieties']))
                    <hr>
                    <h6 class="fw-bold mb-3">تنوع‌ها</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th>نام/ویژگی</th>
                                    <th>قیمت پایه</th>
                                    <th>تخفیف</th>
                                    <th>قیمت نهایی</th>
                                    <th>موجودی</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product['varieties'] as $variety)
                                    @php
                                        $vBase  = data_get($variety, '__pricing.base', 0);
                                        $vFinal = data_get($variety, '__pricing.final', $vBase);
                                        $vDisc  = data_get($variety, '__pricing.discount', max(0, $vBase - $vFinal));
                                    @endphp
                                    <tr>
                                        <td>
                                            @if(!empty($variety['name']))
                                                {{ $variety['name'] }}
                                            @elseif(!empty($variety['attributes']))
                                                @foreach($variety['attributes'] as $attribute)
                                                    {{ $attribute['label'] ?? $attribute['name'] ?? '—' }}:
                                                    {{ data_get($attribute, 'pivot.value') ?? ($attribute['value'] ?? '—') }}
                                                    @if(!$loop->last) | @endif
                                                @endforeach
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ number_format($vBase) }} تومان</td>
                                        <td>{{ $vDisc > 0 ? number_format($vDisc).' تومان' : '—' }}</td>
                                        <td>{{ number_format($vFinal) }} تومان</td>
                                        <td>{{ $variety['quantity'] ?? 0 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-layouts.app>
