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

        --gh-border: rgba(15, 23, 42, .08);
        --gh-border-strong: rgba(15, 23, 42, .12);

        --gh-text: #0f172a;
        --gh-muted: #64748b;
        --gh-soft-text: #475569;

        --gh-shadow-sm: 0 8px 20px rgba(15, 23, 42, .05);
        --gh-shadow-md: 0 16px 40px rgba(15, 23, 42, .08);
        --gh-shadow-lg: 0 24px 70px rgba(15, 23, 42, .16);

        --gh-primary: #2563eb;
        --gh-violet: #8b5cf6;
        --gh-cyan: #06b6d4;
        --gh-red: #ef4444;

        --gh-btn-bg: rgba(255, 255, 255, .92);
        --gh-btn-hover: #f8fbff;
        --gh-btn-border: rgba(15, 23, 42, .08);

        --gh-badge-primary-bg: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        --gh-badge-primary-text: #ffffff;

        --gh-badge-danger-bg: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        --gh-badge-danger-text: #ffffff;

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

        --gh-border: rgba(148, 163, 184, .16);
        --gh-border-strong: rgba(148, 163, 184, .22);

        --gh-text: #eef4ff;
        --gh-muted: #94a3b8;
        --gh-soft-text: #cbd5e1;

        --gh-shadow-sm: 0 10px 24px rgba(0, 0, 0, .24);
        --gh-shadow-md: 0 18px 42px rgba(0, 0, 0, .28);
        --gh-shadow-lg: 0 26px 80px rgba(0, 0, 0, .38);

        --gh-primary: #60a5fa;
        --gh-violet: #a78bfa;
        --gh-cyan: #22d3ee;
        --gh-red: #f87171;

        --gh-btn-bg: rgba(17, 28, 49, .92);
        --gh-btn-hover: #17243c;
        --gh-btn-border: rgba(148, 163, 184, .15);

        --gh-badge-primary-bg: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        --gh-badge-danger-bg: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%);

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
        box-shadow: 0 12px 24px rgba(37, 99, 235, .18);
    }

    .glass-header-icon-btn {
        background: var(--gh-btn-bg) !important;
        border: 1px solid var(--gh-btn-border) !important;
        color: var(--gh-text) !important;
        transition: all .25s ease;
        box-shadow: 0 8px 16px rgba(15, 23, 42, .05);
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

    .glass-header-icon-btn:hover {
        background: var(--gh-btn-hover) !important;
        border-color: var(--gh-border-strong) !important;
        color: var(--gh-text) !important;
        transform: translateY(-1px);
        box-shadow: 0 14px 26px rgba(15, 23, 42, .08);
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

    .glass-header-mobile-toggle {
        color: var(--gh-muted);
        border: 1px solid transparent;
        background: transparent;
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

    .glass-header-actions {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .glass-header-mobile-actions {
        display: flex;
        align-items: center;
        gap: .45rem;
    }

    /* =========================
       MODALS
       ========================= */
    #headerAnnouncementsModal .modal-dialog,
    #headerNotificationsModal .modal-dialog {
        max-width: 960px;
    }

    #headerAnnouncementsModal .modal-content,
    #headerNotificationsModal .modal-content {
        border: 1px solid var(--gh-border) !important;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: var(--gh-shadow-lg);
        background: #fff;
    }

    #headerAnnouncementsModal .modal-header,
    #headerNotificationsModal .modal-header {
        background: linear-gradient(135deg, #ffffff 0%, #f5f9ff 100%) !important;
        color: var(--gh-text) !important;
        border-bottom: 1px solid var(--gh-border) !important;
        padding: 1.15rem 1.25rem;
        position: relative;
        overflow: hidden;
    }

    #headerAnnouncementsModal .modal-body,
    #headerNotificationsModal .modal-body {
        background:
            radial-gradient(circle at top right, rgba(59, 130, 246, .06), transparent 22%),
            radial-gradient(circle at top left, rgba(139, 92, 246, .05), transparent 18%),
            linear-gradient(180deg, #f8fbff 0%, #fdfefe 100%) !important;
        color: var(--gh-text) !important;
        max-height: 74vh;
        overflow-y: auto;
        padding: 1.15rem;
    }

    #headerAnnouncementsModal .modal-footer,
    #headerNotificationsModal .modal-footer {
        background: #ffffff !important;
        color: var(--gh-text) !important;
        border-top: 1px solid var(--gh-border) !important;
        padding: 1rem 1.25rem;
    }

    #headerAnnouncementsModal .btn-close,
    #headerNotificationsModal .btn-close {
        opacity: 1;
        position: relative;
        z-index: 2;
    }

    #headerAnnouncementsModal [data-ann-head],
    #headerNotificationsModal [data-notif-head] {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        width: 100%;
        position: relative;
        z-index: 2;
    }

    #headerAnnouncementsModal [data-ann-side],
    #headerNotificationsModal [data-notif-side] {
        display: flex;
        align-items: center;
        gap: .9rem;
    }

    #headerAnnouncementsModal [data-ann-icon],
    #headerNotificationsModal [data-notif-icon] {
        width: 54px;
        height: 54px;
        min-width: 54px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: var(--gh-text);
        background: linear-gradient(135deg, rgba(59, 130, 246, .14) 0%, rgba(139, 92, 246, .14) 100%);
        border: 1px solid rgba(99, 102, 241, .16);
        box-shadow: 0 12px 26px rgba(15, 23, 42, .08);
    }

    #headerAnnouncementsModal [data-ann-count],
    #headerNotificationsModal [data-notif-count] {
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

    #headerAnnouncementsModal [data-ann-list],
    #headerNotificationsModal [data-notif-list] {
        display: grid;
        gap: 1rem;
    }

    #headerAnnouncementsModal [data-ann-card],
    #headerNotificationsModal [data-notif-card] {
        position: relative;
        border: 1px solid rgba(148, 163, 184, .22) !important;
        border-radius: 24px;
        padding: 1.05rem 1rem 1rem 1.1rem;
        box-shadow: var(--gh-shadow-md);
        overflow: hidden;
        transition: all .28s ease;
    }

    #headerAnnouncementsModal [data-ann-card]::before,
    #headerNotificationsModal [data-notif-card]::before {
        content: "";
        position: absolute;
        inset: 0 auto 0 0;
        width: 5px;
        background: linear-gradient(180deg, var(--gh-primary) 0%, var(--gh-violet) 55%, var(--gh-cyan) 100%);
    }

    #headerAnnouncementsModal [data-ann-card-top],
    #headerNotificationsModal [data-notif-card-top] {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: .9rem;
        margin-bottom: .55rem;
    }

    #headerAnnouncementsModal [data-ann-title],
    #headerNotificationsModal [data-notif-title] {
        font-size: 15px;
        font-weight: 900;
        color: var(--gh-text);
        margin: 0;
        line-height: 2;
    }

    #headerAnnouncementsModal [data-ann-text],
    #headerNotificationsModal [data-notif-text] {
        font-size: 13.5px;
        line-height: 2.15;
        color: var(--gh-soft-text);
        white-space: pre-line;
        margin-top: .2rem;
    }

    #headerAnnouncementsModal [data-ann-meta],
    #headerNotificationsModal [data-notif-meta] {
        display: flex;
        flex-wrap: wrap;
        gap: .55rem;
        margin-top: .9rem;
    }

    #headerAnnouncementsModal [data-ann-chip],
    #headerNotificationsModal [data-notif-chip] {
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

    #headerNotificationsModal [data-notif-new] {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 50px;
        height: 29px;
        border-radius: 999px;
        padding: 0 .82rem;
        font-size: 11px;
        font-weight: 900;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #b91c1c;
        white-space: nowrap;
        border: 1px solid rgba(239, 68, 68, .14);
        box-shadow: 0 8px 16px rgba(239, 68, 68, .08);
    }

    #headerAnnouncementsModal [data-ann-empty],
    #headerNotificationsModal [data-notif-empty] {
        position: relative;
        overflow: hidden;
        background: linear-gradient(180deg, #ffffff 0%, #f7fbff 100%) !important;
        border: 1px dashed #dbeafe !important;
        border-radius: 26px;
        padding: 2.4rem 1rem;
        text-align: center;
    }

    #headerAnnouncementsModal [data-ann-empty-icon],
    #headerNotificationsModal [data-notif-empty-icon] {
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
    }

    #headerAnnouncementsModal [data-ann-empty-title],
    #headerNotificationsModal [data-notif-empty-title] {
        color: var(--gh-text);
        font-size: 15px;
        font-weight: 900;
        margin-bottom: .35rem;
    }

    #headerAnnouncementsModal [data-ann-empty-text],
    #headerNotificationsModal [data-notif-empty-text] {
        color: var(--gh-muted);
        font-size: 13px;
        line-height: 2;
    }

    html.dark #headerAnnouncementsModal .modal-content,
    html.dark #headerNotificationsModal .modal-content,
    body.dark #headerAnnouncementsModal .modal-content,
    body.dark #headerNotificationsModal .modal-content,
    .dark #headerAnnouncementsModal .modal-content,
    .dark #headerNotificationsModal .modal-content,
    html[data-bs-theme="dark"] #headerAnnouncementsModal .modal-content,
    html[data-bs-theme="dark"] #headerNotificationsModal .modal-content,
    body[data-bs-theme="dark"] #headerAnnouncementsModal .modal-content,
    body[data-bs-theme="dark"] #headerNotificationsModal .modal-content,
    [data-bs-theme="dark"] #headerAnnouncementsModal .modal-content,
    [data-bs-theme="dark"] #headerNotificationsModal .modal-content {
        background: #0f172a;
    }

    html.dark #headerAnnouncementsModal .modal-header,
    html.dark #headerNotificationsModal .modal-header,
    body.dark #headerAnnouncementsModal .modal-header,
    body.dark #headerNotificationsModal .modal-header,
    .dark #headerAnnouncementsModal .modal-header,
    .dark #headerNotificationsModal .modal-header,
    html[data-bs-theme="dark"] #headerAnnouncementsModal .modal-header,
    html[data-bs-theme="dark"] #headerNotificationsModal .modal-header,
    body[data-bs-theme="dark"] #headerAnnouncementsModal .modal-header,
    body[data-bs-theme="dark"] #headerNotificationsModal .modal-header,
    [data-bs-theme="dark"] #headerAnnouncementsModal .modal-header,
    [data-bs-theme="dark"] #headerNotificationsModal .modal-header {
        background: linear-gradient(135deg, #111c31 0%, #0f172a 100%) !important;
    }

    html.dark #headerAnnouncementsModal .modal-body,
    html.dark #headerNotificationsModal .modal-body,
    body.dark #headerAnnouncementsModal .modal-body,
    body.dark #headerNotificationsModal .modal-body,
    .dark #headerAnnouncementsModal .modal-body,
    .dark #headerNotificationsModal .modal-body,
    html[data-bs-theme="dark"] #headerAnnouncementsModal .modal-body,
    html[data-bs-theme="dark"] #headerNotificationsModal .modal-body,
    body[data-bs-theme="dark"] #headerAnnouncementsModal .modal-body,
    body[data-bs-theme="dark"] #headerNotificationsModal .modal-body,
    [data-bs-theme="dark"] #headerAnnouncementsModal .modal-body,
    [data-bs-theme="dark"] #headerNotificationsModal .modal-body {
        background:
            radial-gradient(circle at top right, rgba(59, 130, 246, .06), transparent 22%),
            radial-gradient(circle at top left, rgba(139, 92, 246, .05), transparent 18%),
            linear-gradient(180deg, #0d1628 0%, #10192d 100%) !important;
    }

    html.dark #headerAnnouncementsModal .modal-footer,
    html.dark #headerNotificationsModal .modal-footer,
    body.dark #headerAnnouncementsModal .modal-footer,
    body.dark #headerNotificationsModal .modal-footer,
    .dark #headerAnnouncementsModal .modal-footer,
    .dark #headerNotificationsModal .modal-footer,
    html[data-bs-theme="dark"] #headerAnnouncementsModal .modal-footer,
    html[data-bs-theme="dark"] #headerNotificationsModal .modal-footer,
    body[data-bs-theme="dark"] #headerAnnouncementsModal .modal-footer,
    body[data-bs-theme="dark"] #headerNotificationsModal .modal-footer,
    [data-bs-theme="dark"] #headerAnnouncementsModal .modal-footer,
    [data-bs-theme="dark"] #headerNotificationsModal .modal-footer {
        background: #111c31 !important;
    }

    html.dark #headerAnnouncementsModal .btn-close,
    html.dark #headerNotificationsModal .btn-close,
    body.dark #headerAnnouncementsModal .btn-close,
    body.dark #headerNotificationsModal .btn-close,
    .dark #headerAnnouncementsModal .btn-close,
    .dark #headerNotificationsModal .btn-close,
    html[data-bs-theme="dark"] #headerAnnouncementsModal .btn-close,
    html[data-bs-theme="dark"] #headerNotificationsModal .btn-close,
    body[data-bs-theme="dark"] #headerAnnouncementsModal .btn-close,
    body[data-bs-theme="dark"] #headerNotificationsModal .btn-close,
    [data-bs-theme="dark"] #headerAnnouncementsModal .btn-close,
    [data-bs-theme="dark"] #headerNotificationsModal .btn-close {
        filter: invert(1) grayscale(100%);
    }

    @media (max-width: 639.98px) {
        .glass-header-row {
            min-height: 66px;
        }

        .glass-header-logo {
            height: 40px;
            padding-left: 4px;
        }

        .glass-header-logo img {
            max-height: 34px;
        }

        .glass-header-icon-btn {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 14px !important;
        }

        .glass-header-icon-btn i {
            font-size: 1rem;
        }

        .glass-header-badge {
            top: -6px;
            right: -6px;
            min-width: 21px;
            height: 21px;
            font-size: 10px;
        }

        .glass-header-mobile-actions {
            gap: .35rem;
        }

        .glass-header-dashboard-btn {
            height: 39px;
            padding-inline: 10px !important;
            font-size: 13px;
        }

        #headerAnnouncementsModal .modal-dialog,
        #headerNotificationsModal .modal-dialog {
            max-width: 100%;
            margin: 0;
        }

        #headerAnnouncementsModal .modal-content,
        #headerNotificationsModal .modal-content {
            min-height: 100vh;
            border-radius: 0;
        }

        #headerAnnouncementsModal .modal-header,
        #headerAnnouncementsModal .modal-footer,
        #headerNotificationsModal .modal-header,
        #headerNotificationsModal .modal-footer {
            padding-inline: .95rem;
        }

        #headerAnnouncementsModal .modal-body,
        #headerNotificationsModal .modal-body {
            max-height: none;
            flex: 1 1 auto;
            padding: .95rem;
        }

        #headerAnnouncementsModal [data-ann-icon],
        #headerNotificationsModal [data-notif-icon] {
            width: 45px;
            height: 45px;
            min-width: 45px;
            border-radius: 16px;
        }

        #headerAnnouncementsModal [data-ann-card],
        #headerNotificationsModal [data-notif-card] {
            border-radius: 20px;
            padding: .95rem .9rem .95rem 1rem;
        }

        #headerAnnouncementsModal [data-ann-title],
        #headerNotificationsModal [data-notif-title] {
            font-size: 14px;
        }

        #headerAnnouncementsModal [data-ann-text],
        #headerNotificationsModal [data-notif-text] {
            font-size: 13px;
        }

        #headerNotificationsModal [data-notif-new] {
            min-width: 46px;
            height: 27px;
        }
    }
</style>

<nav x-data="{ open: false }" class="glass-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center glass-header-row">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="shrink-0">
                    <div class="glass-header-logo">
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                    </div>
                </a>

                <a href="{{ route('dashboard') }}"
                   class="btn btn-primary d-none d-sm-inline-flex align-items-center gap-2 glass-header-dashboard-btn {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>داشبورد</span>
                </a>
            </div>

            {{-- دسکتاپ --}}
            <div class="d-none d-sm-flex glass-header-actions">
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
                        class="btn glass-header-icon-btn"
                        data-theme-toggle
                        aria-label="تغییر تم"
                        title="تغییر تم">
                    <i class="bi bi-moon-stars-fill" data-theme-icon></i>
                </button>

                @auth
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit"
                                class="btn glass-header-icon-btn"
                                aria-label="خروج"
                                title="خروج">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                @endauth
            </div>

            {{-- موبایل --}}
            <div class="d-flex d-sm-none glass-header-mobile-actions">
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
                        class="btn glass-header-icon-btn"
                        data-theme-toggle
                        aria-label="تغییر تم"
                        title="تغییر تم">
                    <i class="bi bi-moon-stars-fill" data-theme-icon></i>
                </button>

                @auth
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit"
                                class="btn glass-header-icon-btn"
                                aria-label="خروج"
                                title="خروج">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                @endauth

              
            </div>
        </div>
    </div>

    
</nav>

<div class="modal fade" id="headerAnnouncementsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <div data-ann-head>
                    <button type="button" class="btn-close m-0 ms-2" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div data-ann-side>
                        <div class="text-end">
                            <h5 class="modal-title fw-bold mb-1">اطلاعیه‌ها</h5>
                            <div class="small text-muted">آخرین اطلاعیه‌های سیستم</div>
                        </div>

                        <div data-ann-icon>
                            <i class="bi bi-megaphone"></i>
                        </div>

                        <div data-ann-count>{{ $announcementsCount }} مورد</div>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                @if($announcementsCount > 0)
                    <div data-ann-list>
                        @foreach($headerAnnouncements as $announcement)
                            <div data-ann-card>
                                <div data-ann-card-top>
                                    <h6 data-ann-title>{{ $announcement->title }}</h6>
                                </div>

                                <div data-ann-text>{{ $announcement->message }}</div>

                                <div data-ann-meta>
                                    <span data-ann-chip>
                                        <i class="bi bi-person"></i>
                                        <span>{{ $announcement->creator?->name ?? '---' }}</span>
                                    </span>

                                    <span data-ann-chip>
                                        <i class="bi bi-clock-history"></i>
                                        <span>{{ \Hekmatinasser\Verta\Verta::instance($announcement->created_at)->format('Y/m/d H:i') }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div data-ann-empty>
                        <div data-ann-empty-icon>
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <div data-ann-empty-title>اطلاعیه‌ای وجود ندارد</div>
                        <div data-ann-empty-text>در حال حاضر موردی برای نمایش ثبت نشده است.</div>
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

<div class="modal fade" id="headerNotificationsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <div data-notif-head>
                    <button type="button" class="btn-close m-0 ms-2" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div data-notif-side>
                        <div class="text-end">
                            <h5 class="modal-title fw-bold mb-1">اعلان‌ها</h5>
                            <div class="small text-muted">اعلان‌های اخیر شما</div>
                        </div>

                        <div data-notif-icon>
                            <i class="bi bi-bell"></i>
                        </div>

                        <div data-notif-count>{{ $notificationsCount }} دیده‌نشده</div>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                @if($headerNotifications->count() > 0)
                    <div data-notif-list>
                        @foreach($headerNotifications as $notification)
                            <div data-notif-card>
                                <div data-notif-card-top>
                                    <h6 data-notif-title>{{ $notification->title }}</h6>

                                    @if(!$notification->seen)
                                        <span data-notif-new>جدید</span>
                                    @endif
                                </div>

                                @if(!empty($notification->message))
                                    <div data-notif-text>{{ $notification->message }}</div>
                                @endif

                                @php
                                    $notifLeave = $notification->leave;
                                    $canSubstituteAction = $notifLeave && $notifLeave->status === 'pending' && (int) $notifLeave->substitute_user_id === (int) auth()->id();
                                    $canManagerAction = $notifLeave && $notifLeave->status === 'manager_approved' && auth()->user()->hasRole('Manager') && (int) $notifLeave->manager_id === (int) auth()->id();
                                    $canInternalAction = $notifLeave && $notifLeave->status === 'internal_approved' && (auth()->user()->hasRole('Admin') || auth()->user()->hasAnyRole(['internalManager', 'InternalManager']));
                                @endphp

                                @if($canSubstituteAction || $canManagerAction || $canInternalAction)
                                    <div class="d-flex gap-2 mt-2">
                                        <form action="{{ route('leaves.approve', $notifLeave->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success btn-sm">تایید</button>
                                        </form>
                                        <form action="{{ route('leaves.reject', $notifLeave->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-danger btn-sm">رد</button>
                                        </form>
                                    </div>
                                @endif

                                <div data-notif-meta>
                                    <span data-notif-chip>
                                        <i class="bi bi-clock-history"></i>
                                        <span>{{ \Hekmatinasser\Verta\Verta::instance($notification->created_at)->format('Y/m/d H:i') }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div data-notif-empty>
                        <div data-notif-empty-icon>
                            <i class="bi bi-bell"></i>
                        </div>
                        <div data-notif-empty-title>اعلانی وجود ندارد</div>
                        <div data-notif-empty-text>فعلاً اعلان جدیدی برای شما ثبت نشده است.</div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script>
    (function () {
        const storedTheme = localStorage.getItem('theme');
        const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        const theme = storedTheme || systemTheme;
        document.documentElement.setAttribute('data-bs-theme', theme);
    })();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('[data-theme-toggle]');

        const getNextTheme = (theme) => theme === 'dark' ? 'light' : 'dark';

        const syncToggles = (theme) => {
            const nextTheme = getNextTheme(theme);

            toggles.forEach((toggle) => {
                const icon = toggle.querySelector('[data-theme-icon]');
                if (icon) {
                    icon.className = nextTheme === 'dark'
                        ? 'bi bi-moon-stars-fill'
                        : 'bi bi-sun-fill';
                }

                toggle.setAttribute('title', nextTheme === 'dark' ? 'تغییر به تم تیره' : 'تغییر به تم روشن');
                toggle.setAttribute('aria-label', nextTheme === 'dark' ? 'تغییر به تم تیره' : 'تغییر به تم روشن');
            });
        };

        const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
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