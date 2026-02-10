<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center gap-5" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                فاکتورهای مشتری: {{ $customer->name }}
            </h2>
            |
            <a href="{{ route('marketer.invoices.create', ['customer' => $customer->id]) }}"
               class="text-gray-700 hover:text-gray-900">
                فاکتور جدید
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" dir="rtl">
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border border-gray-200 text-right">
                        <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 px-4 py-2">#</th>
                            <th class="border border-gray-300 px-4 py-2">تاریخ</th>
                            <th class="border border-gray-300 px-4 py-2">توضیحات</th>
                            <th class="border border-gray-300 px-4 py-2">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoices as $invoice)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ \Morilog\Jalali\Jalalian::fromDateTime($invoice->invoice_date)->format('Y/m/d') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ Str::limit($invoice->description, 50) ?: '-' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2 flex gap-2 justify-center">
                                    <a href="{{ route('marketer.invoices.show', ['customer' => $customer->id, 'invoice' => $invoice->id]) }}"
                                       class="text-blue-600 hover:underline">نمایش</a>
                                 <form action="{{ route('marketer.invoices.destroy', ['customer' => $customer->id, 'invoice' => $invoice->id]) }}"
      method="POST"
      class="inline-block"
      onsubmit="return confirm('آیا مطمئن هستید می‌خواهید فاکتور حذف شود؟');">

    @csrf
    @method('DELETE')

    <button type="submit" class="text-red-600 hover:underline">
        حذف فاکتور
    </button>
</form>

                                  
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-gray-500">هیچ فاکتوری یافت نشد.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
