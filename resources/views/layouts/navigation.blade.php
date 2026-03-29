@php
    $announcementsCount = $headerAnnouncements->count();
    $notificationsCount = $headerNotificationsUnseenCount ?? 0;
@endphp

<style>
    .glass-header {
        --gh-font: "Vazirmatn", "IRANSansX", "Yekan Bakh", Tahoma, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;

        --gh-bg: #f6f9ff;
        --gh-bg-solid: #ffffff;
        --gh-surface: #ffffff;
        --gh-surface-2: #f8fbff;
        --gh-surface-3: #eef5ff;

        --gh-border: rgba(15, 23, 42, .08);
        --gh-border-strong: rgba(15, 23, 42, .12);

        --gh-text: #0f172a;
        --gh-muted: #64748b;
        --gh-soft-text: #475569;

        --gh-shadow-sm: 0 8px 20px rgba(15, 23, 42, .05);
        --gh-shadow-md: 0 16px 40px rgba(15, 23, 42, .08);
        --gh-shadow-lg: 0 24px 70px rgba(15, 23, 42, .16);

        --gh-primary: #2563eb;
        --gh-primary-2: #3b82f6;
        --gh-violet: #8b5cf6;
        --gh-cyan: #06b6d4;
        --gh-red: #ef4444;

        --gh-btn-bg: rgba(255, 255, 255, .92);
        --gh-btn-hover: #f8fbff;
        --gh-btn-border: rgba(15, 23, 42, .08);

        --gh-card-bg: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
        --gh-card-border: rgba(148, 163, 184, .22);

        --gh-empty-bg: linear-gradient(180deg, #ffffff 0%, #f7fbff 100%);
        --gh-empty-border: #dbeafe;

        --gh-badge-primary-bg: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        --gh-badge-primary-text: #ffffff;

        --gh-badge-danger-bg: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --gh-badge-danger-text: #ffffff;

        --gh-new-bg: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        --gh-new-text: #b91c1c;

        --gh-modal-bg: #ffffff;
        --gh-modal-header-bg: linear-gradient(135deg, #ffffff 0%, #f5f9ff 100%);
        --gh-modal-body-bg: linear-gradient(180deg, #f8fbff 0%, #fdfefe 100%);
        --gh-modal-footer-bg: #ffffff;

        font-family: var(--gh-font);
        background:
            radial-gradient(circle at top right, rgba(59, 130, 246, .08), transparent 24%),
            radial-gradient(circle at top left, rgba(139, 92, 246, .06), transparent 20%),
            linear-gradient(180deg, rgba(255, 255, 255, .88) 0%, rgba(255, 255, 255, .96) 100%);
        background-color: var(--gh-bg-solid);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid var(--gh-border);
        box-shadow: var(--gh-shadow-sm);
        position: sticky;
        top: 0;
        z-index: 1030;
    }

    .glass-header,
    .glass-header * {
        font-family: var(--gh-font);
    }

    html.dark .glass-header,
    body.dark .glass-header,
    .dark .glass-header,
    html[data-bs-theme="dark"] .glass-header,
    body[data-bs-theme="dark"] .glass-header,
    [data-bs-theme="dark"] .glass-header {
        --gh-bg: #08111f;
        --gh-bg-solid: #0b1220;
        --gh-surface: #0f172a;
        --gh-surface-2: #111c31;
        --gh-surface-3: #15233b;

        --gh-border: rgba(148, 163, 184, .16);
        --gh-border-strong: rgba(148, 163, 184, .22);

        --gh-text: #eef4ff;
        --gh-muted: #94a3b8;
        --gh-soft-text: #cbd5e1;

        --gh-shadow-sm: 0 10px 24px rgba(0, 0, 0, .24);
        --gh-shadow-md: 0 18px 42px rgba(0, 0, 0, .28);
        --gh-shadow-lg: 0 26px 80px rgba(0, 0, 0, .38);

        --gh-primary: #60a5fa;
        --gh-primary-2: #3b82f6;
        --gh-violet: #a78bfa;
        --gh-cyan: #22d3ee;
        --gh-red: #f87171;

        --gh-btn-bg: rgba(17, 28, 49, .92);
        --gh-btn-hover: #17243c;
        --gh-btn-border: rgba(148, 163, 184, .15);

        --gh-card-bg: linear-gradient(180deg, #13203a 0%, #0f172a 100%);
        --gh-card-border: rgba(148, 163, 184, .14);

        --gh-empty-bg: linear-gradient(180deg, #13203a 0%, #10192c 100%);
        --gh-empty-border: rgba(96, 165, 250, .22);

        --gh-badge-primary-bg: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        --gh-badge-primary-text: #ffffff;

        --gh-badge-danger-bg: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);
        --gh-badge-danger-text: #ffffff;

        --gh-new-bg: linear-gradient(135deg, rgba(239, 68, 68, .18) 0%, rgba(220, 38, 38, .14) 100%);
        --gh-new-text: #fda4af;

        --gh-modal-bg: #0f172a;
        --gh-modal-header-bg: linear-gradient(135deg, #111c31 0%, #0f172a 100%);
        --gh-modal-body-bg: linear-gradient(180deg, #0d1628 0%, #10192d 100%);
        --gh-modal-footer-bg: #111c31;

        background:
            radial-gradient(circle at top right, rgba(96, 165, 250, .10), transparent 24%),
            radial-gradient(circle at top left, rgba(167, 139, 250, .08), transparent 20%),
            linear-gradient(180deg, rgba(8, 14, 26, .92) 0%, rgba(11, 18, 32, .98) 100%);
        background-color: var(--gh-bg-solid);
    }

    .glass-header-row {
        min-height: 76px;
    }

    .glass-header-logo {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 50px;
        padding-left: 8px;
    }

    .glass-header-logo img {
        max-height: 42px;
        width: auto;
        display: block;
    }

    .glass-header-dashboard-btn {
        height: 46px;
        border-radius: 16px !important;
        padding-inline: 16px !important;
        font-weight: 800;
        letter-spacing: 0;
        box-shadow: 0 12px 24px rgba(37, 99, 235, .18);
    }

    .glass-header-icon-btn,
    .glass-header-user-btn,
    .glass-header-theme-btn {
        background: var(--gh-btn-bg) !important;
        border: 1px solid var(--gh-btn-border) !important;
        color: var(--gh-text) !important;
        transition: all .25s ease;
        box-shadow: 0 8px 16px rgba(15, 23, 42, .05);
    }

    .glass-header-icon-btn:hover,
    .glass-header-user-btn:hover,
    .glass-header-theme-btn:hover {
        background: var(--gh-btn-hover) !important;
        border-color: var(--gh-border-strong) !important;
        color: var(--gh-text) !important;
        transform: translateY(-1px);
        box-shadow: 0 14px 26px rgba(15, 23, 42, .08);
    }

    .glass-header-icon-btn {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 17px !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 0 !important;
        overflow: visible;
    }

    .glass-header-icon-btn i {
        font-size: 1.15rem;
        line-height: 1;
    }

    .glass-header-badge {
        position: absolute;
        top: -7px;
        right: -7px;
        min-width: 24px;
        height: 24px;
        padding: 0 6px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 900;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--gh-bg-solid);
        box-shadow: 0 10px 18px rgba(0, 0, 0, .14);
    }

    .glass-header-badge-primary {
        background: var(--gh-badge-primary-bg);
        color: var(--gh-badge-primary-text);
    }

    .glass-header-badge-danger {
        background: var(--gh-badge-danger-bg);
        color: var(--gh-badge-danger-text);
    }

    .glass-header-user-btn {
        min-height: 46px;
        border-radius: 16px !important;
        padding-inline: 14px !important;
        font-weight: 700;
    }

    .glass-header-user-btn svg {
        fill: currentColor;
        opacity: .95;
    }

    .glass-header-mobile-toggle {
        color: var(--gh-muted);
        border: 1px solid transparent;
    }

    .glass-header-mobile-toggle:hover {
        color: var(--gh-text);
        background: var(--gh-btn-hover);
        border-color: var(--gh-btn-border);
    }

    .glass-header-mobile-menu {
        background:
            radial-gradient(circle at top right, rgba(59, 130, 246, .05), transparent 24%),
            linear-gradient(180deg, var(--gh-surface) 0%, var(--gh-surface-2) 100%);
        border-top: 1px solid var(--gh-border);
    }

    .glass-header-mobile-divider {
        border-top: 1px solid var(--gh-border);
    }

    .glass-header-user-name {
        color: var(--gh-text);
        font-weight: 800;
    }

    .glass-header-user-email {
        color: var(--gh-muted);
    }

    .glass-header-modal .modal-dialog {
        max-width: 960px;
    }

    .glass-header-modal .modal-content {
       
        border: 1px solid var(--gh-border) !important;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: var(--gh-shadow-lg);
    }

    .glass-header-modal .modal-header {
        background: var(--gh-modal-header-bg) !important;
        color: var(--gh-text) !important;
        border-bottom: 1px solid var(--gh-border) !important;
        padding: 1.15rem 1.25rem;
        position: relative;
        overflow: hidden;
    }

    .glass-header-modal .modal-header::before {
        content: "";
        position: absolute;
        left: -30px;
        bottom: -65px;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(59, 130, 246, .18) 0%, transparent 70%);
        pointer-events: none;
    }

    .glass-header-modal .modal-header::after {
        content: "";
        position: absolute;
        right: -25px;
        top: -70px;
        width: 190px;
        height: 190px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139, 92, 246, .16) 0%, transparent 70%);
        pointer-events: none;
    }

    .glass-header-modal .modal-body {
        background:
            radial-gradient(circle at top right, rgba(59, 130, 246, .06), transparent 22%),
            radial-gradient(circle at top left, rgba(139, 92, 246, .05), transparent 18%),
            var(--gh-modal-body-bg) !important;
        color: var(--gh-text) !important;
        max-height: 74vh;
        overflow-y: auto;
        padding: 1.15rem;
    }

    .glass-header-modal .modal-footer {
        background: var(--gh-modal-footer-bg) !important;
        color: var(--gh-text) !important;
        border-top: 1px solid var(--gh-border) !important;
        padding: 1rem 1.25rem;
    }

    .glass-header-modal .modal-title,
    .glass-header-modal .fw-bold,
    .glass-header-modal .text-end {
        color: var(--gh-text) !important;
    }

    .glass-header-modal .text-muted,
    .glass-header-modal .small {
        color: var(--gh-muted) !important;
    }

    .glass-header-modal .btn-close {
        opacity: 1;
        position: relative;
        z-index: 2;
    }

    html.dark .glass-header-modal .btn-close,
    body.dark .glass-header-modal .btn-close,
    .dark .glass-header-modal .btn-close,
    html[data-bs-theme="dark"] .glass-header-modal .btn-close,
    body[data-bs-theme="dark"] .glass-header-modal .btn-close,
    [data-bs-theme="dark"] .glass-header-modal .btn-close {
        filter: invert(1) grayscale(100%);
    }

    .glass-header-modal-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        width: 100%;
        position: relative;
        z-index: 2;
    }

    .glass-header-modal-side {
        display: flex;
        align-items: center;
        gap: .9rem;
    }

    .glass-header-modal-icon {
        width: 54px;
        height: 54px;
        min-width: 54px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--gh-text);
        background:
            linear-gradient(135deg, rgba(59, 130, 246, .14) 0%, rgba(139, 92, 246, .14) 100%);
        border: 1px solid rgba(99, 102, 241, .16);
        box-shadow: 0 12px 26px rgba(15, 23, 42, .08);
    }

    .glass-header-modal-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 38px;
        padding: 0 .95rem;
        border-radius: 999px;
        background: var(--gh-btn-bg);
        border: 1px solid var(--gh-btn-border);
        color: var(--gh-muted);
        font-size: 12px;
        font-weight: 900;
        white-space: nowrap;
        box-shadow: var(--gh-shadow-sm);
    }

    .glass-header-list {
        display: grid;
        gap: 1rem;
    }

    .glass-header-item {
        position: relative;
        background: var(--gh-card-bg) !important;
        border: 1px solid var(--gh-card-border) !important;
        border-radius: 24px;
        padding: 1.05rem 1rem 1rem 1.1rem;
        box-shadow: var(--gh-shadow-md);
        overflow: hidden;
        transition: all .28s ease;
    }

    .glass-header-item::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 5px;
        background: linear-gradient(180deg, var(--gh-primary) 0%, var(--gh-violet) 55%, var(--gh-cyan) 100%);
    }

    .glass-header-item::after {
        content: "";
        position: absolute;
        left: auto;
        right: -45px;
        bottom: -45px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(59, 130, 246, .08) 0%, transparent 70%);
        pointer-events: none;
    }

    .glass-header-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 22px 44px rgba(15, 23, 42, .12);
        border-color: var(--gh-border-strong) !important;
    }

    .glass-header-item-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: .9rem;
        margin-bottom: .55rem;
    }

    .glass-header-item-title {
        font-size: 15px;
        font-weight: 900;
        color: var(--gh-text);
        margin: 0;
        line-height: 2;
    }

    .glass-header-item-text {
        font-size: 13.5px;
        line-height: 2.15;
        color: var(--gh-soft-text);
        white-space: pre-line;
        margin-top: .2rem;
    }

    .glass-header-item-meta {
        display: flex;
        flex-wrap: wrap;
        gap: .55rem;
        margin-top: .9rem;
    }

    .glass-header-chip {
        display: inline-flex;
        align-items: center;
        gap: .42rem;
        background: var(--gh-btn-bg);
        border: 1px solid var(--gh-btn-border);
        color: var(--gh-muted);
        border-radius: 999px;
        padding: .5rem .8rem;
        font-size: 12px;
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(15, 23, 42, .04);
    }

    .glass-header-item-new {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 50px;
        height: 29px;
        border-radius: 999px;
        padding: 0 .82rem;
        font-size: 11px;
        font-weight: 900;
        background: var(--gh-new-bg);
        color: var(--gh-new-text);
        white-space: nowrap;
        border: 1px solid rgba(239, 68, 68, .14);
        box-shadow: 0 8px 16px rgba(239, 68, 68, .08);
    }

    .glass-header-empty {
        position: relative;
        overflow: hidden;
        background: var(--gh-empty-bg) !important;
        border: 1px dashed var(--gh-empty-border) !important;
        border-radius: 26px;
        padding: 2.4rem 1rem;
        text-align: center;
    }

    .glass-header-empty::before {
        content: "";
        position: absolute;
        left: -50px;
        bottom: -55px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(59, 130, 246, .10) 0%, transparent 70%);
        pointer-events: none;
    }

    .glass-header-empty::after {
        content: "";
        position: absolute;
        right: -50px;
        top: -55px;
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(139, 92, 246, .08) 0%, transparent 70%);
        pointer-events: none;
    }

    .glass-header-empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 14px;
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(59, 130, 246, .12) 0%, rgba(139, 92, 246, .12) 100%);
        border: 1px solid rgba(99, 102, 241, .14);
        color: var(--gh-text);
        font-size: 1.4rem;
        box-shadow: var(--gh-shadow-sm);
        position: relative;
        z-index: 2;
    }

    .glass-header-empty-title {
        color: var(--gh-text);
        font-size: 15px;
        font-weight: 900;
        margin-bottom: .35rem;
        position: relative;
        z-index: 2;
    }

    .glass-header-empty-text {
        color: var(--gh-muted);
        font-size: 13px;
        line-height: 2;
        position: relative;
        z-index: 2;
    }

    .glass-header-modal .modal-body::-webkit-scrollbar {
        width: 10px;
    }

    .glass-header-modal .modal-body::-webkit-scrollbar-track {
        background: transparent;
    }

    .glass-header-modal .modal-body::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, .35);
        border-radius: 999px;
    }

    .glass-header-modal .modal-body::-webkit-scrollbar-thumb:hover {
        background: rgba(148, 163, 184, .48);
    }

    @media (max-width: 639.98px) {
        .glass-header-row {
            min-height: 64px;
        }

        .glass-header-logo {
            height: 40px;
            padding-left: 5px;
        }

        .glass-header-logo img {
            max-height: 34px;
        }

        .glass-header-icon-btn {
            width: 42px;
            height: 42px;
            min-width: 42px;
            border-radius: 14px !important;
        }

        .glass-header-dashboard-btn {
            height: 39px;
            padding-inline: 10px !important;
            font-size: 13px;
        }

        .glass-header-modal .modal-dialog {
            max-width: 100%;
            margin: 0;
        }

        .glass-header-modal .modal-content {
            min-height: 100vh;
            border-radius: 0;
        }

        .glass-header-modal .modal-header,
        .glass-header-modal .modal-footer {
            padding-inline: .95rem;
        }

        .glass-header-modal .modal-body {
            max-height: none;
            flex: 1 1 auto;
            padding: .95rem;
        }

        .glass-header-modal-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
            border-radius: 16px;
        }

        .glass-header-item {
            border-radius: 20px;
            padding: .95rem .9rem .95rem 1rem;
        }

        .glass-header-item-title {
            font-size: 14px;
        }

        .glass-header-item-text {
            font-size: 13px;
        }

        .glass-header-item-new {
            min-width: 46px;
            height: 27px;
        }
    }
</style>

<nav x-data="{ open: false }" class="glass-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center glass-header-row">
            <div class="flex items-center gap-3">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <div class="glass-header-logo">
                            <img src="{{ asset('logo.png') }}" alt="Logo">
                        </div>
                    </a>
                </div>

                <a href="{{ route('dashboard') }}"
                   class="btn btn-primary d-none d-sm-inline-flex align-items-center gap-2 glass-header-dashboard-btn {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>داشبورد</span>
                </a>
            </div>

            <div class="d-none d-sm-flex align-items-center gap-2">
                <button type="button"
                        class="btn glass-header-icon-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#headerAnnouncementsModal"
                        aria-label="اطلاعیه‌ها"
                        title="اطلاعیه‌ها">
                    <i class="bi bi-megaphone"></i>
                    @if($announcementsCount > 0)
                        <span class="glass-header-badge glass-header-badge-primary">{{ $announcementsCount }}</span>
                    @endif
                </button>

                <button type="button"
                        class="btn glass-header-icon-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#headerNotificationsModal"
                        aria-label="اعلان‌ها"
                        title="اعلان‌ها">
                    <i class="bi bi-bell"></i>
                    @if($notificationsCount > 0)
                        <span class="glass-header-badge glass-header-badge-danger">{{ $notificationsCount }}</span>
                    @endif
                </button>

                <button type="button"
                        data-theme-toggle
                        class="btn btn-sm d-inline-flex align-items-center gap-2 glass-header-theme-btn"
                        aria-label="تغییر تم">
                    <span data-theme-icon aria-hidden="true">🌙</span>
                    <span data-theme-label>تم تیره</span>
                </button>

                <x-dropdown align="left" width="56">
                    <x-slot name="trigger">
                        <button class="btn d-inline-flex align-items-center gap-2 px-3 glass-header-user-btn">
                            @auth
                                <span>{{ Auth::user()->name }}</span>
                            @endauth
                            @guest
                                <span>مهمان</span>
                            @endguest

                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @hasrole('Admin')
                            <x-dropdown-link :href="route('admin.marketers.index')">کاربران بازاریاب</x-dropdown-link>
                            <x-dropdown-link :href="route('admin.guests.index')">کاربران مهمان</x-dropdown-link>
                            <x-dropdown-link :href="route('admin.products.index')">محصولات</x-dropdown-link>
                            <x-dropdown-link :href="route('admin.categories.index')">تنظیم دسته بندی</x-dropdown-link>
                            <x-dropdown-link :href="route('admin.referenceType.index')">تنظیم نحوه آشنایی</x-dropdown-link>
                        @endhasrole

                        @hasrole('Marketer')
                            <x-dropdown-link :href="route('marketer.customers.index')">مشتریان من</x-dropdown-link>
                            <x-dropdown-link :href="route('user.reports.index')">گزارش های من</x-dropdown-link>
                        @endhasrole

                        @hasrole('Guest')
                            <x-dropdown-link :href="route('guest.reports.index')">گزارش های من</x-dropdown-link>
                        @endhasrole

                        @auth
                            <x-dropdown-link :href="route('profile.edit')">پروفایل</x-dropdown-link>
                        @endauth

                        <x-dropdown-link :href="route('announcements.index')">اطلاعیه‌ها</x-dropdown-link>

                        @auth
                            @if(auth()->user()->hasAnyRole(['Admin', 'internalManager', 'InternalManager']))
                                <x-dropdown-link :href="route('announcements.create')">ایجاد اطلاعیه</x-dropdown-link>
                            @endif
                        @endauth

                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    خروج
                                </x-dropdown-link>
                            </form>
                        @endauth
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="d-flex d-sm-none align-items-center gap-2">
                <button type="button"
                        class="btn glass-header-icon-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#headerAnnouncementsModal"
                        aria-label="اطلاعیه‌ها">
                    <i class="bi bi-megaphone"></i>
                    @if($announcementsCount > 0)
                        <span class="glass-header-badge glass-header-badge-primary">{{ $announcementsCount }}</span>
                    @endif
                </button>

                <button type="button"
                        class="btn glass-header-icon-btn"
                        data-bs-toggle="modal"
                        data-bs-target="#headerNotificationsModal"
                        aria-label="اعلان‌ها">
                    <i class="bi bi-bell"></i>
                    @if($notificationsCount > 0)
                        <span class="glass-header-badge glass-header-badge-danger">{{ $notificationsCount }}</span>
                    @endif
                </button>

                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md glass-header-mobile-toggle focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': ! open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': ! open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden glass-header-mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                داشبورد
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-3 glass-header-mobile-divider">
            <div class="px-4">
                @auth
                    <div class="font-medium text-base glass-header-user-name">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm glass-header-user-email">{{ Auth::user()->email }}</div>
                @endauth

                @guest
                    <div class="glass-header-user-name">مهمان</div>
                @endguest
            </div>

            <div class="mt-3 space-y-1">
                <div class="px-4 py-2">
                    <button type="button"
                            data-theme-toggle
                            class="btn btn-sm w-100 d-inline-flex align-items-center justify-content-center gap-2 glass-header-theme-btn"
                            aria-label="تغییر تم">
                        <span data-theme-icon aria-hidden="true">🌙</span>
                        <span data-theme-label>تم تیره</span>
                    </button>
                </div>

                @auth
                    <x-responsive-nav-link :href="route('profile.edit')">
                        پروفایل
                    </x-responsive-nav-link>
                @endauth

                <x-responsive-nav-link :href="route('announcements.index')">
                    اطلاعیه‌ها
                </x-responsive-nav-link>

                @auth
                    @if(auth()->user()->hasAnyRole(['Admin', 'internalManager', 'InternalManager']))
                        <x-responsive-nav-link :href="route('announcements.create')">
                            ایجاد اطلاعیه
                        </x-responsive-nav-link>
                    @endif
                @endauth

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault(); this.closest('form').submit();">
                            خروج
                        </x-responsive-nav-link>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="modal fade glass-header-modal" id="headerAnnouncementsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <div class="glass-header-modal-head">
                    <button type="button" class="btn-close m-0 ms-2" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="glass-header-modal-side">
                        <div class="text-end">
                            <h5 class="modal-title fw-bold mb-1">اطلاعیه‌ها</h5>
                            <div class="small text-muted">آخرین اطلاعیه‌های سیستم</div>
                        </div>

                        <div class="glass-header-modal-icon">
                            <i class="bi bi-megaphone"></i>
                        </div>

                        <div class="glass-header-modal-count">{{ $announcementsCount }} مورد</div>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                @if($announcementsCount > 0)
                    <div class="glass-header-list">
                        @foreach($headerAnnouncements as $announcement)
                            <div class="glass-header-item">
                                <div class="glass-header-item-top">
                                    <h6 class="glass-header-item-title">{{ $announcement->title }}</h6>
                                </div>

                                <div class="glass-header-item-text">{{ $announcement->message }}</div>

                                <div class="glass-header-item-meta">
                                    <span class="glass-header-chip">
                                        <i class="bi bi-person"></i>
                                        <span>{{ $announcement->creator?->name ?? '---' }}</span>
                                    </span>

                                    <span class="glass-header-chip">
                                        <i class="bi bi-clock-history"></i>
                                        <span>{{ \Hekmatinasser\Verta\Verta::instance($announcement->created_at)->format('Y/m/d H:i') }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="glass-header-empty">
                        <div class="glass-header-empty-icon">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <div class="glass-header-empty-title">اطلاعیه‌ای وجود ندارد</div>
                        <div class="glass-header-empty-text">در حال حاضر موردی برای نمایش ثبت نشده است.</div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <a class="btn btn-outline-primary" href="{{ route('announcements.index') }}">مشاهده همه اطلاعیه‌ها</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade glass-header-modal" id="headerNotificationsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <div class="glass-header-modal-head">
                    <button type="button" class="btn-close m-0 ms-2" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="glass-header-modal-side">
                        <div class="text-end">
                            <h5 class="modal-title fw-bold mb-1">اعلان‌ها</h5>
                            <div class="small text-muted">اعلان‌های اخیر شما</div>
                        </div>

                        <div class="glass-header-modal-icon">
                            <i class="bi bi-bell"></i>
                        </div>

                        <div class="glass-header-modal-count">{{ $notificationsCount }} دیده‌نشده</div>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                @if($headerNotifications->count() > 0)
                    <div class="glass-header-list">
                        @foreach($headerNotifications as $notification)
                            <div class="glass-header-item">
                                <div class="glass-header-item-top">
                                    <h6 class="glass-header-item-title">{{ $notification->title }}</h6>

                                    @if(!$notification->seen)
                                        <span class="glass-header-item-new">جدید</span>
                                    @endif
                                </div>

                                @if(!empty($notification->message))
                                    <div class="glass-header-item-text">{{ $notification->message }}</div>
                                @endif

                                <div class="glass-header-item-meta">
                                    <span class="glass-header-chip">
                                        <i class="bi bi-clock-history"></i>
                                        <span>{{ \Hekmatinasser\Verta\Verta::instance($notification->created_at)->format('Y/m/d H:i') }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="glass-header-empty">
                        <div class="glass-header-empty-icon">
                            <i class="bi bi-bell"></i>
                        </div>
                        <div class="glass-header-empty-title">اعلانی وجود ندارد</div>
                        <div class="glass-header-empty-text">فعلاً اعلان جدیدی برای شما ثبت نشده است.</div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>