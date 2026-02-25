<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between gap-2" dir="rtl">
            <div>
                <h2 class="fw-bold fs-3 text-dark mb-1">داشبورد</h2>
                <div class="text-muted small">
                    خوش آمدی <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                </div>
            </div>
            <div class="text-muted small">
                {{ \Hekmatinasser\Verta\Verta::now()->format('l، j F Y') }}
            </div>
        </div>
    </x-slot>

    @php
        // -----------------------------
        // کارت‌ها بر اساس نقش
        // -----------------------------
        $cardsAdmin = [
            ['title'=>'کاربران بازاریاب','route'=>'admin.marketers.index','tone'=>'primary','icon'=>'users'],
            ['title'=>'کاربران مهمان','route'=>'admin.guests.index','tone'=>'purple','icon'=>'user'],
            ['title'=>'مدیریت محصولات و پورسانت','route'=>'admin.products.index','tone'=>'success','icon'=>'archive'],
            ['title'=>'مشتریان و شماره‌ها','route'=>'admin.customersAdmin.index','tone'=>'pink','icon'=>'user-group'],
            ['title'=>'لاگ فعالیت‌ها','route'=>'admin.activity_logs.index','tone'=>'info','icon'=>'clipboard'],
            ['title'=>'دسته‌بندی‌ها','route'=>'admin.categories.index','tone'=>'warning','icon'=>'tag'],
            ['title'=>'نحوه آشنایی','route'=>'admin.referenceType.index','tone'=>'danger','icon'=>'question'],
            ['title'=>'مدیریت کاربران','route'=>'admin.users.index','tone'=>'danger','icon'=>'users'],
            ['title'=>'مدیریت فرم‌های ارزیابی','route'=>'admin.evaluations.forms.index','tone'=>'indigo','icon'=>'doc'],
            ['title'=>'نتایج ارزیابی','route'=>'admin.evaluations.monthly','tone'=>'indigo','icon'=>'doc'],
            ['title'=>'محصولات سایت','route'=>'products.index','tone'=>'primary','icon'=>'box'],
            ['title'=>'گزارش‌های مدیریتی','route'=>'admin.reports','tone'=>'orange','icon'=>'chart'],
            ['title'=>'فرم رضایت مشتری','route'=>'customer-satisfaction-forms.index','tone'=>'success','icon'=>'doc'],
        ];

        $cardsMarketer = [
            ['title'=>'مشتریان من','route'=>'marketer.customers.index','tone'=>'teal','icon'=>'users'],
            ['title'=>'فروش (درحال توسعه)','route'=>'dashboard','tone'=>'indigo','icon'=>'chart'],
            ['title'=>'مشتریان و شماره‌ها','route'=>'customersAdmin2.index','tone'=>'pink','icon'=>'user-group'],
        ];

        $cardsSales = [
            ['title'=>'اطلاعات ثبت شده در فرم','route'=>'admin.contacts','tone'=>'teal','icon'=>'users'],
        ];

        $jDay = \Hekmatinasser\Verta\Verta::now()->day;
        $showEvalCard = ($jDay >= 28 || $jDay <= 3);

        $cardsUser = [
            ['title'=>'گزارش‌های من','route'=>'user.reports.index','tone'=>'orange','icon'=>'doc'],
            ['title'=>'ثبت مرخصی','route'=>'leaves','tone'=>'indigo','icon'=>'calendar'],
            ['title'=>'یادآورها','route'=>'reminders.index','tone'=>'indigo','icon'=>'bell'],
            ['title'=>'مدیریت پیام‌ها','route'=>'messages.index','tone'=>'indigo','icon'=>'chat'],
            ['title'=>'مدیریت درخواست‌ها','route'=>'requests.index','tone'=>'indigo','icon'=>'bolt'],
            ['title'=>'ثبت سفارش','route'=>'marketer.orders.create','tone'=>'orange','icon'=>'doc'],
        ];
        if ($showEvalCard) $cardsUser[] = ['title'=>'فرم‌های ارزیابی','route'=>'evaluations.index','tone'=>'indigo','icon'=>'doc'];

        $cardsManager = [
            ['title'=>'مدیریت گزارش کارها','route'=>'user.reports.reportsManagment','tone'=>'orange','icon'=>'doc'],
            ['title'=>'مدیریت مرخصی‌ها','route'=>'leaves','tone'=>'indigo','icon'=>'calendar'],
            ['title'=>'مدیریت تسک‌ها','route'=>'admin.tasks.index','tone'=>'warning','icon'=>'checklist'],
        ];

        $cardsCustomerReview = [
            ['title'=>'فرم رضایت مشتری','route'=>'customer-satisfaction-forms.index','tone'=>'success','icon'=>'doc'],
        ];

        $cardsInternalManager = [
            ['title'=>'فرم رضایت مشتری','route'=>'customer-satisfaction-forms.index','tone'=>'success','icon'=>'doc'],
        ];

        $roleCards = [
            'Admin'           => $cardsAdmin,
            'Manager'         => $cardsManager,
            'Marketer'        => $cardsMarketer,
            'Sales'           => $cardsSales,
            'User'            => $cardsUser,
            'customer_review' => $cardsCustomerReview,
            'internalManager' => $cardsInternalManager,
            'InternalManager' => $cardsInternalManager,
        ];

        // کارت‌های قابل نمایش (تجمیع نقش‌ها + حذف تکراری با route)
        $cardsToShow = [];
        foreach ($roleCards as $role => $cards) {
            if (auth()->user()->hasRole($role)) {
                foreach ($cards as $c) $cardsToShow[$c['route']] = $c;
            }
        }
        $cardsToShow = array_values($cardsToShow);

        // -----------------------------
        // آمار بالا
        // -----------------------------
        $statCards = [];
        if (auth()->user()->hasRole('Marketer')) {
            $statCards[] = ['tone'=>'primary','title'=>'مشتری جدید (۲۴ ساعت)','value'=>$newCustomersCount,'desc'=>'ثبت شده در ۲۴ ساعت گذشته','emoji'=>'📌'];
        }
        if (auth()->user()->hasRole('User') && !auth()->user()->hasAnyRole(['Admin','Manager'])) {
            $statCards[] = ['tone'=>'success','title'=>'تسک‌های امروز','value'=>$todayTasksCount,'desc'=>'تسک جدید برایت اضافه شده','emoji'=>'✅'];
        }
        if (auth()->user()->hasAnyRole(['Admin','Manager'])) {
            $statCards[] = ['tone'=>'primary','title'=>'مشتری‌ها (۲۴ ساعت)','value'=>$newCustomersCount,'desc'=>'تعداد مشتری ثبت شده','emoji'=>'📌'];
            $statCards[] = ['tone'=>'success','title'=>'یادداشت‌ها (۲۴ ساعت)','value'=>$newNotesCount,'desc'=>'تعداد یادداشت ثبت شده','emoji'=>'📝'];
            $statCards[] = ['tone'=>'purple','title'=>'گزارش‌ها (۲۴ ساعت)','value'=>$newReportsCount,'desc'=>'تعداد گزارش ارسال شده','emoji'=>'📑'];
        }

        // -----------------------------
        // تسک‌ها
        // -----------------------------
        $showTasksWidget = auth()->user()->hasAnyRole(['Marketer','User','Manager']);
        $taskTotal = $tasks->count();
        $taskDone  = $tasks->where('completed', true)->count();
        $taskPct   = $taskTotal > 0 ? (int) round(($taskDone / $taskTotal) * 100) : 0;

        // مودال تسک بعد از لاگین
        $showTasksModalOnLogin = (session('just_logged_in') && $taskTotal > 0);

        // آیکن‌ها (SVG ساده و تمیز)
        if (!function_exists('dash_icon2')) {
            function dash_icon2($name){
                $icons = [
                    'users' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M12 12a4 4 0 100-8 4 4 0 000 8z"/></svg>',
                    'user' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M12 12a4 4 0 100-8 4 4 0 000 8z"/></svg>',
                    'archive' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7M4 13h16M5 20h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z"/></svg>',
                    'user-group' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20h6M12 12a4 4 0 100-8 4 4 0 000 8zM7 8a4 4 0 110-8 4 4 0 010 8z"/></svg>',
                    'clipboard' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v14h14V7a2 2 0 00-2-2h-2M9 5V3h6v2M9 12h6M9 16h6"/></svg>',
                    'tag' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M7 7a2 2 0 114 0 2 2 0 01-4 0zM5 7h.01M7 7v10m0 0l-3 3m3-3h10"/></svg>',
                    'question' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zM8 10h.01M12 10h.01M16 10h.01M12 14v.01"/></svg>',
                    'doc' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l5 5v9a2 2 0 01-2 2z"/></svg>',
                    'chart' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M3 3v18h18M9 17V9m4 8V5m4 12v-6"/></svg>',
                    'calendar' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M5 11h14M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>',
                    'bell' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0118 14V11a6 6 0 10-12 0v3a2 2 0 01-.6 1.4L4 17h5m6 0a3 3 0 11-6 0"/></svg>',
                    'chat' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0zM8 10h8M8 14h5"/></svg>',
                    'bolt' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>',
                    'box' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M20 12l-8 5-8-5m16 0l-8-5-8 5m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6"/></svg>',
                    'checklist' => '<svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M9 5h12M9 12h12M9 19h12M5 5h.01M5 12h.01M5 19h.01"/></svg>',
                ];
                return $icons[$name] ?? '';
            }
        }
    @endphp

    {{-- حتماً Bootstrap CSS تو پروژه لود شده باشه. (Jetstream فقط Tailwindه) --}}
    <style>
        :root { --radius: 16px; }
        .dash-wrap { background: linear-gradient(180deg, #f6f7fb 0%, #ffffff 50%, #ffffff 100%); }
        .card-soft { border: 1px solid rgba(15,23,42,.08); border-radius: var(--radius); }
        .card-soft:hover { transform: translateY(-2px); box-shadow: 0 12px 30px rgba(15,23,42,.08); }
        .card-soft { transition: .2s ease; }
        .icon { width: 22px; height: 22px; }
        .icon-wrap { width: 44px; height: 44px; border-radius: 14px; display:flex; align-items:center; justify-content:center; }
        .soft-scroll::-webkit-scrollbar{ width: 8px; }
        .soft-scroll::-webkit-scrollbar-thumb{ background: rgba(0,0,0,.15); border-radius: 999px; }
        .soft-scroll::-webkit-scrollbar-track{ background: transparent; }
        .badge-purple{ background:#ede9fe; color:#5b21b6; }
        .badge-pink{ background:#fce7f3; color:#9d174d; }
        .badge-indigo{ background:#e0e7ff; color:#3730a3; }
        .badge-teal{ background:#ccfbf1; color:#115e59; }
        .badge-orange{ background:#ffedd5; color:#9a3412; }
    </style>

    <div class="py-4 dash-wrap" dir="rtl">
        <div class="container-fluid px-3 px-sm-4">

            {{-- پیام مسدود بودن --}}
            @if(Auth::user()->isBlocked())
                <form id="logoutBlockedForm" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
                <div class="alert alert-danger card-soft mb-4">
                    <div class="fw-bold mb-1">⛔ حساب شما مسدود است</div>
                    <div class="small">
                        تا
                        <span class="fw-semibold">
                            {{ \Hekmatinasser\Verta\Verta::instance(Auth::user()->blocked_until)->format('j F Y H:i') }}
                        </span>
                        مسدود است و برای ادامه باید خارج شوید.
                    </div>
                </div>
                <script>
                    setTimeout(() => document.getElementById('logoutBlockedForm')?.submit(), 1000);
                </script>
            @endif

            {{-- آمار بالا --}}
            @if(count($statCards) > 0)
                <div class="row g-3 mb-4">
                    @foreach($statCards as $s)
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="bg-white card-soft p-4 h-100">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <div class="text-muted small mb-1">{{ $s['emoji'] }} {{ $s['title'] }}</div>
                                        <div class="fw-bold fs-3 text-dark">{{ $s['value'] }}</div>
                                    </div>
                                    <span class="badge bg-{{ $s['tone'] }}-subtle text-{{ $s['tone'] }} border border-{{ $s['tone'] }}-subtle">
                                        ۲۴ ساعت
                                    </span>
                                </div>
                                <div class="text-muted small mt-2">{{ $s['desc'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="row g-3">
                {{-- دسترسی سریع --}}
                <div class="col-12 col-lg-8">
                    <div class="bg-white card-soft">
                        <div class="p-4 border-bottom">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="fw-bold text-dark">دسترسی سریع</div>
                                    <div class="text-muted small mt-1">روی کارت‌ها بزن تا وارد هر بخش بشی.</div>
                                </div>
                                <span class="text-muted small">{{ count($cardsToShow) }} بخش</span>
                            </div>
                        </div>

                        <div class="p-4">
                            <div class="row g-3">
                                @foreach($cardsToShow as $card)
                                    @php
                                        $badgeClass = match($card['tone']) {
                                            'purple' => 'badge-purple',
                                            'pink'   => 'badge-pink',
                                            'indigo' => 'badge-indigo',
                                            'teal'   => 'badge-teal',
                                            'orange' => 'badge-orange',
                                            default  => 'bg-'.$card['tone'].'-subtle text-'.$card['tone']
                                        };
                                        $iconBg = 'bg-'.$card['tone'].'-subtle';
                                        $iconTx = 'text-'.$card['tone'];
                                    @endphp

                                    <div class="col-12 col-md-6 col-xl-4">
                                        <a href="{{ route($card['route']) }}" class="text-decoration-none">
                                            <div class="card-soft bg-white p-4 h-100">
                                                <div class="d-flex align-items-start justify-content-between gap-3">
                                                    <div class="flex-grow-1">
                                                        <span class="badge {{ $badgeClass }}">ورود</span>
                                                        <div class="fw-bold text-dark mt-2">{{ $card['title'] }}</div>
                                                        <div class="text-muted small mt-1">مشاهده و مدیریت</div>
                                                    </div>

                                                    <div class="icon-wrap {{ $iconBg }} {{ $iconTx }} border border-{{ $card['tone'] }}-subtle">
                                                        {!! dash_icon2($card['icon']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- تسک‌ها --}}
                <div class="col-12 col-lg-4">
                    @if($showTasksWidget)
                        <div class="bg-white card-soft overflow-hidden">
                            <div class="p-4 border-bottom">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="text-muted small">📋 تسک‌های امروز</div>
                                        <div class="fw-bold text-dark mt-1">
                                            {{ $taskDone }} / {{ $taskTotal }}
                                            <span class="text-muted small">({{ $taskPct }}%)</span>
                                        </div>
                                    </div>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
                                        {{ $taskPct }}%
                                    </span>
                                </div>

                                <div class="progress mt-3" style="height:8px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $taskPct }}%"></div>
                                </div>
                            </div>

                            @if($taskTotal > 0)
                                <div class="soft-scroll" style="max-height: 520px; overflow-y:auto;">
                                    <ul class="list-group list-group-flush">
                                        @foreach($tasks as $task)
                                            <li class="list-group-item py-3">
                                                <div class="d-flex align-items-start gap-2">
                                                    <input class="form-check-input mt-1 task-checkbox"
                                                           type="checkbox"
                                                           id="task-{{ $task->id }}"
                                                           data-id="{{ $task->id }}"
                                                           {{ $task->completed ? 'checked' : '' }}>

                                                    <div class="flex-grow-1">
                                                        <label for="task-{{ $task->id }}"
                                                               class="fw-semibold d-block {{ $task->completed ? 'text-decoration-line-through text-muted' : 'text-dark' }}">
                                                            {{ $task->title }}
                                                        </label>

                                                        @if($task->description)
                                                            <div class="text-muted small mt-1">{{ $task->description }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="p-5 text-center">
                                    <div class="fs-2">🎉</div>
                                    <div class="fw-bold text-dark mt-2">امروز تسکی نداری</div>
                                    <div class="text-muted small mt-1">وقتشه روی کارهای مهم‌تر تمرکز کنی.</div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- ------------------ مودال‌ها (Bootstrap) ------------------ --}}

            {{-- Modal تسک‌های امروز (بعد از لاگین) --}}
            <div class="modal fade" id="tasksModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content card-soft">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">📋 تسک‌های امروز</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" dir="rtl">
                            @if($taskTotal > 0)
                                <ul class="list-group">
                                    @foreach($tasks as $task)
                                        <li class="list-group-item">
                                            <div class="fw-bold">{{ $task->title }}</div>
                                            @if($task->description)
                                                <small class="text-muted">{{ $task->description }}</small>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-center text-muted mb-0">امروز تسکی نداری 🎉</p>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">باشه</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Force password reset --}}
            @if(auth()->user()->force_password_reset)
                <div class="modal fade" id="passwordResetModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content card-soft">
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title fw-bold">تغییر پسورد الزامی</h5>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <p class="text-muted">برای ادامه کار باید پسورد خود را تغییر دهید.</p>

                                <form action="{{ route('password.change') }}" method="POST" id="forcePasswordForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">پسورد جدید</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">تکرار پسورد</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">تغییر پسورد</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Modal یادآورها --}}
            @if($todayReminders->count() > 0)
                <div class="modal fade" id="reminderModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content card-soft">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">یادآورهای امروز</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" dir="rtl">
                                <ul class="list-group">
                                    @foreach($todayReminders as $reminder)
                                        <li class="list-group-item d-flex justify-content-between align-items-start gap-2">
                                            <div>
                                                <strong>{{ $reminder->title }}</strong><br>
                                                @if($reminder->description)
                                                    <small class="text-muted">{{ $reminder->description }}</small><br>
                                                @endif
                                                <small class="text-muted">
                                                    {{ \Hekmatinasser\Verta\Verta::instance($reminder->remind_at)->format('Y/m/d H:i') }}
                                                </small>
                                            </div>

                                            <form action="{{ route('reminders.markAsSeen', $reminder->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success btn-sm">خواندم</button>
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://lib.arvancloud.ir/bootstrap/5.3.0-alpha1/js/bootstrap.bundle.min.js"></script>
    <script src="https://lib.arvancloud.ir/limonte-sweetalert2/9.9.0/sweetalert2.all.js"></script>

    <script>
        
        document.addEventListener("DOMContentLoaded", function () {
            // مودال تسک‌ها بعد از لاگین
            @if($showTasksModalOnLogin)
                new bootstrap.Modal(document.getElementById('tasksModal'), { backdrop:true, keyboard:false }).show();
            @endif

            // مودال تغییر پسورد
            @if(auth()->user()->force_password_reset)
                new bootstrap.Modal(document.getElementById('passwordResetModal'), { backdrop:'static', keyboard:false }).show();
            @endif

            // مودال یادآورها
            @if($todayReminders->count() > 0)
                new bootstrap.Modal(document.getElementById('reminderModal')).show();
            @endif

            // تیک تسک‌ها
            const csrf = '{{ csrf_token() }}';
            document.querySelectorAll('.task-checkbox').forEach(el => {
                el.addEventListener('change', async function(){
                    const checkbox = this;
                    const taskId = checkbox.dataset.id;
                    const label = document.querySelector(`label[for="${checkbox.id}"]`);
                    const prev = !checkbox.checked;

                    try {
                        const res = await fetch(`/tasks/${taskId}/complete`, {
                            method: 'PATCH',
                            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
                        });
                        const data = await res.json();
                        if(!data?.success) throw new Error('failed');

                        if(data.completed){
                            label?.classList.add('text-decoration-line-through','text-muted');
                            checkbox.checked = true;
                        } else {
                            label?.classList.remove('text-decoration-line-through','text-muted');
                            checkbox.checked = false;
                        }
                    } catch (e) {
                        checkbox.checked = prev;
                        Swal.fire({ title:'خطا', text:'مشکلی در ذخیره وضعیت تسک پیش آمد.', icon:'error', confirmButtonText:'باشه' });
                    }
                });
            });

            // ارجاع جدید فرم رضایت مشتری
            @if(($newAssignedCustomerSatisfactionFormsCount ?? 0) > 0)
                Swal.fire({
                    title: 'ارجاع جدید فرم رضایت مشتری',
                    text: '{{ $newAssignedCustomerSatisfactionFormsCount }} تا مشتری ارجاع شده در فرم رضایت مشتری',
                    icon: 'info',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: true,
                    confirmButtonText: 'خواندم'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ route('customer-satisfaction-forms.mark-assigned-seen') }}", {
                            method: 'POST',
                            headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }
                        });
                    }
                });
            @endif

            // اعلان‌ها (گروه بندی)
            @if($notifications->count() > 0)
                (function () {
                    let notifications = @json($notifications);
                    let grouped = {};
                    notifications.forEach(n => {
                        if (grouped[n.title]) {
                            grouped[n.title].count++;
                            grouped[n.title].latestCreatedAt = n.created_at_human;
                        } else {
                            grouped[n.title] = { count: 1, latestCreatedAt: n.created_at_human };
                        }
                    });

                    let items = Object.keys(grouped).map(title => ({
                        title,
                        count: grouped[title].count,
                        latestCreatedAt: grouped[title].latestCreatedAt
                    }));

                    let i = 0;
                    function showNext() {
                        if (i >= items.length) {
                            fetch("{{ route('notifications.markAllSeen') }}", {
                                method: "POST",
                                headers: { "X-CSRF-TOKEN": csrf }
                            });
                            return;
                        }

                        const note = items[i];
                        const msg = note.count > 1 ? `تعداد: ${note.count}` : "";

                        Swal.fire({
                            title: note.title,
                            text: msg,
                            icon: "info",
                            timer: 5000,
                            timerProgressBar: true,
                            showConfirmButton: true,
                            confirmButtonText: "باشه",
                            footer: note.latestCreatedAt
                        }).then(() => { i++; showNext(); });
                    }
                    showNext();
                })();
            @endif
        });
    </script>
</x-app-layout>
