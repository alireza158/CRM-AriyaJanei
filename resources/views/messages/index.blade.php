<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold">💬 پیام‌ها</h2>
    </x-slot>

    <div class="container py-4">

        <!-- دکمه ارسال پیام جدید -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newMessage">
                ➕ ارسال پیام جدید
            </button>
        </div>

        <!-- لیست پیام‌ها -->
        @if($messages->count())
            <div class="list-group shadow-sm rounded">
                @foreach($messages as $msg)
                    <a href="{{ route('messages.show', $msg->id) }}" 
                       class="list-group-item list-group-item-action d-flex flex-column {{ $msg->seen ? '' : 'bg-light' }}">
                        
                        <div class="d-flex justify-content-between">
                            <strong class="text-primary">
                                {{ $msg->sender->name }} → {{ $msg->receiver->name }}
                            </strong>
                            <small class="text-muted">
                                {{ $msg->created_at->format('Y/m/d H:i') }}
                            </small>
                        </div>

                        <p class="mb-0 text-truncate">
                            {{ $msg->body }}
                        </p>

                        @if($msg->attachment)
                            <small class="text-success">📎 فایل پیوست دارد</small>
                        @endif
                    </a>
                @endforeach
            </div>
        @else
            <div class="alert alert-info text-center">هیچ پیامی وجود ندارد.</div>
        @endif

    </div>

    <!-- Modal پیام جدید -->
    <div class="modal fade" id="newMessage" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">

                <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">✉️ پیام جدید</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
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

                        <div class="mb-3">
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
</x-app-layout>
