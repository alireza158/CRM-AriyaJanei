@php
    $announcementsCount = $headerAnnouncements->count();
    $notificationsCount = $headerNotificationsUnseenCount ?? 0;
    $messagesCount = $headerMessagesUnseenCount ?? 0;

    $firstThread = ($headerMessages ?? collect())->first();
    $firstThreadUser = $firstThread
        ? ($firstThread->sender_id === auth()->id() ? $firstThread->receiver : $firstThread->sender)
        : null;
@endphp

<style>
    :root,
    [data-bs-theme="light"] {
        --hx-font: "Vazirmatn", "IRANSansX", "Yekan Bakh", Tahoma, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;

        --hx-body: #f5f7fb;
        --hx-surface: #ffffff;
        --hx-surface-2: #f8fafc;
        --hx-surface-3: #eef2f7;

        --hx-text: #0f172a;
        --hx-text-soft: #475569;
        --hx-text-muted: #64748b;

        --hx-border: #e2e8f0;
        --hx-border-strong: #cbd5e1;

        --hx-primary: #2563eb;
        --hx-primary-2: #3b82f6;
        --hx-success: #16a34a;
        --hx-danger: #dc2626;
        --hx-warning: #f59e0b;

        --hx-shadow-sm: 0 8px 24px rgba(15, 23, 42, .06);
        --hx-shadow-md: 0 18px 40px rgba(15, 23, 42, .09);
        --hx-shadow-lg: 0 24px 64px rgba(15, 23, 42, .14);

        --hx-header-bg:
            linear-gradient(180deg, rgba(255,255,255,.88) 0%, rgba(255,255,255,.94) 100%);
        --hx-header-border: rgba(15, 23, 42, .08);
        --hx-header-btn: rgba(255,255,255,.92);
        --hx-header-btn-hover: #ffffff;

        --hx-modal-bg: #ffffff;
        --hx-modal-header-bg: #ffffff;
        --hx-modal-body-bg: #f8fafc;
        --hx-modal-footer-bg: #ffffff;
        --hx-modal-backdrop: rgba(15, 23, 42, .45);

        --hx-chat-list-bg: #ffffff;
        --hx-chat-pane-bg: #ffffff;
        --hx-chat-scroll-bg: #f8fafc;
        --hx-chat-mine: #dbeafe;
        --hx-chat-mine-border: #bfdbfe;
        --hx-chat-theirs: #ffffff;
        --hx-chat-theirs-border: #e2e8f0;
    }

    [data-bs-theme="dark"] {
        --hx-body: #0b1220;
        --hx-surface: #0f172a;
        --hx-surface-2: #111827;
        --hx-surface-3: #1e293b;

        --hx-text: #e5eefc;
        --hx-text-soft: #cbd5e1;
        --hx-text-muted: #94a3b8;

        --hx-border: rgba(148, 163, 184, .18);
        --hx-border-strong: rgba(148, 163, 184, .28);

        --hx-primary: #60a5fa;
        --hx-primary-2: #3b82f6;
        --hx-success: #22c55e;
        --hx-danger: #f87171;
        --hx-warning: #fbbf24;

        --hx-shadow-sm: 0 8px 24px rgba(0, 0, 0, .24);
        --hx-shadow-md: 0 18px 40px rgba(0, 0, 0, .30);
        --hx-shadow-lg: 0 24px 64px rgba(0, 0, 0, .40);

        --hx-header-bg:
            linear-gradient(180deg, rgba(11,18,32,.88) 0%, rgba(11,18,32,.94) 100%);
        --hx-header-border: rgba(148, 163, 184, .14);
        --hx-header-btn: rgba(17,24,39,.92);
        --hx-header-btn-hover: #182132;

        --hx-modal-bg: #0f172a;
        --hx-modal-header-bg: #111827;
        --hx-modal-body-bg: #0b1220;
        --hx-modal-footer-bg: #111827;
        --hx-modal-backdrop: rgba(2, 6, 23, .7);

        --hx-chat-list-bg: #0f172a;
        --hx-chat-pane-bg: #0f172a;
        --hx-chat-scroll-bg: #0b1220;
        --hx-chat-mine: rgba(37, 99, 235, .24);
        --hx-chat-mine-border: rgba(96, 165, 250, .24);
        --hx-chat-theirs: #111827;
        --hx-chat-theirs-border: rgba(148, 163, 184, .16);
    }

    .hx-header,
    .hx-header * {
        font-family: var(--hx-font);
    }

    .hx-header {
        position: sticky;
        top: 0;
        z-index: 1030;
        background: var(--hx-header-bg);
        background-color: var(--hx-surface);
        border-bottom: 1px solid var(--hx-header-border);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: var(--hx-shadow-sm);
    }

    .hx-header__row {
        min-height: 76px;
    }

    .hx-header__logo {
        height: 48px;
        display: flex;
        align-items: center;
    }

    .hx-header__logo img {
        max-height: 40px;
        width: auto;
        display: block;
    }

    .hx-header__actions,
    .hx-header__actions--mobile {
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .hx-header__dashboard-btn {
        height: 46px;
        border-radius: 16px !important;
        padding-inline: 16px !important;
        font-weight: 800;
    }

    .hx-icon-btn {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 16px !important;
        padding: 0 !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        position: relative;
        border: 1px solid var(--hx-border) !important;
        background: var(--hx-header-btn) !important;
        color: var(--hx-text) !important;
        box-shadow: var(--hx-shadow-sm);
        transition: .2s ease;
    }

    .hx-icon-btn:hover {
        background: var(--hx-header-btn-hover) !important;
        border-color: var(--hx-border-strong) !important;
        color: var(--hx-text) !important;
        transform: translateY(-1px);
    }

    .hx-icon-btn i {
        font-size: 1.1rem;
        line-height: 1;
    }

    .hx-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        min-width: 22px;
        height: 22px;
        padding: 0 6px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 900;
        color: #fff;
        border: 2px solid var(--hx-surface);
    }

    .hx-badge--primary { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .hx-badge--danger  { background: linear-gradient(135deg, #ef4444, #dc2626); }
    .hx-badge--success { background: linear-gradient(135deg, #22c55e, #16a34a); }

    .hx-modal {
        --bs-modal-bg: var(--hx-modal-bg);
        --bs-modal-color: var(--hx-text);
        --bs-modal-border-color: var(--hx-border);
        --bs-modal-header-border-color: var(--hx-border);
        --bs-modal-footer-border-color: var(--hx-border);
        --bs-backdrop-bg: 15, 23, 42;
        --bs-backdrop-opacity: .55;
    }

    .hx-modal,
    .hx-modal * {
        font-family: var(--hx-font);
    }

    .hx-modal .modal-dialog {
        max-width: 960px;
    }

    #headerMessagesModal .modal-dialog {
        max-width: 1180px;
    }

    .hx-modal .modal-content {
        background-color: var(--hx-modal-bg) !important;
        background-image: none !important;
        border: 1px solid var(--hx-border) !important;
        border-radius: 28px !important;
        overflow: hidden;
        box-shadow: var(--hx-shadow-lg);
        color: var(--hx-text);
    }

    .hx-modal .modal-header {
        background-color: var(--hx-modal-header-bg) !important;
        background-image: none !important;
        border-bottom: 1px solid var(--hx-border) !important;
        color: var(--hx-text) !important;
        padding: 1rem 1.1rem;
    }

    .hx-modal .modal-body {
        background-color: var(--hx-modal-body-bg) !important;
        background-image: none !important;
        color: var(--hx-text) !important;
        padding: 1rem;
    }

    .hx-modal .modal-footer {
        background-color: var(--hx-modal-footer-bg) !important;
        background-image: none !important;
        border-top: 1px solid var(--hx-border) !important;
        color: var(--hx-text) !important;
        padding: 1rem 1.1rem;
    }

    .hx-modal .btn-close {
        opacity: 1;
    }

    [data-bs-theme="dark"] .hx-modal .btn-close {
        filter: invert(1) grayscale(100%);
    }

    .modal-backdrop.show {
        opacity: 1 !important;
        background: var(--hx-modal-backdrop) !important;
        backdrop-filter: none !important;
        -webkit-backdrop-filter: none !important;
    }

    .hx-panel-list {
        display: grid;
        gap: 1rem;
    }

    .hx-card {
        background: var(--hx-surface);
        border: 1px solid var(--hx-border);
        border-radius: 22px;
        padding: 1rem;
        box-shadow: var(--hx-shadow-sm);
        color: var(--hx-text);
    }

    .hx-card__title {
        font-size: 15px;
        font-weight: 900;
        margin: 0 0 .45rem;
        color: var(--hx-text);
        line-height: 1.9;
    }

    .hx-card__text {
        font-size: 13.5px;
        line-height: 2;
        color: var(--hx-text-soft);
        white-space: pre-line;
    }

    .hx-card__meta {
        display: flex;
        flex-wrap: wrap;
        gap: .5rem;
        margin-top: .9rem;
    }

    .hx-chip {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .45rem .8rem;
        border-radius: 999px;
        border: 1px solid var(--hx-border);
        background: var(--hx-surface-2);
        color: var(--hx-text-muted);
        font-size: 12px;
        font-weight: 700;
    }

    .hx-empty {
        background: var(--hx-surface);
        border: 1px dashed var(--hx-border-strong);
        border-radius: 24px;
        padding: 2rem 1rem;
        text-align: center;
        color: var(--hx-text-muted);
    }

    .hx-empty__icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 12px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--hx-surface-2);
        border: 1px solid var(--hx-border);
        font-size: 1.4rem;
        color: var(--hx-text);
    }

    .hx-empty__title {
        font-size: 15px;
        font-weight: 900;
        color: var(--hx-text);
        margin-bottom: .35rem;
    }

    .hx-empty__text {
        font-size: 13px;
        line-height: 2;
        color: var(--hx-text-muted);
    }

    .hx-new-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 48px;
        height: 28px;
        padding: 0 .8rem;
        border-radius: 999px;
        background: rgba(239, 68, 68, .12);
        color: var(--hx-danger);
        border: 1px solid rgba(239, 68, 68, .18);
        font-size: 11px;
        font-weight: 900;
    }

    .hx-headline {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        width: 100%;
    }

    .hx-headline__side {
        display: flex;
        align-items: center;
        gap: .85rem;
    }

    .hx-headline__icon {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--hx-border);
        background: var(--hx-surface-2);
        color: var(--hx-text);
        font-size: 1.15rem;
    }

    .hx-headline__count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 36px;
        padding: 0 .9rem;
        border-radius: 999px;
        background: var(--hx-surface-2);
        border: 1px solid var(--hx-border);
        color: var(--hx-text-muted);
        font-size: 12px;
        font-weight: 900;
    }

    .hx-msg {
        direction: rtl;
    }

    .hx-msg [data-msg-layout] {
        display: grid;
        grid-template-columns: minmax(0,1fr) 360px;
        grid-template-areas: "pane sidebar";
        gap: .8rem;
        min-height: 72vh;
    }

    .hx-msg [data-msg-sidebar] {
        grid-area: sidebar;
        border: 1px solid var(--hx-border);
        border-radius: 22px;
        background: var(--hx-chat-list-bg);
        overflow: hidden;
    }

    .hx-msg [data-msg-pane] {
        grid-area: pane;
        border: 1px solid var(--hx-border);
        border-radius: 22px;
        background: var(--hx-chat-pane-bg);
        overflow: hidden;
        position: relative;
    }

    .hx-msg [data-msg-sidebar-top] {
        padding: .9rem;
        border-bottom: 1px solid var(--hx-border);
        background: var(--hx-surface-2);
    }

    .hx-msg [data-msg-sidebar-title] {
        font-size: 13px;
        font-weight: 900;
        color: var(--hx-text);
        margin-bottom: .55rem;
        text-align: right;
    }

    .hx-msg [data-msg-list] {
        max-height: calc(72vh - 92px);
        overflow-y: auto;
        padding: .5rem;
        display: flex;
        flex-direction: column;
        gap: .45rem;
        background: var(--hx-chat-list-bg);
    }

    .hx-msg [data-msg-item] {
        width: 100%;
        border: 1px solid transparent;
        background: transparent;
        color: inherit;
        border-radius: 18px;
        padding: .75rem .8rem;
        display: flex;
        align-items: center;
        gap: .7rem;
        text-align: right;
        direction: rtl;
        transition: .2s ease;
    }

    .hx-msg [data-msg-item]:hover {
        background: var(--hx-surface-2);
        border-color: var(--hx-border);
    }

    .hx-msg [data-msg-item].active {
        background: var(--hx-surface-2);
        border-color: var(--hx-border-strong);
    }

    .hx-msg [data-msg-avatar],
    .hx-msg [data-msg-chat-avatar],
    .hx-msg [data-msg-inline-avatar] {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 900;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
    }

    .hx-msg [data-msg-avatar] {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 50%;
        font-size: 15px;
    }

    .hx-msg [data-msg-chat-avatar] {
        width: 46px;
        height: 46px;
        min-width: 46px;
        border-radius: 50%;
        font-size: 14px;
    }

    .hx-msg [data-msg-inline-avatar] {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 50%;
        font-size: 11px;
        flex: 0 0 34px;
    }

    .hx-msg [data-msg-item-body] {
        flex: 1 1 auto;
        min-width: 0;
        text-align: right;
    }

    .hx-msg [data-msg-item-top] {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .5rem;
        margin-bottom: .18rem;
    }

    .hx-msg [data-msg-name],
    .hx-msg [data-msg-chat-name] {
        font-weight: 900;
        color: var(--hx-text);
    }

    .hx-msg [data-msg-name] {
        font-size: 14px;
    }

    .hx-msg [data-msg-chat-name] {
        font-size: 15px;
        line-height: 1.4;
    }

    .hx-msg [data-msg-preview],
    .hx-msg [data-msg-chat-status],
    .hx-msg [data-msg-time],
    .hx-msg [data-msg-bubble-time],
    .hx-msg [data-msg-bubble-sender] {
        color: var(--hx-text-muted);
    }

    .hx-msg [data-msg-preview] {
        display: block;
        font-size: 12.5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .hx-msg [data-msg-item-meta] {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: .3rem;
        min-width: 44px;
        flex: 0 0 44px;
    }

    .hx-msg [data-msg-time] {
        font-size: 11px;
        font-weight: 800;
        white-space: nowrap;
    }

    .hx-msg [data-msg-unread-dot] {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--hx-success);
        box-shadow: 0 0 0 4px rgba(34, 197, 94, .12);
    }

    .hx-msg [data-msg-chat-head] {
        padding: .9rem 1rem;
        border-bottom: 1px solid var(--hx-border);
        background: var(--hx-surface-2);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: .75rem;
    }

    .hx-msg [data-msg-chat-user] {
        display: flex;
        align-items: center;
        gap: .75rem;
        direction: rtl;
    }

    .hx-msg [data-msg-chat-scroll] {
        height: calc(72vh - 170px);
        overflow-y: auto;
        padding: 1rem;
        background: var(--hx-chat-scroll-bg) !important;
        background-image: none !important;
        display: flex;
        flex-direction: column;
        gap: .8rem;
        direction: rtl;
    }

    .hx-msg [data-msg-row] {
        display: flex;
        align-items: flex-end;
        gap: .55rem;
        width: 100%;
    }

    .hx-msg [data-msg-row].mine {
        justify-content: flex-end;
    }

    .hx-msg [data-msg-row].theirs {
        justify-content: flex-start;
    }

    .hx-msg [data-msg-bubble-wrap] {
        max-width: min(78%, 620px);
        text-align: right;
    }

    .hx-msg [data-msg-bubble-sender] {
        font-size: 11px;
        font-weight: 800;
        margin-bottom: .2rem;
        padding-inline: .35rem;
    }

    .hx-msg [data-msg-bubble] {
        border-radius: 20px;
        padding: .7rem .85rem .5rem;
        font-size: 13.4px;
        line-height: 1.9;
        text-align: right;
        direction: rtl;
        word-break: break-word;
        box-shadow: var(--hx-shadow-sm);
    }

    .hx-msg [data-msg-bubble].mine {
        background: var(--hx-chat-mine);
        border: 1px solid var(--hx-chat-mine-border);
        color: var(--hx-text);
        border-top-right-radius: 8px;
    }

    .hx-msg [data-msg-bubble].theirs {
        background: var(--hx-chat-theirs);
        border: 1px solid var(--hx-chat-theirs-border);
        color: var(--hx-text);
        border-top-left-radius: 8px;
    }

    .hx-msg [data-msg-bubble-time] {
        display: block;
        margin-top: .35rem;
        font-size: 10.5px;
        text-align: left;
        direction: ltr;
    }

    .hx-msg [data-msg-compose] {
        padding: .85rem;
        border-top: 1px solid var(--hx-border);
        background: var(--hx-chat-pane-bg);
    }

    .hx-msg [data-msg-compose-form] {
        display: flex;
        align-items: flex-end;
        gap: .55rem;
        direction: rtl;
    }

    .hx-msg [data-msg-compose-form] textarea {
        min-height: 52px;
        resize: none;
        border-radius: 18px;
        border: 1px solid var(--hx-border);
        background: var(--hx-surface);
        color: var(--hx-text);
        text-align: right;
        direction: rtl;
        box-shadow: none !important;
    }

    .hx-msg [data-msg-compose-form] textarea:focus {
        border-color: var(--hx-primary);
        background: var(--hx-surface);
        color: var(--hx-text);
    }

    .hx-msg [data-msg-send-btn] {
        min-width: 92px;
        height: 52px;
        border-radius: 16px !important;
        font-weight: 800;
        white-space: nowrap;
    }

    .hx-msg [data-msg-empty] {
        height: 100%;
        min-height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: var(--hx-text-muted);
        padding: 1.5rem;
        background: var(--hx-chat-pane-bg);
    }

    .hx-msg [data-msg-empty-box] {
        max-width: 360px;
    }

    .hx-msg [data-msg-empty-box] i {
        font-size: 2.2rem;
        display: block;
        margin-bottom: .8rem;
    }

    @media (max-width: 991.98px) {
        #headerMessagesModal .modal-dialog,
        #headerNotificationsModal .modal-dialog,
        #headerAnnouncementsModal .modal-dialog {
            max-width: 100%;
            margin: 0;
        }

        .hx-modal .modal-content {
            min-height: 100vh;
            border-radius: 0 !important;
        }

        .hx-msg .modal-body {
            padding: 0;
        }

        .hx-msg [data-msg-layout] {
            grid-template-columns: 1fr;
            grid-template-areas: "sidebar";
            gap: 0;
            min-height: calc(100vh - 126px);
        }

        .hx-msg [data-msg-sidebar],
        .hx-msg [data-msg-pane] {
            border: 0;
            border-radius: 0;
        }

        .hx-msg [data-msg-pane] {
            display: none;
        }

        .hx-msg [data-msg-layout].show-chat {
            grid-template-areas: "pane";
        }

        .hx-msg [data-msg-layout].show-chat [data-msg-sidebar] {
            display: none;
        }

        .hx-msg [data-msg-layout].show-chat [data-msg-pane] {
            display: block;
        }

        .hx-msg [data-msg-list] {
            max-height: calc(100vh - 210px);
        }

        .hx-msg [data-msg-item] {
            border-radius: 0;
            border-bottom: 1px solid var(--hx-border);
        }

        .hx-msg [data-msg-chat-scroll] {
            height: calc(100vh - 255px);
            padding: .85rem;
        }

        .hx-msg [data-msg-bubble-wrap] {
            max-width: 88%;
        }
    }

    @media (max-width: 639.98px) {
        .hx-header__row {
            min-height: 66px;
        }

        .hx-header__logo {
            height: 40px;
        }

        .hx-header__logo img {
            max-height: 34px;
        }

        .hx-icon-btn {
            width: 40px;
            height: 40px;
            min-width: 40px;
            border-radius: 14px !important;
        }

        .hx-icon-btn i {
            font-size: 1rem;
        }

        .hx-badge {
            min-width: 20px;
            height: 20px;
            font-size: 10px;
        }

        .hx-header__dashboard-btn {
            height: 39px;
            padding-inline: 10px !important;
            font-size: 13px;
        }
    }
</style>

<nav class="hx-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center hx-header__row">
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard') }}" class="shrink-0">
                    <div class="hx-header__logo">
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                    </div>
                </a>

                <a href="{{ route('dashboard') }}"
                   class="btn btn-primary d-none d-sm-inline-flex align-items-center gap-2 hx-header__dashboard-btn {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>داشبورد</span>
                </a>
            </div>

            <div class="d-none d-sm-flex hx-header__actions">
                <button type="button" class="btn hx-icon-btn" data-bs-toggle="modal" data-bs-target="#headerAnnouncementsModal" aria-label="اطلاعیه‌ها" title="اطلاعیه‌ها">
                    <i class="bi bi-megaphone"></i>
                    @if($announcementsCount > 0)
                        <span class="hx-badge hx-badge--primary">{{ $announcementsCount }}</span>
                    @endif
                </button>

                <button type="button" class="btn hx-icon-btn" data-bs-toggle="modal" data-bs-target="#headerNotificationsModal" aria-label="اعلان‌ها" title="اعلان‌ها">
                    <i class="bi bi-bell"></i>
                    @if($notificationsCount > 0)
                        <span class="hx-badge hx-badge--danger">{{ $notificationsCount }}</span>
                    @endif
                </button>

                <button type="button" class="btn hx-icon-btn" data-theme-toggle aria-label="تغییر تم" title="تغییر تم">
                    <i class="bi bi-moon-stars-fill" data-theme-icon></i>
                </button>

                @auth
                    <button type="button" class="btn hx-icon-btn" data-bs-toggle="modal" data-bs-target="#headerMessagesModal" aria-label="پیام‌ها" title="پیام‌ها">
                        <i class="bi bi-chat-dots"></i>
                        @if($messagesCount > 0)
                            <span class="hx-badge hx-badge--success">{{ $messagesCount }}</span>
                        @endif
                    </button>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn hx-icon-btn" aria-label="خروج" title="خروج">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                @endauth
            </div>

            <div class="d-flex d-sm-none hx-header__actions--mobile">
                <button type="button" class="btn hx-icon-btn" data-bs-toggle="modal" data-bs-target="#headerAnnouncementsModal" aria-label="اطلاعیه‌ها" title="اطلاعیه‌ها">
                    <i class="bi bi-megaphone"></i>
                    @if($announcementsCount > 0)
                        <span class="hx-badge hx-badge--primary">{{ $announcementsCount }}</span>
                    @endif
                </button>

                <button type="button" class="btn hx-icon-btn" data-bs-toggle="modal" data-bs-target="#headerNotificationsModal" aria-label="اعلان‌ها" title="اعلان‌ها">
                    <i class="bi bi-bell"></i>
                    @if($notificationsCount > 0)
                        <span class="hx-badge hx-badge--danger">{{ $notificationsCount }}</span>
                    @endif
                </button>

                <button type="button" class="btn hx-icon-btn" data-theme-toggle aria-label="تغییر تم" title="تغییر تم">
                    <i class="bi bi-moon-stars-fill" data-theme-icon></i>
                </button>

                @auth
                    <button type="button" class="btn hx-icon-btn" data-bs-toggle="modal" data-bs-target="#headerMessagesModal" aria-label="پیام‌ها" title="پیام‌ها">
                        <i class="bi bi-chat-dots"></i>
                        @if($messagesCount > 0)
                            <span class="hx-badge hx-badge--success">{{ $messagesCount }}</span>
                        @endif
                    </button>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn hx-icon-btn" aria-label="خروج" title="خروج">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="modal fade hx-modal" id="headerAnnouncementsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <div class="hx-headline">
                    <button type="button" class="btn-close m-0 ms-2" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="hx-headline__side">
                        <div class="text-end">
                            <h5 class="modal-title fw-bold mb-1">اطلاعیه‌ها</h5>
                            <div class="small text-muted">آخرین اطلاعیه‌های سیستم</div>
                        </div>

                        <div class="hx-headline__icon">
                            <i class="bi bi-megaphone"></i>
                        </div>

                        <div class="hx-headline__count" data-ann-count>{{ $announcementsCount }} مورد</div>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                @if($announcementsCount > 0)
                    <div class="hx-panel-list">
                        @foreach($headerAnnouncements as $announcement)
                            <div class="hx-card">
                                <h6 class="hx-card__title">{{ $announcement->title }}</h6>

                                <div class="hx-card__text">{{ $announcement->message }}</div>

                                <div class="hx-card__meta">
                                    <span class="hx-chip">
                                        <i class="bi bi-person"></i>
                                        <span>{{ $announcement->creator?->name ?? '---' }}</span>
                                    </span>

                                    <span class="hx-chip">
                                        <i class="bi bi-clock-history"></i>
                                        <span>{{ \Hekmatinasser\Verta\Verta::instance($announcement->created_at)->format('Y/m/d H:i') }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="hx-empty">
                        <div class="hx-empty__icon">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <div class="hx-empty__title">اطلاعیه‌ای وجود ندارد</div>
                        <div class="hx-empty__text">در حال حاضر موردی برای نمایش ثبت نشده است.</div>
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

<div class="modal fade hx-modal" id="headerNotificationsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <div class="hx-headline">
                    <button type="button" class="btn-close m-0 ms-2" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="hx-headline__side">
                        <div class="text-end">
                            <h5 class="modal-title fw-bold mb-1">اعلان‌ها</h5>
                            <div class="small text-muted">اعلان‌های اخیر شما</div>
                        </div>

                        <div class="hx-headline__icon">
                            <i class="bi bi-bell"></i>
                        </div>

                        <div class="hx-headline__count" data-notif-count>{{ $notificationsCount }} دیده‌نشده</div>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                @if($headerNotifications->count() > 0)
                    <div class="hx-panel-list">
                        @foreach($headerNotifications as $notification)
                            <div class="hx-card">
                                <div class="d-flex align-items-start justify-content-between gap-2 mb-2">
                                    <h6 class="hx-card__title mb-0">{{ $notification->title }}</h6>

                                    @if(!$notification->seen)
                                        <span class="hx-new-badge" data-notif-new>جدید</span>
                                    @endif
                                </div>

                                @if(!empty($notification->message))
                                    <div class="hx-card__text">{{ $notification->message }}</div>
                                @endif

                                @php
                                    $notifLeave = $notification->leave;
                                    $canSubstituteAction = $notifLeave && $notifLeave->status === 'pending' && (int) $notifLeave->substitute_user_id === (int) auth()->id();
                                    $canManagerAction = $notifLeave && $notifLeave->status === 'manager_approved' && auth()->user()->hasRole('Manager') && (int) $notifLeave->manager_id === (int) auth()->id();
                                    $canInternalAction = $notifLeave && $notifLeave->status === 'internal_approved' && (auth()->user()->hasRole('Admin') || auth()->user()->hasAnyRole(['internalManager', 'InternalManager']));
                                @endphp

                                @if($canSubstituteAction || $canManagerAction || $canInternalAction)
                                    <div class="d-flex gap-2 mt-3">
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

                                <div class="hx-card__meta">
                                    <span class="hx-chip">
                                        <i class="bi bi-clock-history"></i>
                                        <span>{{ \Hekmatinasser\Verta\Verta::instance($notification->created_at)->format('Y/m/d H:i') }}</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="hx-empty">
                        <div class="hx-empty__icon">
                            <i class="bi bi-bell"></i>
                        </div>
                        <div class="hx-empty__title">اعلانی وجود ندارد</div>
                        <div class="hx-empty__text">فعلاً اعلان جدیدی برای شما ثبت نشده است.</div>
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade hx-modal hx-msg" id="headerMessagesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <button type="button" class="btn-close m-0 ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-end">
                        <h5 class="modal-title fw-bold mb-1">پیام‌ها</h5>
                        <div class="small text-muted">نمای گفتگو</div>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <div data-msg-layout>
                    <aside data-msg-sidebar>
                        <div data-msg-sidebar-top>
                            <div data-msg-sidebar-title">شروع گفتگوی جدید</div>
                            <select class="form-select form-select-sm" data-msg-new-user>
                                <option value="">یک کاربر را انتخاب کنید...</option>
                                @foreach(($headerMessageUsers ?? collect()) as $msgUser)
                                    <option value="{{ $msgUser->id }}">{{ $msgUser->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div data-msg-list>
                            @forelse(($headerMessages ?? collect()) as $messageItem)
                                @php
                                    $otherUser = $messageItem->sender_id === auth()->id() ? $messageItem->receiver : $messageItem->sender;
                                @endphp

                                @continue(!$otherUser)

                                @php
                                    $isUnread = $messageItem->receiver_id === auth()->id() && is_null($messageItem->seen_at);
                                    $avatarText = trim(mb_substr($otherUser->name, 0, 1));
                                @endphp

                                <button type="button" data-msg-item data-chat-target="{{ $otherUser->id }}">
                                    <span data-msg-avatar>{{ $avatarText }}</span>

                                    <span data-msg-item-body>
                                        <span data-msg-item-top>
                                            <span data-msg-name>{{ $otherUser->name }}</span>
                                        </span>
                                        <span data-msg-preview>{{ \Illuminate\Support\Str::limit($messageItem->body ?? 'پیوست ارسال شده', 36) }}</span>
                                    </span>

                                    <span data-msg-item-meta>
                                        <span data-msg-time>{{ \Hekmatinasser\Verta\Verta::instance($messageItem->created_at)->format('H:i') }}</span>
                                        @if($isUnread)
                                            <span data-msg-unread-dot></span>
                                        @endif
                                    </span>
                                </button>
                            @empty
                                <div class="small text-muted text-center py-4">هنوز گفتگویی ندارید.</div>
                            @endforelse
                        </div>
                    </aside>

                    <section data-msg-pane>
                        @if(($headerMessageConversations ?? collect())->count() > 0)
                            @foreach($headerMessageConversations as $threadUserId => $threadMessages)
                                @php
                                    $threadFirst = $threadMessages->first();
                                    $threadUser = $threadFirst
                                        ? ($threadFirst->sender_id === auth()->id() ? $threadFirst->receiver : $threadFirst->sender)
                                        : null;
                                @endphp

                                @if($threadUser)
                                    @php
                                        $threadAvatar = trim(mb_substr($threadUser->name, 0, 1));
                                    @endphp

                                    <div data-msg-thread="{{ $threadUserId }}" style="{{ $firstThreadUser && (int) $firstThreadUser->id === (int) $threadUserId ? '' : 'display:none;' }}">
                                        <div data-msg-chat-head>
                                            <div data-msg-chat-user>
                                                <div data-msg-chat-avatar>{{ $threadAvatar }}</div>
                                                <div class="text-end">
                                                    <div data-msg-chat-name>{{ $threadUser->name }}</div>
                                                    <div data-msg-chat-status>گفتگوی مستقیم</div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button" class="btn btn-link text-decoration-none p-0 d-lg-none" data-msg-back>
                                                    <i class="bi bi-arrow-right fs-4"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div data-msg-chat-scroll>
                                            @foreach($threadMessages as $chatItem)
                                                @php
                                                    $isMine = (int) $chatItem->sender_id === (int) auth()->id();
                                                @endphp

                                                <div data-msg-row class="{{ $isMine ? 'mine' : 'theirs' }}">
                                                    @if(!$isMine)
                                                        <div data-msg-inline-avatar>{{ $threadAvatar }}</div>
                                                    @endif

                                                    <div data-msg-bubble-wrap>
                                                        @if(!$isMine)
                                                            <div data-msg-bubble-sender>{{ $threadUser->name }}</div>
                                                        @endif

                                                        <div data-msg-bubble class="{{ $isMine ? 'mine' : 'theirs' }}">
                                                            <div>{{ $chatItem->body ?: 'پیوست ارسال شد.' }}</div>
                                                            <span data-msg-bubble-time>{{ \Hekmatinasser\Verta\Verta::instance($chatItem->created_at)->format('Y/m/d H:i') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div data-msg-compose>
                                            <form action="{{ route('messages.reply', $threadUserId) }}" method="POST" data-msg-compose-form>
                                                @csrf
                                                <textarea class="form-control form-control-sm" name="body" rows="2" required placeholder="پیام خود را بنویسید..."></textarea>
                                                <button class="btn btn-primary btn-sm px-3" data-msg-send-btn type="submit">ارسال</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif

                        <div data-msg-empty data-msg-placeholder style="{{ ($headerMessageConversations ?? collect())->count() > 0 ? 'display:none;' : '' }}">
                            <div data-msg-empty-box>
                                <i class="bi bi-chat-dots"></i>
                                <div class="fw-bold mb-2">هنوز گفتگویی انتخاب نشده است</div>
                                <div>از ستون سمت راست یک گفتگو را انتخاب کنید یا گفتگوی جدید بسازید.</div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

            <div class="modal-footer">
                <small class="text-muted">برای پاسخ سریع، گفتگو را همین‌جا ادامه دهید.</small>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<script>
    (function () {
        const savedTheme = localStorage.getItem('theme');
        const systemTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        const theme = savedTheme || systemTheme;
        document.documentElement.setAttribute('data-bs-theme', theme);
    })();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('[data-theme-toggle]');

        function nextTheme(theme) {
            return theme === 'dark' ? 'light' : 'dark';
        }

        function syncThemeButtons(theme) {
            const next = nextTheme(theme);

            toggles.forEach((toggle) => {
                const icon = toggle.querySelector('[data-theme-icon]');
                if (icon) {
                    icon.className = next === 'dark' ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
                }

                toggle.setAttribute('title', next === 'dark' ? 'تغییر به تم تیره' : 'تغییر به تم روشن');
                toggle.setAttribute('aria-label', next === 'dark' ? 'تغییر به تم تیره' : 'تغییر به تم روشن');
            });
        }

        const currentTheme = document.documentElement.getAttribute('data-bs-theme') || 'light';
        syncThemeButtons(currentTheme);

        toggles.forEach((toggle) => {
            toggle.addEventListener('click', function () {
                const active = document.documentElement.getAttribute('data-bs-theme') || 'light';
                const selected = nextTheme(active);

                document.documentElement.setAttribute('data-bs-theme', selected);
                localStorage.setItem('theme', selected);
                syncThemeButtons(selected);
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notificationModal = document.getElementById('headerNotificationsModal');
        const announcementModal = document.getElementById('headerAnnouncementsModal');

        const NOTIFICATION_BADGE_DELAY = 1800;
        const ANNOUNCEMENT_BADGE_DELAY = 1800;

        function hideBadges(selector) {
            document.querySelectorAll(selector).forEach((badge) => {
                badge.textContent = '0';
                badge.style.display = 'none';
            });
        }

        const latestAnnouncementId = {{ (int) optional($headerAnnouncements->first())->id }};
        const seenAnnouncementId = parseInt(localStorage.getItem('seen_header_announcement_id') || '0', 10);

        if (latestAnnouncementId > 0 && seenAnnouncementId >= latestAnnouncementId) {
            hideBadges('.hx-badge--primary');
        }

        if (announcementModal) {
            announcementModal.addEventListener('shown.bs.modal', function () {
                if (latestAnnouncementId <= 0) return;

                localStorage.setItem('seen_header_announcement_id', String(latestAnnouncementId));

                setTimeout(() => {
                    const annCountLabel = announcementModal.querySelector('[data-ann-count]');
                    if (annCountLabel) {
                        annCountLabel.textContent = '0 مورد جدید';
                    }
                    hideBadges('.hx-badge--primary');
                }, ANNOUNCEMENT_BADGE_DELAY);
            });
        }

        if (!notificationModal) return;

        let markedSeen = false;

        notificationModal.addEventListener('shown.bs.modal', async function () {
            if (markedSeen) return;

            const unseenCount = {{ (int)($headerNotificationsUnseenCount ?? 0) }};
            if (unseenCount <= 0) return;

            try {
                const response = await fetch("{{ route('notifications.markAllSeen') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({})
                });

                if (!response.ok) return;

                markedSeen = true;

                setTimeout(() => {
                    const notifCountLabel = notificationModal.querySelector('[data-notif-count]');
                    if (notifCountLabel) {
                        notifCountLabel.textContent = '0 دیده‌نشده';
                    }

                    notificationModal.querySelectorAll('[data-notif-new]').forEach((el) => el.remove());
                    hideBadges('.hx-badge--danger');
                }, NOTIFICATION_BADGE_DELAY);
            } catch (e) {
                //
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('headerMessagesModal');
        if (!modal) return;

        const layout = modal.querySelector('[data-msg-layout]');
        const threadButtons = modal.querySelectorAll('[data-msg-item][data-chat-target]');
        const threads = modal.querySelectorAll('[data-msg-thread]');
        const placeholder = modal.querySelector('[data-msg-placeholder]');
        const newUserSelect = modal.querySelector('[data-msg-new-user]');
        const backButtons = modal.querySelectorAll('[data-msg-back]');
        const baseReplyPath = "{{ url('/messages') }}";

        function isMobile() {
            return window.innerWidth < 992;
        }

        function scrollThreadToBottom(thread) {
            const scroll = thread ? thread.querySelector('[data-msg-chat-scroll]') : null;
            if (scroll) scroll.scrollTop = scroll.scrollHeight;
        }

        function showListOnMobile() {
            if (isMobile() && layout) layout.classList.remove('show-chat');
        }

        function showChatOnMobile() {
            if (isMobile() && layout) layout.classList.add('show-chat');
        }

        function activateThread(userId) {
            let found = false;

            threadButtons.forEach((btn) => {
                btn.classList.toggle('active', btn.dataset.chatTarget === String(userId));
            });

            threads.forEach((thread) => {
                const match = thread.getAttribute('data-msg-thread') === String(userId);
                thread.style.display = match ? '' : 'none';

                if (match) {
                    found = true;
                    scrollThreadToBottom(thread);
                }
            });

            if (placeholder) {
                placeholder.style.display = found ? 'none' : '';
            }

            if (found) showChatOnMobile();
        }

        threadButtons.forEach((btn) => {
            btn.addEventListener('click', function () {
                activateThread(this.dataset.chatTarget);
            });
        });

        backButtons.forEach((btn) => {
            btn.addEventListener('click', function () {
                showListOnMobile();
            });
        });

        if (newUserSelect) {
            newUserSelect.addEventListener('change', function () {
                const userId = this.value;
                const userName = this.options[this.selectedIndex]?.text || 'کاربر';

                if (!userId || !placeholder) return;

                const existingThread = modal.querySelector(`[data-msg-thread="${userId}"]`);
                if (existingThread) {
                    activateThread(userId);
                    return;
                }

                threadButtons.forEach((btn) => btn.classList.remove('active'));
                threads.forEach((thread) => thread.style.display = 'none');

                const avatar = (userName || '?').trim().charAt(0);

                placeholder.innerHTML = `
                    <div class="w-100 h-100 d-flex flex-column">
                        <div data-msg-chat-head>
                            <div data-msg-chat-user>
                                <div data-msg-chat-avatar>${avatar}</div>
                                <div class="text-end">
                                    <div data-msg-chat-name>${userName}</div>
                                    <div data-msg-chat-status>گفتگوی جدید</div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2">
                                <button type="button" class="btn btn-link text-decoration-none p-0 d-lg-none" data-msg-dynamic-back>
                                    <i class="bi bi-arrow-right fs-4"></i>
                                </button>
                            </div>
                        </div>

                        <div data-msg-chat-scroll class="flex-grow-1">
                            <div class="text-center text-muted py-5">اولین پیام را ارسال کنید.</div>
                        </div>

                        <div data-msg-compose>
                            <form method="POST" action="${baseReplyPath}/${userId}/reply" data-msg-compose-form>
                                <textarea class="form-control form-control-sm" name="body" rows="2" required placeholder="اولین پیام خود را بنویسید..."></textarea>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button class="btn btn-primary btn-sm px-3" data-msg-send-btn type="submit">ارسال</button>
                            </form>
                        </div>
                    </div>
                `;

                placeholder.style.display = '';
                showChatOnMobile();

                const dynamicBack = placeholder.querySelector('[data-msg-dynamic-back]');
                if (dynamicBack) {
                    dynamicBack.addEventListener('click', function () {
                        showListOnMobile();
                    });
                }
            });
        }

        modal.addEventListener('shown.bs.modal', function () {
            if (isMobile()) {
                showListOnMobile();
                return;
            }

            const active = modal.querySelector('[data-msg-item].active');
            if (active) {
                activateThread(active.dataset.chatTarget);
                return;
            }

            const firstButton = modal.querySelector('[data-msg-item][data-chat-target]');
            if (firstButton) {
                activateThread(firstButton.dataset.chatTarget);
            }
        });

        window.addEventListener('resize', function () {
            if (!layout) return;

            if (!isMobile()) {
                layout.classList.remove('show-chat');

                const active = modal.querySelector('[data-msg-item].active');
                if (active) activateThread(active.dataset.chatTarget);
            } else {
                const active = modal.querySelector('[data-msg-item].active');
                if (!active) showListOnMobile();
            }
        });
    });
</script>