<x-layouts.app>
    <x-slot name="header">ویرایش مدیر</x-slot>

    <div class="p-6 bg-white shadow rounded" dir="rtl">
        <form method="POST" action="{{ route('admin.users.updateManager',$manager->id) }}">
            @csrf @method('PUT')

            <div>
                <label>نام:</label>
                <input type="text" name="name" value="{{ $manager->name }}" class="border p-2 w-full">
            </div>

            <div class="mt-2">
                <label>شماره تلفن:</label>
                <input type="text" name="phone" value="{{ $manager->phone }}" class="border p-2 w-full">
            </div>

            <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">بروزرسانی</button>
        </form>
    </div>
</x-layouts.app>
