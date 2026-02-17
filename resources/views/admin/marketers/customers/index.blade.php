<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4 items-center" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                مدیریت مشتریان
            </h2>
            |
            <h3>
                <a href="{{ route('admin.marketers.customers.create', ['marketer' => $marketer->id]) }}" class="hover:underline">
                    ایجاد مشتری جدید
                </a>
            </h3>
            \
            <h3>
                <a href="{{ route('admin.marketers.customers.export.excel', ['marketer' => $marketer->id]) }}" class="hover:underline text-green-700">
                    خروجی اکسل مشتری‌ها
                </a>
            </h3>
            |
            <h3>
                <a href="{{ route('admin.marketers.index') }}" class=" hover:underline">
                     بازگشت به لیست بازاریابان
                </a>
            </h3>
        </div>
    </x-slot>

    <div class="py-12" dir="rtl">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full table-auto border-collapse border border-gray-200 text-right">
                    <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-right">#</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">نام</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">ایمیل</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">تلفن</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">دسته‌بندی</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">منبع</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">بازاریاب</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">فاکتورها</th>
                        <th class="border px-4 py-2 text-right">یادداشت‌ها</th>
                        <th class="border border-gray-300 px-4 py-2 text-right">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $customer->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $customer->email ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $customer->phone ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $customer->category->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $customer->referenceType->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">{{ $marketer->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-right">
                                <a href="{{ route('admin.marketers.invoices.index', [$marketer->id, $customer->id]) }}"  class="text-blue-600 hover:font-bold">
                                    فاکتور
                                </a>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-right">
                                <a href="{{ route('admin.marketers.customers.notes.index', [$marketer->id, $customer->id])
                                    }}" class="text-blue-600 hover:font-bold">
                                    مشاهده یادداشت‌ها
                                </a>
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-right">
{{--                                <a href="{{ route('admin.marketers.customers.show', $customer) }}" class="text-blue-600 hover:underline">مشاهده</a>--}}
{{--                                |--}}
                                <a href="{{ route('admin.marketers.customers.edit', [
                                    'marketer' => $marketer->id,
                                    'customer'  => $customer->id,
                                    ]) }}" class="text-blue-600 hover:underline">
                                    ویرایش
                                </a>


                                |
                                <form action="{{ route('admin.marketers.customers.destroy', [
                                      'marketer' => $marketer->id,
                                      'customer'  => $customer->id
                                    ]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('آیا مطمئن هستید؟')"
                                            class="text-red-600 hover:underline bg-transparent border-none p-0 m-0">
                                        حذف
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4 text-gray-500">مشتری‌ای یافت نشد.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
