<!DOCTYPE html>
<html lang="fa" dir="rtl" data-bs-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script>
            (function () {
                const storedTheme = localStorage.getItem('theme');
                const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                const theme = storedTheme || systemTheme;

                document.documentElement.setAttribute('data-bs-theme', theme);
            })();
        </script>

        <title>{{ config('app.name', 'آریا جانبی CRM') }}</title>

{{--        <!-- Fonts -->--}}
{{--        <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}
<link href="https://lib.arvancloud.ir/bootstrap/5.3.0-alpha1/css/bootstrap.rtl.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/instrument-sans.css') }}">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased" dir="rtl">
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
    <script src="https://lib.arvancloud.ir/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
<style>
    :root {
        --radius: 16px;

        /* Light tokens */
        --dash-bg-from: #f6f7fb;
        --dash-bg-mid:  #ffffff;
        --dash-bg-to:   #ffffff;

        --surface: #ffffff;
        --border: rgba(15,23,42,.08);

        --text: #0f172a;
        --muted: #64748b;

        --shadow: 0 12px 30px rgba(15,23,42,.08);

        --scroll-thumb: rgba(0,0,0,.15);
        --progress-bg: rgba(2,6,23,.08);

        --input-bg: #ffffff;
        --input-border: rgba(15,23,42,.16);
        --table-striped: rgba(15,23,42,.03);
        --hover-bg: rgba(15,23,42,.04);
    }

    /* Dark tokens (Bootstrap 5.3 theme attribute) */
    [data-bs-theme="dark"] {
        --dash-bg-from: #0b1220;
        --dash-bg-mid:  #0b1220;
        --dash-bg-to:   #0b1220;

        --surface: rgba(255,255,255,.04);
        --border: rgba(148,163,184,.18);

        --text: #e2e8f0;
        --muted: #94a3b8;

        --shadow: 0 12px 30px rgba(0,0,0,.35);

        --scroll-thumb: rgba(255,255,255,.16);
        --progress-bg: rgba(255,255,255,.10);

        --input-bg: rgba(15,23,42,.45);
        --input-border: rgba(148,163,184,.28);
        --table-striped: rgba(148,163,184,.08);
        --hover-bg: rgba(148,163,184,.10);
    }

    html,
    body {
        background-color: var(--dash-bg-from);
        color: var(--text);
    }

    [data-bs-theme="dark"] body,
    [data-bs-theme="dark"] .bg-gray-100,
    [data-bs-theme="dark"] .bg-light,
    [data-bs-theme="dark"] .bg-white {
        background-color: var(--surface) !important;
        color: var(--text) !important;
    }

    .dash-wrap {
        background: linear-gradient(180deg, var(--dash-bg-from) 0%, var(--dash-bg-mid) 50%, var(--dash-bg-to) 100%);
    }

    .card-soft {
        border: 3px solid var(--border);
        border-radius: var(--radius);
        transition: .2s ease;
        background: var(--surface);
    }
    .card-soft:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .icon { width: 22px; height: 22px; }
    .icon-wrap { width: 44px; height: 44px; border-radius: 14px; display:flex; align-items:center; justify-content:center; }

    /* هماهنگ‌سازی عمومی رنگ‌ها با توکن‌ها */
    .bg-white { background-color: var(--surface) !important; }
    .text-dark,
    .link-dark { color: var(--text) !important; }
    .text-muted { color: var(--muted) !important; }
    .border,
    .border-bottom,
    .border-top,
    .border-start,
    .border-end { border-color: var(--border) !important; }


    /* Tailwind utilities used in pages */
    [data-bs-theme="dark"] .bg-gray-50,
    [data-bs-theme="dark"] .bg-gray-100,
    [data-bs-theme="dark"] .bg-gray-200,
    [data-bs-theme="dark"] .table-light {
        background-color: var(--hover-bg) !important;
        color: var(--text) !important;
    }

    [data-bs-theme="dark"] .text-gray-900,
    [data-bs-theme="dark"] .text-gray-800,
    [data-bs-theme="dark"] .text-gray-700,
    [data-bs-theme="dark"] .text-gray-600,
    [data-bs-theme="dark"] .text-gray-500 {
        color: var(--text) !important;
    }


    [data-bs-theme="dark"] .text-blue-600 { color: #93c5fd !important; }
    [data-bs-theme="dark"] .text-green-600 { color: #86efac !important; }
    [data-bs-theme="dark"] .text-purple-600 { color: #c4b5fd !important; }

    [data-bs-theme="dark"] .hover\:bg-gray-50:hover,
    [data-bs-theme="dark"] .hover\:bg-gray-100:hover {
        background-color: var(--hover-bg) !important;
    }

    .card,
    .table,
    .table thead,
    .table tbody,
    .table tfoot {
        --bs-table-bg: transparent;
        --bs-table-striped-bg: var(--table-striped);
        --bs-table-color: var(--text);
        --bs-table-border-color: var(--border);
    }

    /* لیست‌ها */
    .list-group-item,
    .dropdown-menu,
    .dropdown-item {
        background: transparent;
        color: var(--text);
        border-color: var(--border);
    }

    .dropdown-item:hover,
    .dropdown-item:focus,
    .list-group-item:hover {
        background: var(--hover-bg);
        color: var(--text);
    }

    .table,
    .table > :not(caption) > * > * {
        color: var(--text);
        border-color: var(--border);
    }

    .table-striped > tbody > tr:nth-of-type(odd) > * {
        --bs-table-accent-bg: var(--table-striped);
        color: var(--text);
    }

    /* Progress */
    .progress { background-color: var(--progress-bg); }

    .form-control,
    .form-select,
    .input-group-text,
    textarea,
    input {
        background-color: var(--input-bg) !important;
        color: var(--text) !important;
        border-color: var(--input-border) !important;
    }

    .form-control::placeholder,
    .form-select::placeholder,
    textarea::placeholder,
    input::placeholder {
        color: var(--muted) !important;
    }

    .form-control:focus,
    .form-select:focus,
    textarea:focus,
    input:focus {
        box-shadow: 0 0 0 .2rem rgba(59,130,246,.20) !important;
        border-color: rgba(59,130,246,.55) !important;
    }

    .navbar,
    .nav,
    .offcanvas,
    .accordion-item,
    .accordion-button,
    .alert {
        border-color: var(--border) !important;
    }

    .accordion-button,
    .offcanvas,
    .modal-content {
        background-color: var(--surface);
        color: var(--text);
    }

    .pagination .page-link {
        background-color: var(--surface);
        color: var(--text);
        border-color: var(--border);
    }

    .pagination .page-item.active .page-link {
        background-color: #3b82f6;
        border-color: #3b82f6;
        color: #fff;
    }

    /* Scrollbar */
    .soft-scroll::-webkit-scrollbar{ width: 8px; }
    .soft-scroll::-webkit-scrollbar-thumb{ background: var(--scroll-thumb); border-radius: 999px; }
    .soft-scroll::-webkit-scrollbar-track{ background: transparent; }

    /* Badges (Light) */
    .badge-purple{ background:#ede9fe; color:#5b21b6; }
    .badge-pink{ background:#fce7f3; color:#9d174d; }
    .badge-indigo{ background:#e0e7ff; color:#3730a3; }
    .badge-teal{ background:#ccfbf1; color:#115e59; }
    .badge-orange{ background:#ffedd5; color:#9a3412; }

    /* Badges (Dark tweaks for better contrast) */
    [data-bs-theme="dark"] .badge-purple{ background: rgba(139,92,246,.18); color:#ddd6fe; }
    [data-bs-theme="dark"] .badge-pink{ background: rgba(236,72,153,.18); color:#fbcfe8; }
    [data-bs-theme="dark"] .badge-indigo{ background: rgba(99,102,241,.18); color:#c7d2fe; }
    [data-bs-theme="dark"] .badge-teal{ background: rgba(20,184,166,.18); color:#99f6e4; }
    [data-bs-theme="dark"] .badge-orange{ background: rgba(249,115,22,.18); color:#fed7aa; }

    /* Bootstrap modal + SweetAlert2 in dark */
    [data-bs-theme="dark"] .modal-content { background: #0f172a; color: var(--text); border: 1px solid var(--border); }
    [data-bs-theme="dark"] .modal-header { border-bottom-color: var(--border); }
    [data-bs-theme="dark"] .modal-footer { border-top-color: var(--border); }
    [data-bs-theme="dark"] .btn-close { filter: invert(1) grayscale(100%) brightness(180%); }

    [data-bs-theme="dark"] .swal2-popup { background: #0f172a !important; color: var(--text) !important; border: 1px solid var(--border); }
    [data-bs-theme="dark"] .swal2-title { color: var(--text) !important; }
    [data-bs-theme="dark"] .swal2-html-container { color: var(--muted) !important; }
    [data-bs-theme="dark"] .swal2-footer { color: var(--muted) !important; border-top-color: var(--border) !important; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const switchers = document.querySelectorAll('[data-theme-switcher]');
        const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';

        const syncSwitchers = (theme) => {
            switchers.forEach((switcher) => {
                switcher.value = theme;
            });
        };

        syncSwitchers(currentTheme);

        switchers.forEach((switcher) => {
            switcher.addEventListener('change', function (event) {
                const selectedTheme = event.target.value;

                document.documentElement.setAttribute('data-bs-theme', selectedTheme);
                localStorage.setItem('theme', selectedTheme);
                syncSwitchers(selectedTheme);
            });
        });
    });
</script>

</html>
