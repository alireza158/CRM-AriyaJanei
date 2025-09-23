<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            داشبورد
        </h2>
    </x-slot>
      {{-- Modal تسک‌های امروز --}}
<!-- Modal -->
<div class="modal fade" id="tasksModal" tabindex="-1" aria-labelledby="tasksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="tasksModalLabel">📋 تسک‌های امروز</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" dir="rtl">
          @if($tasks->count() > 0)
          <ul class="list-group">
            @foreach($tasks as $task)
            <li class="list-group-item">
              <div class="fw-bold">{{ $task->title }}</div>
              <small class="text-muted">{{ $task->description }}</small>
            </li>
            @endforeach
          </ul>
          @else
          <p class="text-center text-muted">امروز تسکی نداری 🎉</p>
          @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">باشه</button>
        </div>
      </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    @if(session('just_logged_in') && $tasks->count() > 0)
        var modalEl = document.getElementById('tasksModal');
        var tasksModal = new bootstrap.Modal(modalEl, {
            backdrop: true, // تار شدن پشت مودال
            keyboard: false
        });
        tasksModal.show();
    @endif
});
</script>

    <div class="py-12 bg-gray-50">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 text-lg text-gray-800">
                خوش آمدی {{ Auth::user()->name }}
            </div>
            {{-- اعلان‌ها --}}
            @if(auth()->user()->hasRole('Marketer'))
<div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4" dir="rtl">
    <div class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded-lg shadow">
        📌 در ۲۴ ساعت گذشته
        <span class="font-bold">{{ $newCustomersCount }}</span>
        شماره مشتری جدید ثبت شده است.
    </div>
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow">
        ✅ امروز
        <span class="font-bold">{{ $todayTasksCount }}</span>
        تسک برایت اضافه شده.
    </div>
</div>
@elseif(auth()->user()->hasRole('Admin'))
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
    <div class="bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3 rounded-lg shadow">
        📌 در ۲۴ ساعت گذشته
        <span class="font-bold">{{ $newCustomersCount }}</span>
        شماره مشتری ثبت شده است.
    </div>

    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg shadow">
        📝 در ۲۴ ساعت گذشته
        <span class="font-bold">{{ $newNotesCount }}</span>
        یادداشت ثبت شده است.
    </div>

    <div class="bg-purple-100 border border-purple-300 text-purple-800 px-4 py-3 rounded-lg shadow">
        📑 در ۲۴ ساعت گذشته
        <span class="font-bold">{{ $newReportsCount }}</span>
        گزارش کار ارسال شده است.
    </div>
</div>
@endif
            {{-- پیام مسدود بودن --}}
            @if(Auth::user()->isBlocked())
            {{-- فرم logout --}}
            <form id="logoutBlockedForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <div class="alert alert-danger text-center mb-4">
                حساب شما تا
                {{ \Hekmatinasser\Verta\Verta::instance(Auth::user()->blocked_until)->format('j F Y H:i') }}
                مسدود است و برای ادامه دسترسی باید خارج شوید.
            </div>

            {{-- جاوااسکریپت برای اتوماتیک logout --}}
            <script>
                setTimeout(function(){
                    document.getElementById('logoutBlockedForm').submit();
                }, 1000); // بعد از ۳ ثانیه فرم logout می‌شود
            </script>
        @endif





{{-- کارت تسک‌های امروز (گوشه بالا سمت راست) --}}
@if(auth()->user()->hasRole('Marketer'))
<div class="d-none d-lg-block position-fixed top-0 end-0 mt-5 me-4" style="width: 280px; z-index: 1050;">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white fw-semibold">
            📋 تسک‌های امروز
        </div>
        <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
            @foreach($tasks as $task)
            <li class="list-group-item d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="form-check flex-grow-1 m-0">
                        <input class="form-check-input task-checkbox" type="checkbox"
                               id="task-{{ $task->id }}" data-id="{{ $task->id }}"
                               {{ $task->completed ? 'checked' : '' }}>
                        <label class="form-check-label {{ $task->completed ? 'text-decoration-line-through text-muted' : '' }}"
                               for="task-{{ $task->id }}">
                            {{ $task->title }}
                        </label>
                    </div>
                </div>
                @if($task->description)
                <small class="text-muted mt-1">{{ $task->description }}</small>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- نسخه موبایل --}}
<div class="d-lg-none mb-3">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white fw-semibold">
            📋 تسک‌های امروز
        </div>
        <ul class="list-group list-group-flush" style="max-height: 400px; overflow-y: auto;">
            @foreach($tasks as $task)
            <li class="list-group-item d-flex flex-column">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="form-check flex-grow-1 m-0">
                        <input class="form-check-input task-checkbox" type="checkbox"
                               id="task-mobile-{{ $task->id }}" data-id="{{ $task->id }}"
                               {{ $task->completed ? 'checked' : '' }}>
                        <label class="form-check-label {{ $task->completed ? 'text-decoration-line-through text-muted' : '' }}"
                               for="task-mobile-{{ $task->id }}">
                            {{ $task->title }}
                        </label>
                    </div>
                </div>
                @if($task->description)
                <small class="text-muted mt-1">{{ $task->description }}</small>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endif


            @php
                $cardsAdmin = [
                    ['title'=>'کاربران بازاریاب','route'=>'admin.marketers.index','color'=>'bg-blue-200','icon'=>'users'],
                    ['title'=>'کاربران مهمان','route'=>'admin.guests.index','color'=>'bg-purple-200','icon'=>'user'],
                    ['title'=>'مدیریت محصولات و پورسانت','route'=>'admin.products.index','color'=>'bg-green-200','icon'=>'archive'],
                    ['title'=>'مشتریان و شماره‌ها','route'=>'admin.customersAdmin.index','color'=>'bg-purple-200','icon'=>'user-group'],
                    ['title'=>'مدیریت تسک کاربران','route'=>'admin.tasks.index','color'=>'bg-yellow-200','icon'=>'user-group'],
                    ['title'=>'لاگ فعالیت‌ها','route'=>'admin.activity_logs.index','color'=>'bg-blue-200','icon'=>'clipboard-list'],
                    ['title'=>'دسته‌بندی‌ها','route'=>'admin.categories.index','color'=>'bg-yellow-200','icon'=>'tag'],
                    ['title'=>'نحوه آشنایی','route'=>'admin.referenceType.index','color'=>'bg-pink-200','icon'=>'question'],
                    ['title'=>'مدیریت کاربران','route'=>'admin.users.index','color'=>'bg-red-200','icon'=>'users'],
                    ['title'=>'مدیریت مرخصی ها','route'=>'leaves','color'=>'bg-red-200','icon'=>'users'],

                ];

                $cardsMarketer = [
                    ['title'=>'مشتریان من','route'=>'marketer.customers.index','color'=>'bg-teal-200','icon'=>'users'],
                    ['title'=>'گزارش‌های من','route'=>'marketer.reports.index','color'=>'bg-indigo-200','icon'=>'document-text'],
                    ['title'=>'فروش','route'=>'marketer.sales.index','color'=>'bg-indigo-300','icon'=>'chart-bar'],
                    ['title'=>'مرخصی','route'=>'leaves','color'=>'bg-indigo-300','icon'=>'chart-bar'],
                ];

                $cardsUser = [
                    ['title'=>'گزارش‌های من','route'=>'user.reports.index','color'=>'bg-orange-200','icon'=>'document-text'],
                    ['title'=>'مرخصی','route'=>'leaves','color'=>'bg-indigo-300','icon'=>'chart-bar'],
                ];
                $cardsManager = [
                    ['title'=>'گزارش‌های من','route'=>'user.reports.index','color'=>'bg-orange-200','icon'=>'document-text'],
                    ['title'=>'مدیریت گزارش کار ها','route'=>'user.reports.reportsManagment','color'=>'bg-orange-200','icon'=>'document-text'],
                    ['title'=>'ثبت مرخصی','route'=>'leaves','color'=>'bg-indigo-300','icon'=>'chart-bar'],
                    ['title'=>'مدیریت مرخصی ها','route'=>'leaves','color'=>'bg-indigo-300','icon'=>'chart-bar'],
                ];
            @endphp

            {{-- Function to render SVG icons --}}
            @php
                function renderIcon($icon){
                    switch($icon){
                        case 'users':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M12 12a4 4 0 100-8 4 4 0 000 8z" />
                                    </svg>';
                        case 'user':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M12 12a4 4 0 100-8 4 4 0 000 8z" />
                                    </svg>';
                        case 'archive':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7M4 13h16M5 20h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z" />
                                    </svg>';
                        case 'user-group':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M12 12a4 4 0 100-8 4 4 0 000 8zM7 8a4 4 0 110-8 4 4 0 010 8z" />
                                    </svg>';
                        case 'clipboard-list':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v14h14V7a2 2 0 00-2-2h-2M9 5V3h6v2M9 12h6M9 16h6" />
                                    </svg>';
                        case 'tag':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7a2 2 0 114 0 2 2 0 01-4 0zM5 7h.01M7 7v10m0 0l-3 3m3-3h10" />
                                    </svg>';
                        case 'question':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M12 14v.01M12 14v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>';
                        case 'document-text':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l5 5v9a2 2 0 01-2 2z" />
                                    </svg>';
                        case 'chart-bar':
                            return '<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M9 17V9m4 8V5m4 12v-6" />
                                    </svg>';
                        default:
                            return '';
                    }
                }
            @endphp

            {{-- Render Cards --}}
            @foreach(['Admin'=>$cardsAdmin,'Marketer'=>$cardsMarketer,'User'=>$cardsUser, 'Manager'=>$cardsManager] as $role=>$cards)
                @hasrole($role)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8" dir="rtl">
                    @foreach($cards as $card)
                        <a href="{{ route($card['route']) }}" class="flex items-center justify-between p-6 rounded-2xl shadow-md hover:shadow-lg transition duration-300 {{ $card['color'] }}">
                            <div class="text-right">
                                <h3 class="text-lg font-semibold text-gray-800">{{ $card['title'] }}</h3>
                            </div>
                            <div class="text-4xl text-gray-700">
                                {!! renderIcon($card['icon']) !!}
                            </div>
                        </a>
                    @endforeach
                </div>
                @endhasrole
            @endforeach

        </div>
    </div>

    <script>

document.querySelectorAll('.task-checkbox').forEach(el => {
    el.addEventListener('change', function(){
        let taskId = this.dataset.id;
        fetch('/tasks/' + taskId + '/complete', {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                let label = this.nextElementSibling;
                // وضعیت واقعی تسک
                if(data.completed){
                    label.classList.add('text-decoration-line-through','text-muted');
                    this.checked = true; // اطمینان از هماهنگی چک‌باکس
                } else {
                    label.classList.remove('text-decoration-line-through','text-muted');
                    this.checked = false;
                }
            }
        });
    });
});


        </script>

</x-app-layout>
