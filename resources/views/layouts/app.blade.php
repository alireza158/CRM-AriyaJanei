<!DOCTYPE html>
<html lang="fa" dir="rtl" data-bs-theme="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
    }

    .dash-wrap {
        background: linear-gradient(180deg, var(--dash-bg-from) 0%, var(--dash-bg-mid) 50%, var(--dash-bg-to) 100%);
    }

    .card-soft {
        border: 1px solid var(--border);
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

    /* فقط داخل داشبورد: bg-white / text-dark / text-muted را با توکن‌ها هماهنگ کن */
    .dash-wrap .bg-white { background-color: var(--surface) !important; }
    .dash-wrap .text-dark { color: var(--text) !important; }
    .dash-wrap .text-muted { color: var(--muted) !important; }
    .dash-wrap .border-bottom { border-bottom-color: var(--border) !important; }

    /* لیست‌ها */
    .dash-wrap .list-group-item {
        background: transparent;
        color: var(--text);
        border-color: var(--border);
    }

    /* Progress */
    .dash-wrap .progress { background-color: var(--progress-bg); }

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

    [data-bs-theme="dark"] .swal2-popup { background: #0f172a !important; color: var(--text) !important; border: 1px solid var(--border); }
    [data-bs-theme="dark"] .swal2-title { color: var(--text) !important; }
    [data-bs-theme="dark"] .swal2-html-container { color: var(--muted) !important; }
    [data-bs-theme="dark"] .swal2-footer { color: var(--muted) !important; border-top-color: var(--border) !important; }
</style>

</html>
