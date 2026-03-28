<x-layouts.app>
    <x-slot name="header">
        <div class="d-flex align-items-center gap-3">
            <h2 class="fw-semibold fs-4 mb-0">
                لیست یادداشت‌های مشتری: {{ $customer->name }}
            </h2>
            |
            <h3>
                <a href="{{ route('marketer.customer.notes.create', [ 'customer' => $customer->id]) }}" class="btn btn-sm btn-success">
                    یادداشت جدید
                </a>
            </h3>
            |
            <h3>
          <a href="{{ session('customers_previous_url', route('marketer.customers.index')) }}" class="btn btn-sm btn-dark">
    بازگشت به مشتریان
</a>


            </h3>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped align-middle text-start">
                            <thead class="table-light">
                                <tr>
                        <th scope="col">#</th>
                        <th scope="col">محتوا</th>
                        <th scope="col">تاریخ</th>
                        <!--<  th scope="col">عملیات</th> -->
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($notes as $note)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $loop->iteration }}</td>

                            <td class="border border-gray-300 px-4 py-2 text-right">{{ Str::limit($note->content, 50) }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $note->created_at->format('Y-m-d') }}</td>


                                                             <td class="border border-gray-300 px-4 py-2 text-right">

                                                                <a href="{{ route('marketer.customer.notes.show', [ 'customer' => $customer->id, 'note' => $note->id]) }}" style="color: white" class="btn btn-warning">مشاهده</a>

                                @php
                                // بررسی اینکه از زمان ایجاد کمتر از 2 ساعت گذشته
                                $canEditOrDelete = $note->created_at->gt(now()->subHours(2));
                            @endphp

                            @if($canEditOrDelete)
                                <a href="{{ route('marketer.customer.notes.edit', [ 'customer' => $customer->id, 'note' => $note->id]) }}" class="btn btn-primary">ویرایش</a>
                                |
                                <form action="{{ route('marketer.customer.notes.destroy', [ 'customer' => $customer->id, 'note' => $note->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')" class="btn btn-danger">حذف</button>
                                </form>
                            @endif

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">یادداشتی یافت نشد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $notes->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
<html lang="fa" dir="rtl">
