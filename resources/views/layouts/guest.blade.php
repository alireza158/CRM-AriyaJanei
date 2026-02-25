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

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
{{--        <link rel="preconnect" href="https://fonts.bunny.net">--}}
{{--        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />--}}

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('css/instrument-sans.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [data-bs-theme="dark"] body {
                background-color: #0f172a;
                color: #e2e8f0;
            }

            [data-bs-theme="dark"] .bg-white,
            [data-bs-theme="dark"] .bg-gray-100 {
                background-color: #1e293b !important;
                color: #e2e8f0 !important;
            }

            [data-bs-theme="dark"] .text-gray-900,
            [data-bs-theme="dark"] .text-gray-800,
            [data-bs-theme="dark"] .text-gray-700,
            [data-bs-theme="dark"] .text-gray-600,
            [data-bs-theme="dark"] .text-gray-500 {
                color: #e2e8f0 !important;
            }

            [data-bs-theme="dark"] input {
                background-color: #334155 !important;
                border-color: #475569 !important;
                color: #f8fafc !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased" dir="rtl">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="max-w-md px-6 mb-3">
                <button
                    type="button"
                    data-theme-toggle
                    class="w-full inline-flex items-center justify-center gap-2 rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    aria-label="تغییر تم"
                >
                    <span data-theme-icon aria-hidden="true">🌙</span>
                    <span data-theme-label>تم تیره</span>
                </button>
            </div>
            <div>
                <a href="/">
                    <div class="" style="
                    display: flex;
                    justify-content: center; /* افقی */
                    /* align-items: center; */     /* عمودی */
                    height: 200px;
                ">
                            <img src="logo.png" alt="Flowers in Chania">

                        </div>

                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toggles = document.querySelectorAll('[data-theme-toggle]');
                const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';

                const getNextTheme = (theme) => (theme === 'dark' ? 'light' : 'dark');

                const syncToggles = (theme) => {
                    const nextTheme = getNextTheme(theme);

                    toggles.forEach((toggle) => {
                        const icon = toggle.querySelector('[data-theme-icon]');
                        const label = toggle.querySelector('[data-theme-label]');

                        if (icon) {
                            icon.textContent = nextTheme === 'dark' ? '🌙' : '☀️';
                        }

                        if (label) {
                            label.textContent = nextTheme === 'dark' ? 'تم تیره' : 'تم روشن';
                        }
                    });
                };

                syncToggles(currentTheme);

                toggles.forEach((toggle) => {
                    toggle.addEventListener('click', function () {
                        const activeTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
                        const selectedTheme = getNextTheme(activeTheme);

                        document.documentElement.setAttribute('data-bs-theme', selectedTheme);
                        localStorage.setItem('theme', selectedTheme);
                        syncToggles(selectedTheme);
                    });
                });
            });
        </script>
    </body>
</html>
