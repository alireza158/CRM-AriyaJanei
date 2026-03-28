<x-layouts.app>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <h2 class="fw-semibold fs-4 mb-0">مدیریت مشتریان</h2>
            <h3 class="mb-0">
                <a href="{{ route('marketer.customers.create') }}" class="btn btn-sm btn-primary">
                    ایجاد مشتری جدید
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm rounded-3">

                <div class="card-body">
                    <div class="mb-3">
                        <form action="{{ route('marketer.customers.index') }}" method="GET" class="d-flex gap-2">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="form-control" placeholder="جستجو بر اساس نام یا شماره تلفن...">
                            <button type="submit" class="btn btn-primary">جستجو</button>
                            <a href="{{ route('marketer.customers.export.excel') }}" class="btn btn-success">
                                خروجی اکسل مشتری‌ها
                            </a>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped align-middle text-start">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width:60px">#</th>
                                    <th scope="col">نام</th>

                                    <th scope="col">تلفن</th>
                                    <th scope="col">DISC</th>
                                    <th scope="col">آدرس</th>
                                    <th scope="col">منبع</th>
                                    <th scope="col" style="width:140px">فاکتور</th>
                                    <th scope="col" style="width:160px">یادداشت‌ها</th>
                                    <th scope="col" style="width:170px">عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $customer->name }}
                                            @if($customer->marketer_changed_at && \Carbon\Carbon::parse($customer->marketer_changed_at)->gt(now()->subDay()))
                                            <span class="badge bg-success ms-2">
                                                جدید
                                            </span>
                                        @endif

                                        </td>



                                        <td>{{ $customer->phone ?? '-' }}</td>
                                        <td>
                                            @switch($customer->DISC)
                                                @case('D')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold text-white bg-red-600">D</span>
                                                    @break
                                                @case('I')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold text-white bg-green-600">I</span>
                                                    @break
                                                @case('S')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold text-white bg-blue-600">S</span>
                                                    @break
                                                @case('C')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold text-white bg-purple-600">C</span>
                                                    @break
                                                @default
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold text-gray-600 bg-gray-200">هیچکدام</span>
                                            @endswitch
                                        </td>

                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->referenceType->name }}</td>
                                        <td>
                                            <a href="{{ route('marketer.invoices.index', ['customer' => $customer->id]) }}"
                                               class="btn btn-sm btn-outline-dark">
                                                مشاهده فاکتورها
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('marketer.customer.notes.index', [$customer->id])}}"
                                               class="btn btn-sm btn-outline-dark">
                                                مشاهده یادداشت‌ها
                                            </a>
                                        </td>
                                        <td class="d-flex gap-2">
                                            @if($customer->phone)
                                            <div class="dropdown">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $customer->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-telephone-forward"></i> ارتباط
                                                </button>
                                                <ul class="dropdown-menu text-end" aria-labelledby="dropdownMenuButton{{ $customer->id }}">

                                                    <!-- واتساپ -->
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                                           href="https://wa.me/{{ preg_replace('/^0/', '98', $customer->phone) }}"
                                                           target="_blank">
                                                            <i class="bi bi-whatsapp text-success fs-5"></i>
                                                            <span>واتساپ</span>
                                                        </a>
                                                    </li>

                                                    <!-- پیامک -->
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                                           href="sms:{{ $customer->phone }}">
                                                            <i class="bi bi-chat-dots text-warning fs-5"></i>
                                                            <span>پیامک</span>
                                                        </a>
                                                    </li>

                                                    <!-- تماس -->
                                                    <li>
                                                        <a class="dropdown-item d-flex align-items-center gap-2"
                                                           href="tel:{{ $customer->phone }}">
                                                            <i class="bi bi-telephone text-info fs-5"></i>
                                                            <span>تماس</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif

                                            <!-- دکمه ویرایش -->
                                            <a href="{{ route('marketer.customers.edit', $customer) }}" class="btn btn-primary">
                                                ویرایش
                                            </a>

                                            <!-- دکمه ارتباط با منو -->


                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            مشتری‌ای یافت نشد.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{-- صفحه‌بندی Bootstrap 5 --}}
                        {{ $customers->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

<!-- Bootstrap CSS -->
