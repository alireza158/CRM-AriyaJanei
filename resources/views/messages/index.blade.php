{{-- resources/views/messages/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="fw-bold mb-0">💬 پیام‌ها</h2>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary d-none d-sm-inline-flex" data-bs-toggle="modal" data-bs-target="#newGroup">
                    <i class="bi bi-people me-1"></i> ساخت گروه
                </button>
                <button class="btn btn-success d-none d-sm-inline-flex" data-bs-toggle="modal" data-bs-target="#newMessage">
                    <i class="bi bi-plus-lg me-1"></i> ارسال پیام جدید
                </button>
            </div>
        </div>
    </x-slot>

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        .avatar{
            width: 36px; height: 36px; border-radius: 50%;
            display: grid; place-items: center; font-weight: 700;
            background: #eef2ff; color: #3949ab;
            flex: 0 0 36px;
        }
        .thread-item{ transition: background-color .15s ease, box-shadow .15s ease; }
        .thread-item:hover{ background-color: #f8fafc; }
        .title-line{
            display: flex; align-items: center; justify-content: space-between; gap: .75rem;
        }
        .name{
            font-weight: 600; color: var(--bs-emphasis-color);
            max-width: 60%;
            overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
        }
        .preview{
            color: var(--bs-secondary-color);
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
            overflow: hidden; margin: .15rem 0 0;
        }
        .pill{
            font-size: .75rem; padding: .15rem .45rem; border-radius: 999px;
        }
        .unread-dot{
            width: 9px; height: 9px; border-radius: 50%; background: #2563eb; flex: 0 0 9px;
        }
        .attach{
            color: #16a34a;
        }
        .empty{
            border: 1px dashed var(--bs-border-color); border-radius: .75rem;
            padding: 2rem; background: #fff;
        }
        @media (max-width: 576px){
            .name{ max-width: 58%; }
            .fab{
                position: fixed; bottom: 76px; inset-inline-end: 16px; z-index: 1050;
            }
        }
    </style>

    <div class="container py-3" dir="rtl">
        {{-- نوار ابزار بالا: جستجو و فیلتر --}}
        <div class="card shadow-sm mb-3">
            <div class="card-body py-2">
                <div class="row g-2 align-items-center">
                    <div class="col-12 col-sm">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input id="searchBox" type="text" class="form-control" placeholder="جستجو در اسم یا متن آخرین پیام…">
                        </div>
                    </div>
                    <div class="col-6 col-sm-auto">
                        <select id="filterSelect" class="form-select">
                            <option value="all">همه گفتگوها</option>
                            <option value="unread">فقط خوانده‌نشده</option>
                            <option value="attach">دارای پیوست</option>
                        </select>
                    </div>
                    <div class="col-6 col-sm-auto d-none d-sm-block">
                        <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#newMessage">
                            <i class="bi bi-plus-lg me-1"></i> پیام جدید
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- گروه‌ها --}}
        <div class="card shadow-sm mb-3">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="bi bi-people-fill me-1 text-primary"></i> گروه‌های من</h6>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#newGroup">
                    <i class="bi bi-plus-lg"></i> گروه جدید
                </button>
            </div>
            <div class="card-body">
                @if(($groups ?? collect())->count())
                    <div class="row g-2">
                        @foreach($groups as $group)
                            <div class="col-12 col-md-6">
                                <div class="border rounded p-2 h-100 d-flex flex-column">
                                    <div class="fw-bold">{{ $group->name }}</div>
                                    <small class="text-muted d-block mb-1">سازنده: {{ $group->creator?->name ?? '---' }}</small>
                                    <small class="text-muted d-block mb-2">
                                        اعضا ({{ $group->users->count() }}):
                                        {{ $group->users->pluck('name')->join('، ') }}
                                    </small>
                                    <div class="mt-auto">
                                        <button type="button"
                                                class="btn btn-sm btn-primary w-100"
                                                data-bs-toggle="modal"
                                                data-bs-target="#sendGroupMessageModal"
                                                data-group-id="{{ $group->id }}"
                                                data-group-name="{{ $group->name }}">
                                            <i class="bi bi-send me-1"></i> ارسال پیام گروهی
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted mb-0">هنوز گروهی نساخته‌اید.</p>
                @endif
            </div>
        </div>

        {{-- لیست گفتگوها --}}
        @if($threads->count())
            <div id="threadList" class="list-group shadow-sm rounded overflow-hidden">
                @foreach($threads as $msg)
                    @php
                        $authId   = auth()->id();
                        $other    = $msg->sender_id === $authId ? $msg->receiver : $msg->sender;
                        $isUnread = is_null($msg->seen_at) && $msg->receiver_id === $authId;
                        $hasFile  = (bool)$msg->attachment;
                    @endphp

                    <a href="{{ route('messages.show', $other->id) }}"
                       class="list-group-item list-group-item-action thread-item"
                       data-name="{{ $other->name }}"
                       data-body="{{ Str::limit($msg->body, 200) }}"
                       data-unread="{{ $isUnread ? '1' : '0' }}"
                       data-attach="{{ $hasFile ? '1' : '0' }}">
                        <div class="d-flex align-items-start gap-2">
                            {{-- آواتار حرف اول --}}
                            <div class="avatar">{{ mb_substr($other->name,0,1,'UTF-8') }}</div>

                            <div class="flex-grow-1">
                                <div class="title-line">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="name">{{ $other->name }}</span>
                                        @if($hasFile)
                                            <i class="bi bi-paperclip attach" title="پیوست دارد"></i>
                                        @endif
                                        @if($isUnread)
                                            <span class="pill bg-primary text-white">جدید</span>
                                        @endif
                                    </div>
                                    <small class="text-muted ms-2">{{ $msg->created_at->format('Y/m/d H:i') }}</small>
                                </div>

                                <div class="preview">
                                    {{ $msg->body }}
                                </div>
                            </div>

                            {{-- نقطه خوانده‌نشده --}}
                            @if($isUnread)
                                <div class="unread-dot ms-1"></div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="empty text-center">
                <div class="mb-2"><i class="bi bi-chat-left-text fs-2 text-primary"></i></div>
                <h6 class="mb-1">هیچ مکالمه‌ای ندارید</h6>
                <p class="text-muted mb-3">برای شروع، یک پیام جدید ارسال کنید.</p>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newMessage">
                    <i class="bi bi-plus-lg me-1"></i> ارسال پیام جدید
                </button>
            </div>
        @endif
    </div>

    {{-- FAB موبایل --}}
    <button class="btn btn-success rounded-circle shadow fab d-sm-none" data-bs-toggle="modal" data-bs-target="#newMessage" aria-label="پیام جدید">
        <i class="bi bi-plus-lg"></i>
    </button>

    {{-- Modal ساخت گروه --}}
    <div class="modal fade" id="newGroup" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <form action="{{ route('messages.groups.store') }}" method="POST">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">👥 ساخت گروه جدید</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label class="form-label">نام گروه:</label>
                            <input type="text" name="name" class="form-control" required maxlength="120" placeholder="مثال: تیم فروش تهران">
                        </div>
                        <div class="mb-0">
                            <label class="form-label">اعضا:</label>
                            <div class="border rounded p-2" style="max-height: 260px; overflow: auto;">
                                @foreach($users as $user)
                                    <label class="form-check d-flex align-items-center gap-2 py-1 mb-0">
                                        <input class="form-check-input" type="checkbox" name="members[]" value="{{ $user->id }}">
                                        <span class="form-check-label">{{ $user->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <small class="text-muted">روی موبایل هم می‌توانید چند عضو را با تیک انتخاب کنید.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">✅ ساخت گروه</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">❌ بستن</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal ارسال پیام گروهی --}}
    <div class="modal fade" id="sendGroupMessageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <form id="sendGroupMessageForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">ارسال پیام به گروه: <span id="sendGroupName">---</span></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label class="form-label">متن پیام:</label>
                            <textarea name="body" class="form-control" rows="4" required placeholder="متن پیام برای همه اعضای گروه..."></textarea>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">فایل (اختیاری):</label>
                            <input type="file" name="attachment" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">✅ ارسال به گروه</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">❌ بستن</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Modal پیام جدید --}}
    <div class="modal fade" id="newMessage" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">✉️ پیام جدید</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="mb-3">
                            <label class="form-label">گیرنده:</label>
                            <select name="receiver_id" class="form-select" required>
                                <option value="" disabled selected>انتخاب کاربر...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">متن پیام:</label>
                            <textarea name="body" class="form-control" rows="4" required placeholder="متن پیام..."></textarea>
                        </div>
                        <div class="mb-0">
                            <label class="form-label">فایل (اختیاری):</label>
                            <input type="file" name="attachment" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" type="submit">✅ ارسال</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">❌ بستن</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- فیلتر و جستجوی سمت کلاینت --}}
    <script>
        const list = document.getElementById('threadList');

        const groupModal = document.getElementById('sendGroupMessageModal');
        const groupForm = document.getElementById('sendGroupMessageForm');
        const groupNameEl = document.getElementById('sendGroupName');

        groupModal?.addEventListener('show.bs.modal', (event) => {
            const btn = event.relatedTarget;
            const groupId = btn?.getAttribute('data-group-id');
            const groupName = btn?.getAttribute('data-group-name') || '---';

            if (!groupId || !groupForm) return;

            groupForm.action = `{{ url('/messages/groups') }}/${groupId}/send`;
            if (groupNameEl) groupNameEl.textContent = groupName;
        });
        const searchBox = document.getElementById('searchBox');
        const filterSelect = document.getElementById('filterSelect');

        function applyFilter() {
            if (!list) return;
            const q = (searchBox?.value || '').trim().toLowerCase();
            const f = filterSelect?.value || 'all';

            [...list.children].forEach(item => {
                const name   = (item.dataset.name || '').toLowerCase();
                const body   = (item.dataset.body || '').toLowerCase();
                const unread = item.dataset.unread === '1';
                const attach = item.dataset.attach === '1';

                let ok = true;

                if (q && !(name.includes(q) || body.includes(q))) ok = false;
                if (f === 'unread' && !unread) ok = false;
                if (f === 'attach' && !attach) ok = false;

                item.style.display = ok ? '' : 'none';
            });
        }

        searchBox?.addEventListener('input', applyFilter);
        filterSelect?.addEventListener('change', applyFilter);
        document.addEventListener('DOMContentLoaded', applyFilter);
    </script>
</x-app-layout>
