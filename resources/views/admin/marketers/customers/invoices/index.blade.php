<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-3 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                فاکتورهای {{ ucfirst(__('admin.marketers')) }} / {{ $customer->name }} (شناسه: {{ $customer->display_customer_id }})
            </h2>
            |
            <h3>
                <a href="{{ route('admin.marketers.invoices.create', [$marketer, $customer]) }}" class="hover:underline">
                    فاکتور جدید
                </a>
            </h3>
                /
            <h3>
                <a href="{{ route('admin.marketers.customers.index',['marketer' => $marketer->id] ) }}" class=" hover:underline">
                    بازگشت به لیست فاکتور ها
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" dir="rtl">
                <table class="min-w-full table-auto border-collapse border border-gray-200 text-right">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-right">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">مشتری</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">تاریخ</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">مبلغ</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">توضیحات</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($invoices as $invoice)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $loop->iteration + ($invoices->currentPage()-1)*$invoices->perPage() }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $invoice->customer->name }} ({{ $invoice->customer->display_customer_id }})</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ \Morilog\Jalali\Jalalian::fromDateTime($invoice->invoice_date)->format('Y-m-d') }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ number_format($invoice->total_amount) }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ Str::limit($invoice->description, 30) }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right space-x-reverse space-x-2">
                                <a href="{{ route('admin.marketers.invoices.show', ['marketer'=>$marketer->id,'customer'=>$customer->id,'invoice'=>$invoice->id]) }}"
                                   class="text-blue-600 hover:underline">نمایش</a>
                                <a href="{{ route('admin.marketers.invoices.edit', ['marketer'=>$marketer->id,'customer'=>$customer->id,'invoice'=>$invoice->id]) }}"
                                   class="text-green-600 hover:underline">ویرایش</a>
                                <form action="{{ route('admin.marketers.invoices.destroy', ['marketer'=>$marketer->id,'customer'=>$customer->id,'invoice'=>$invoice->id]) }}"
                                      method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')"
                                            class="text-red-600 hover:underline bg-transparent p-0 m-0 border-none">
                                        حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-gray-500">فاکتوری یافت نشد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-4 text-center">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
