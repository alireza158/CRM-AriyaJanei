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
                                    <th scope="col">دسته‌بندی</th>
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

                                        <td>{{ $customer->category->name }}</td>
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
                                            <a href="{{ route('marketer.customers.edit', $customer) }}"
                                               class="btn btn-primary">
                                                ویرایش
                                            </a>

                                            <form action="{{ route('marketer.customers.destroy', $customer) }}"
                                                  method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        onclick="return confirm('آیا از حذف {{ $customer->name }} مطمئن هستید؟')"
                                                        class="btn  btn-danger">
                                                    حذف
                                                </button>
                                            </form>
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
