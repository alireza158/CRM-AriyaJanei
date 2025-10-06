<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-center text-gray-800">نمایش گزارش</h2>
        
    </x-slot>

    <div class="flex flex-col items-center justify-center px-4 py-8 space-y-12" dir="rtl">

        <div class="w-full max-w-3xl bg-white shadow-lg rounded-2xl p-6 space-y-6 border-t-4 border-green-500">
            <h3 class="text-xl font-bold text-gray-700 border-b pb-2">جزئیات گزارش</h3>
            <p class="text-center text-gray-600 mt-1">
    
    <span class="font-semibold">
        {{ $report->author_name
            ?? optional($report->user)->name
            ?? optional($user)->name
            ?? 'نامشخص' }}
    </span>
</p>

            <div class="space-y-3">
                <div>
                    <h4 class="text-gray-600 font-semibold">عنوان:</h4>
                    <p class="text-gray-800">{{ $report->title }}</p>
                </div>
                <div>
                    <h4 class="text-gray-600 font-semibold">توضیحات:</h4>
                    <p class="text-gray-800 whitespace-pre-line">{{ $report->description }}</p>
                </div>
                <div>
                    <h4 class="text-gray-600 font-semibold">ارسال‌شده در:</h4>
                    <p class="text-gray-800">{{ \Morilog\Jalali\Jalalian::fromDateTime($report->submitted_at)->format('Y-m-d H:i') }}</p>
                </div>
                <div>
                    <h4 class="text-gray-600 font-semibold">وضعیت:</h4>
                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 rounded-full">
                        @if($report->status =="submitted")
                        <span class="badge bg-warning text-dark">خوانده نشده</span>
                        @elseif($report->status =="read")
                        <span class="badge bg-success">خوانده شده</span>
                        @endif
                    </span>
                </div>

                {{-- بخش نمایش فایل‌ها --}}
                @if($report->attachments->count())
                <div class="mb-3">
                    <h5 style="text-align: right; padding-bottom: 20px;" class="fw-bold ">فایل‌ها و تصاویر:</h5>
                    <ul class="list-unstyled text-end">
                        @foreach($report->attachments as $attachment)
                            <li class="mb-2">
                                @if(Str::startsWith($attachment->type, 'image'))
                                    <img src="{{ Storage::url($attachment->file_path) }}"
                                         alt="تصویر گزارش"
                                         class="img-fluid mb-1 clickable-image"
                                         style="max-height: 200px; cursor: pointer;"
                                         data-bs-toggle="modal"
                                         data-bs-target="#imageModal"
                                         data-src="{{ Storage::url($attachment->file_path) }}">
                                @endif

                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            </div>
             @php
    $user = Auth::user();
@endphp
@if($user->hasRole('Admin') || $user->hasRole('internalManager') ||$user->hasRole('Manager'))
        {{-- فرم ارسال بازخورد --}}

        <form action="{{ route('user.reports.feedback', [$report]) }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="text-right">
                <label for="feedback" class="block text-gray-700 font-medium mb-1">بازخورد:</label>
                <textarea name="feedback" id="feedback" rows="4"
                    class="w-full border rounded-lg p-3 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-300 text-right"
                    dir="rtl">{{ $report->feedback ?? '' }}</textarea>
            </div>

            <!-- ضبط ویس موبایلی -->
            <div class="text-right">
                <label class="block text-gray-700 font-medium mb-1">ارسال ویس (فقط موبایل):</label>

                <div class="flex items-center gap-2">
                    <button type="button" id="recordBtn"
                        class="w-12 h-12 bg-red-600 text-white rounded-full flex items-center justify-center text-2xl font-bold">
                        🎤
                    </button>
                    <span id="recordTimer" class="text-gray-700">00:00</span>
                </div>

                <div id="previewContainer" class="mt-2 hidden">
                    <audio id="audioPreview" controls class="w-full"></audio>
                    <div class="flex gap-2 mt-2">
                        <button type="button" id="sendVoice"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg">ارسال</button>
                        <button type="button" id="deleteVoice"
                            class="px-4 py-2 bg-gray-400 text-white rounded-lg">حذف</button>
                    </div>
                </div>

                <input type="hidden" name="voice" id="voiceInput">

                @if($report->voice_path ?? false)
                    <p class="mt-2 text-sm text-gray-600">ویس قبلی:</p>
                    <audio controls class="w-full">
                        <source src="{{ asset('storage/' . $report->voice_path) }}" type="audio/webm">
                    </audio>
                @endif
            </div>

            <div class="text-center gap-4">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700">
                    ذخیره بازخورد
                </button>
            </div>
        </form>

        <script>
        let mediaRecorder;
        let audioChunks = [];
        let recordStartTime;
        let timerInterval;

        const recordBtn = document.getElementById('recordBtn');
        const recordTimer = document.getElementById('recordTimer');
        const previewContainer = document.getElementById('previewContainer');
        const audioPreview = document.getElementById('audioPreview');
        const voiceInput = document.getElementById('voiceInput');
        const sendVoice = document.getElementById('sendVoice');
        const deleteVoice = document.getElementById('deleteVoice');

        function formatTime(seconds) {
            const m = Math.floor(seconds / 60).toString().padStart(2, '0');
            const s = (seconds % 60).toString().padStart(2, '0');
            return `${m}:${s}`;
        }

        // شروع ضبط با نگه داشتن دکمه (touchstart)
        recordBtn.addEventListener('touchstart', async (e) => {
            e.preventDefault();

            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia || !window.MediaRecorder) {
                alert('ضبط صوت در این دستگاه پشتیبانی نمی‌شود.');
                return;
            }

            const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
            mediaRecorder = new MediaRecorder(stream, { mimeType: 'audio/webm; codecs=opus' });

            audioChunks = [];
            mediaRecorder.start();
            recordStartTime = Date.now();

            timerInterval = setInterval(() => {
                const elapsed = Math.floor((Date.now() - recordStartTime) / 1000);
                recordTimer.textContent = formatTime(elapsed);
            }, 500);

            mediaRecorder.ondataavailable = e => audioChunks.push(e.data);

            mediaRecorder.onstop = () => {
                clearInterval(timerInterval);
                recordTimer.textContent = '00:00';

                const blob = new Blob(audioChunks, { type: 'audio/webm; codecs=opus' });
                const audioURL = URL.createObjectURL(blob);
                audioPreview.src = audioURL;
                previewContainer.classList.remove('hidden');

                const reader = new FileReader();
                reader.onloadend = () => voiceInput.value = reader.result;
                reader.readAsDataURL(blob);
            };
        });

        // توقف ضبط با رها کردن دکمه (touchend)
        recordBtn.addEventListener('touchend', () => {
            if (mediaRecorder && mediaRecorder.state !== 'inactive') {
                mediaRecorder.stop();
            }
        });

        // دکمه ارسال و حذف
        sendVoice.addEventListener('click', () => {
            previewContainer.classList.add('hidden');
            alert('ویس آماده ارسال است، حالا فرم را ذخیره کنید.');
        });

        deleteVoice.addEventListener('click', () => {
            previewContainer.classList.add('hidden');
            audioPreview.src = '';
            voiceInput.value = '';
        });
        </script>


    @else
        {{-- فقط نمایش بازخورد --}}
        @if($report->feedback)
            <div class="text-right p-3 border rounded-lg bg-gray-100">
                {{ $report->feedback }}
            </div>
        @else
            <div class="text-right text-gray-500">
                بازخوردی ثبت نشده است.
            </div>
        @endif
    @endif
        <div class="flex justify-start space-x-reverse space-x-2">
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300">بازگشت</a>
        </div>
    </div>
        </div>

        <!-- Modal برای نمایش تصویر -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img src="" id="modalImage" class="img-fluid w-100" alt="تصویر گزارش">
            </div>
        </div>
    </div>
</div>
</x-layouts.app>
<script>
    document.querySelectorAll('.clickable-image').forEach(img => {
        img.addEventListener('click', function() {
            document.getElementById('modalImage').src = this.dataset.src;
        });
    });
</script>
