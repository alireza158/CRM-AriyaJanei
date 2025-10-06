{{-- resources/views/messages/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 mb-0">گفتگو با {{ $otherUser->name }}</h2>
            <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-right-short"></i> بازگشت
            </a>
        </div>
    </x-slot>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ارتفاع کلی کارت چت (فشرده) */
        .chat-card{ height: clamp(52vh, 62vh, 70vh); }
        .chat-header{ position: sticky; top: 0; z-index: 2; }
        .chat-footer{ position: sticky; bottom: 0; z-index: 2; }

        /* فضای داخلی کانتینر پیام‌ها کمتر */
        #chat-box{ padding: .6rem .6rem !important; }

        /* ردیف هر پیام: جلوی Stretch را بگیر */
        .msg-row{
            margin-bottom: .35rem !important;
            align-items: flex-start;        /* مهم: دیگر کش نمی‌آید */
            gap: .4rem;
        }

        /* حباب‌ها: اندازه دقیقاً به اندازه متن + فشرده */
        .bubble{
            display: inline-block;
            flex: 0 0 auto;                 /* مهم: کش نیاید */
            height: auto !important;        /* مهم: ارتفاع فقط به اندازه محتوا */
            min-height: 0 !important;
            width: fit-content;
            max-width: min(480px, 92vw);
          
            word-break: break-word;
            border-radius: .8rem;
            padding: .35rem .5rem;          /* جمع‌وجور */
            box-shadow: 0 1px 2px rgba(0,0,0,.05);
            font-size: .9rem;
            line-height: 1.4;
        }
        .bubble-out{
            background: var(--bs-primary);
            color: #fff;
            border-top-right-radius: .3rem;
        }
        .bubble-in{
            background: #fff;
            border: 1px solid var(--bs-border-color);
            border-top-left-radius: .3rem;
        }
        .bubble .meta{ font-size: .72rem; opacity: .8; margin-top: .15rem; }
        .bubble .mb-1{ margin-bottom: .15rem !important; }

        /* آواتار کوچک‌تر */
        .avatar{
            width: 28px; height: 28px; border-radius: 50%;
            display: grid; place-items: center; font-weight: 700; font-size: .9rem;
        }
        .avatar-in { background: #eef2ff; color: #3949ab; }
        .avatar-out{ background: #e3f2fd; color: #0d47a1; }

        /* textarea خودکاربلندشونده */
        textarea.autogrow{
            resize: none; overflow: hidden;
            min-height: 40px; max-height: 140px;
            font-size: .95rem;
        }

        /* RTL ورودی‌ها */
        [dir="rtl"] .input-group .form-control{ text-align: right; }

        /* موبایل */
        @media (max-width: 576px){
            .chat-card{ height: 65vh; }
            .bubble{ max-width: 94vw; font-size: .9rem; }
        }
    </style>

    <div class="container py-2" dir="rtl">
        <div class="card shadow-sm rounded-3 chat-card d-flex flex-column overflow-hidden">

            {{-- Header --}}
            <div class="chat-header bg-body-tertiary border-bottom px-3 py-2 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="avatar avatar-in">{{ mb_substr($otherUser->name,0,1,'UTF-8') }}</div>
                    <div>
                        <div class="fw-semibold">{{ $otherUser->name }}</div>
                        <small class="text-muted">گفتگو خصوصی</small>
                    </div>
                </div>
                <button class="btn btn-light btn-sm" type="button" onclick="scrollBottom()" title="آخر گفتگو">
                    <i class="bi bi-arrow-down-circle"></i>
                </button>
            </div>

            {{-- پیام‌ها --}}
            <div id="chat-box" class="flex-grow-1 overflow-auto bg-light">
                <div class="px-2 px-sm-3 py-2">
                    @foreach($conversation as $msg)
                        @php $isMine = $msg->sender_id == auth()->id(); @endphp

                        <div class="d-flex msg-row {{ $isMine ? 'justify-content-end' : 'justify-content-start' }}">
                            @unless($isMine)
                                <div class="me-1 d-none d-sm-flex">
                                    <div class="avatar avatar-in">{{ mb_substr(optional($msg->sender)->name ?? '؟',0,1,'UTF-8') }}</div>
                                </div>
                            @endunless

                            <div class="bubble {{ $isMine ? 'bubble-out' : 'bubble-in' }}">
                                <div class="mb-1">{{ $msg->body }}</div>

                                @if($msg->attachment)
                                    <div class="mt-1">
                                        <a href="{{ route('messages.download', $msg->id) }}"
                                           class="text-decoration-none {{ $isMine ? 'link-light' : '' }}">
                                            <i class="bi bi-paperclip"></i> دانلود فایل
                                        </a>
                                    </div>
                                @endif

                                <div class="text-start text-sm-end meta {{ $isMine ? 'text-white-50' : 'text-muted' }}">
                                    {{ \Hekmatinasser\Verta\Verta::instance($msg->created_at)->format('Y/m/d H:i') }}
                                    @if($isMine && $msg->seen_at)
                                        <span class="ms-1"><i class="bi bi-check2-all"></i> دیده شد</span>
                                    @endif
                                </div>
                            </div>

                            @if($isMine)
                                <div class="ms-1 d-none d-sm-flex">
                                    <div class="avatar avatar-out">{{ mb_substr(auth()->user()->name,0,1,'UTF-8') }}</div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Composer --}}
            <div class="chat-footer border-top bg-white p-2">
                <form action="{{ route('messages.reply', $otherUser->id) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-end">
                    @csrf
                    <div class="flex-grow-1">
                        <div class="form-floating">
                            <textarea name="body" id="messageInput" class="form-control autogrow" placeholder="پیام خود را بنویسید..." required></textarea>
                            <label for="messageInput">پیام خود را بنویسید…</label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="d-flex align-items-center gap-2">
                                <label class="btn btn-outline-secondary btn-sm mb-0">
                                    <i class="bi bi-paperclip"></i>
                                    <span class="d-none d-sm-inline">پیوست</span>
                                    <input type="file" name="attachment" class="d-none" id="attachmentInput">
                                </label>
                                <small id="fileName" class="text-muted text-truncate" style="max-width: 50vw;"></small>
                            </div>
                            <button class="btn btn-primary" title="ارسال (Ctrl+Enter)">
                                <i class="bi bi-send"></i>
                                <span class="d-none d-sm-inline">ارسال</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        function scrollBottom() {
            const box = document.getElementById('chat-box');
            box.scrollTop = box.scrollHeight;
        }
        document.addEventListener('DOMContentLoaded', scrollBottom);

        // textarea خودکار-بلندشونده
        const ta = document.getElementById('messageInput');
        function autoGrow(el){
            el.style.height = 'auto';
            el.style.height = Math.min(el.scrollHeight, 140) + 'px';
        }
        ['input','change'].forEach(evt => ta.addEventListener(evt, () => autoGrow(ta)));
        autoGrow(ta);

        // ارسال با Ctrl/Cmd + Enter
        ta.addEventListener('keydown', (e)=>{
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                e.preventDefault();
                e.target.closest('form').submit();
            }
        });

        // نمایش نام فایل
        const fileInput = document.getElementById('attachmentInput');
        const fileNameEl = document.getElementById('fileName');
        fileInput.addEventListener('change', (e) => {
            const f = e.target.files?.[0];
            fileNameEl.textContent = f ? f.name : '';
        });

        // بعد از ارسال، کمی بعد اسکرول پایین
        const form = document.querySelector('form[action="{{ route('messages.reply', $otherUser->id) }}"]');
        form.addEventListener('submit', () => { setTimeout(scrollBottom, 200); });
    </script>
</x-app-layout>
