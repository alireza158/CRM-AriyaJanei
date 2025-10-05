<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">ایجاد فرم ارزیابی جدید</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('admin.evaluations.forms.store') }}" class="space-y-6">
                @csrf

                {{-- عنوان فرم --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-2">عنوان فرم</label>
                    <input type="text" name="title" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-indigo-200 focus:outline-none"
                        placeholder="مثال: ارزیابی عملکرد ماهانه">
                </div>

                {{-- نقش ارزیابی‌کننده --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-2">نقش ارزیابی‌کننده</label>
                    <select name="evaluator_role" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-indigo-200 focus:outline-none">
                        <option value="">انتخاب کنید...</option>
                        <option value="ITUser">IT - کارمند</option>
                        <option value="ITManager">IT - مدیر</option>
                        <option value="StorageUser">انبار - کارمند</option>
                        <option value="StorageManager">انبار - مدیر</option>
                        <option value="SaleUser">فروش - کارمند</option>
                        <option value="SaleManager">فروش - مدیر</option>
                        <option value="MarketerUser">مارکتر - کارمند</option>
                        <option value="MarketerManager">مارکتر - مدیر</option>
                        <option value="InternalManager">مدیر داخلی</option>
                        <option value="Owner">مدیر کل</option>
                          <option value="User">کارمند</option>
                    </select>
                </div>

                {{-- نقش ارزیابی‌شونده --}}
                <div>
                    <label class="block text-gray-700 font-medium mb-2">نقش ارزیابی‌شونده</label>
                    <select name="target_role" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring focus:ring-indigo-200 focus:outline-none">
                        <option value="">انتخاب کنید...</option>
                        <option value="ITUser">IT - کارمند</option>
                        <option value="ITManager">IT - مدیر</option>
                        <option value="StorageUser">انبار - کارمند</option>
                        <option value="StorageManager">انبار - مدیر</option>
                        <option value="SaleUser">فروش - کارمند</option>
                        <option value="SaleManager">فروش - مدیر</option>
                        <option value="MarketerUser">مارکتر - کارمند</option>
                        <option value="MarketerManager">مارکتر - مدیر</option>
                        <option value="InternalManager">مدیر داخلی</option>
                        <option value="Owner">مدیر کل</option>
                         <option value="User">کارمند</option>
                    </select>
                </div>

                {{-- دکمه ثبت --}}
             <div class="flex justify-center mt-4">
    <button type="submit" 
        class="btn btn-success bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
        ثبت فرم
    </button>
</div>


            </form>
        </div>
    </div>
</x-app-layout>
