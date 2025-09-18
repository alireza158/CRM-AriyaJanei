<!DOCTYPE html>
<html lang="fa" dir="rtl">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // اگر لودر وجود دارد
    const loader = document.getElementById("global-loader");
    if(loader) {
        // بعد از کوتاه‌ترین زمان، لودر را مخفی کن
        setTimeout(() => {
            loader.style.opacity = "0";           // نرمال محو شود
            loader.style.pointerEvents = "none";  // کلیک‌پذیری حذف شود
            loader.style.transition = "opacity 0.3s ease";

            // بعد از انیمیشن، display:none کن
            setTimeout(() => {
                loader.style.display = "none";
            }, 300); // 300ms مطابق transition
        }, 100); // 100ms تا مطمئن شود DOM آماده است
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // اگر لودر وجود دارد
    const loader = document.getElementById("loader");
    if(loader) {
        // بعد از کوتاه‌ترین زمان، لودر را مخفی کن
        setTimeout(() => {
            loader.style.opacity = "0";           // نرمال محو شود
            loader.style.pointerEvents = "none";  // کلیک‌پذیری حذف شود
            loader.style.transition = "opacity 0.3s ease";

            // بعد از انیمیشن، display:none کن
            setTimeout(() => {
                loader.style.display = "none";
            }, 300); // 300ms مطابق transition
        }, 100); // 100ms تا مطمئن شود DOM آماده است
    }
});




    </script>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>آریا جانبی CRM</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
{{--    <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}
    <link rel="stylesheet" href="{{ asset('css/instrument-sans.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Vazirmatn.css') }}">
    <!-- Scripts -->
{{--    <script src="//unpkg.com/alpinejs" defer></script>--}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<!-- Loader -->
<div id="global-loader" class="position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white" style="z-index: 1050;">
    <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
        <span class="visually-hidden">در حال بارگذاری...</span>
    </div>
</div>

<div class="min-h-screen bg-gray-100">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
</div>
</body>
<script>

document.addEventListener('DOMContentLoaded', function() {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.addEventListener('click', function(e){
        const modal = e.target.closest('.modal');

        // افزودن یادداشت
        if(e.target.classList.contains('add-note') && modal){
            const customerId = modal.dataset.customer;
            const textarea = modal.querySelector('textarea');
            const content = textarea.value.trim();
            if(!content) return alert('محتوا نمی‌تواند خالی باشد');

            fetch(`/admin/customers/${customerId}/notes`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({content})
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    const ul = modal.querySelector('ul.list-group');
                    const li = document.createElement('li');
                    li.className = 'list-group-item d-flex justify-content-between';
                    li.dataset.id = data.note.id;
                    li.innerHTML = `
                        <span class="note-content">${data.note.content}</span>
                        <div>
                            <small class="text-muted">${data.note.creator} - ${data.note.created_at}</small>
                            <button class="btn btn-sm btn-warning edit-note">ویرایش</button>
                            <button class="btn btn-sm btn-danger delete-note">حذف</button>
                        </div>
                    `;
                    ul.prepend(li);
                    textarea.value = '';
                } else {
                    alert('ثبت یادداشت موفقیت‌آمیز نبود.');
                }
            }).catch(err => console.error(err));
        }

        // حذف یادداشت
        if(e.target.classList.contains('delete-note')){
            const li = e.target.closest('li[data-id]');
            if(!li) return;
            const noteId = li.dataset.id;
            if(!confirm('آیا مطمئن هستید؟')) return;

            fetch(`/admin/customers/notes/${noteId}`, {
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': token}
            }).then(res => res.json()).then(data => {
                if(data.success) li.remove();
                else alert('حذف یادداشت موفقیت‌آمیز نبود.');
            });
        }

        // ویرایش یادداشت
        if(e.target.classList.contains('edit-note')){
            const li = e.target.closest('li[data-id]');
            if(!li) return;
            const noteId = li.dataset.id;
            const oldContent = li.querySelector('.note-content').textContent;
            const newContent = prompt('ویرایش یادداشت:', oldContent);
            if(newContent === null) return;

            fetch(`/admin/customers/notes/${noteId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({content: newContent})
            }).then(res => res.json()).then(data => {
                if(data.success) li.querySelector('.note-content').textContent = data.content;
                else alert('ویرایش یادداشت موفقیت‌آمیز نبود.');
            });
        }
    });
});
    </script>
</html>
