<x-layouts.app>
    <x-slot name="header">
        <div class="flex gap-4" dir="rtl">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                ایجاد گزارش جدید
            </h2>
            |
            <a href="{{ route('user.reports.index') }}">
                <p>بازگشت</p>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6" dir="rtl">

                @if(session('error'))
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-right">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-right">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('user.reports.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 text-right">عنوان</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-right">
                        @error('title')<p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 text-right">توضیحات</label>
                        <textarea name="description" id="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-right"></textarea>
                        @error('description')<p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="attachments" class="block text-sm font-medium text-gray-700 text-right">آپلود فایل‌ها</label>
                        <input type="file" name="attachments[]" id="attachments" multiple class="mt-1 block w-full text-right">
                        @error('attachments')<p class="text-red-500 text-sm mt-1 text-right">{{ $message }}</p>@enderror
                    </div>

                    <!-- پیش نمایش فایل‌ها -->
                    <div id="preview" class="mt-3 flex flex-wrap gap-3"></div>

                    <!-- Progress Bar -->
                    <div id="upload-progress-container" class="hidden mt-3">
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div id="upload-progress" class="bg-blue-500 h-3 rounded-full" style="width: 0%"></div>
                        </div>
                        <p id="upload-percent" class="text-sm mt-1 text-right">0%</p>
                    </div>

                    <div class="flex justify-start gap-4 mt-4">
                        <a href="{{ route('user.reports.index') }}">
                            <button type="button" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                بازگشت
                            </button>
                        </a>

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            ارسال نهایی
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layouts.app>

<script>
document.getElementById('attachments').addEventListener('change', function(event) {
    const preview = document.getElementById('preview');
    preview.innerHTML = "";

    Array.from(event.target.files).forEach(file => {
        const fileReader = new FileReader();

        if (file.type.startsWith('image/')) {
            fileReader.onload = () => {
                const img = document.createElement('img');
                img.src = fileReader.result;
                img.className = "w-20 h-20 object-cover rounded";
                preview.appendChild(img);
            };
            fileReader.readAsDataURL(file);
        } else {
            const fileIcon = document.createElement('div');
            fileIcon.className = "w-20 h-20 bg-gray-400 text-white flex items-center justify-center rounded";
            fileIcon.textContent = file.name.split('.').pop().toUpperCase();
            preview.appendChild(fileIcon);
        }
    });
});

document.querySelector('form').addEventListener('submit', function() {
    document.getElementById('upload-progress-container').classList.remove('hidden');
});
</script>
