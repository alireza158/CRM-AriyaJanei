<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 mb-0">چت گروهی: {{ $group->name }}</h2>
            <a href="{{ route('messages.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-right-short"></i> بازگشت
            </a>
        </div>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="container py-2" dir="rtl">
        <div class="card shadow-sm rounded-3 d-flex flex-column overflow-hidden" style="height: clamp(52vh, 62vh, 72vh);">
            <div class="bg-body-tertiary border-bottom px-3 py-2 d-flex align-items-center justify-content-between">
                <div>
                    <div class="fw-semibold">{{ $group->name }}</div>
                    <small class="text-muted">اعضا: {{ $group->users->pluck('name')->join('، ') }}</small>
                </div>
                <button class="btn btn-light btn-sm" type="button" onclick="scrollBottom()">
                    <i class="bi bi-arrow-down-circle"></i>
                </button>
            </div>

            <div id="chat-box" class="flex-grow-1 overflow-auto bg-light p-2">
                @forelse($messages as $msg)
                    @php $isMine = $msg->sender_id == auth()->id(); @endphp
                    <div class="d-flex mb-2 {{ $isMine ? 'justify-content-end' : 'justify-content-start' }}">
                        <div class="rounded px-2 py-1 {{ $isMine ? 'bg-primary text-white' : 'bg-white border' }}" style="max-width: min(520px, 92vw);">
                            <div class="small mb-1 {{ $isMine ? 'text-white-50' : 'text-muted' }}">
                                {{ $msg->sender?->name ?? '---' }}
                            </div>
                            <div>{{ $msg->body }}</div>

                            @if($msg->attachment)
                                <div class="mt-1">
                                    <a href="{{ route('messages.groups.download', $msg->id) }}" class="{{ $isMine ? 'link-light' : '' }} text-decoration-none">
                                        <i class="bi bi-paperclip"></i> دانلود فایل
                                    </a>
                                </div>
                            @endif

                            <div class="small mt-1 {{ $isMine ? 'text-white-50' : 'text-muted' }}">
                                {{ \Hekmatinasser\Verta\Verta::instance($msg->created_at)->format('Y/m/d H:i') }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center mt-3">هنوز پیامی در این گروه ثبت نشده است.</p>
                @endforelse
            </div>

            <div class="border-top bg-white p-2">
                <form action="{{ route('messages.groups.reply', $group->id) }}" method="POST" enctype="multipart/form-data" class="d-flex gap-2 align-items-end">
                    @csrf
                    <div class="flex-grow-1">
                        <textarea name="body" class="form-control" rows="2" required placeholder="پیام خود را برای گروه بنویسید..."></textarea>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <input type="file" name="attachment" class="form-control form-control-sm" style="max-width: 220px;">
                            <button class="btn btn-primary">
                                <i class="bi bi-send"></i> ارسال
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
    </script>
</x-app-layout>
