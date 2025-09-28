<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 mb-0">گفتگو با {{ $otherUser->name }}</h2>
            <a href="{{ route('messages.index') }}" class="btn btn-secondary btn-sm">بازگشت به پیام‌ها</a>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="card shadow-sm rounded-3 d-flex flex-column" style="height: 70vh;">
            <!-- محتوای پیام‌ها -->
            <div id="chat-box" class="flex-grow-1 overflow-auto p-3 bg-light">
                @foreach($conversation as $msg)
                    <div class="d-flex mb-2 {{ $msg->sender_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                        <div class="p-2 rounded {{ $msg->sender_id == auth()->id() ? 'bg-primary text-white' : 'bg-white border' }}" style="max-width: 70%; word-wrap: break-word;">
                            <div>{{ $msg->body }}</div>
                            @if($msg->attachment)
                                <div class="mt-1">
                                    <a href="{{ asset('storage/' . $msg->attachment) }}" target="_blank" class="small text-decoration-none">
                                        📎 فایل ضمیمه
                                    </a>
                                </div>
                            @endif
                            <div class="text-end small text-muted mt-1">
                                {{ \Hekmatinasser\Verta\Verta::instance($msg->created_at)->format('Y/m/d H:i') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- فرم ارسال پیام -->
            <form action="{{ route('messages.reply', $otherUser->id) }}" method="POST" enctype="multipart/form-data" class="p-3 border-top d-flex gap-2">
                @csrf
                <input type="text" name="body" class="form-control" placeholder="پیام خود را بنویسید..." required>
                <input type="file" name="attachment" class="form-control" style="max-width: 120px;">
                <button class="btn btn-primary">ارسال</button>
            </form>
        </div>
    </div>

    <script>
        // اسکرول خودکار به آخر چت بعد از لود صفحه
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;

        // اسکرول خودکار بعد از ارسال پیام (اختیاری اگر از Ajax استفاده کنید)
    </script>
</x-app-layout>
