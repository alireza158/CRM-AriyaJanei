{{-- resources/views/evaluations/results.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">
            نتایج ارزیابی {{ $target->name }}
        </h2>
    </x-slot>

    @php
        use Hekmatinasser\Verta\Verta;

        // ورودی‌های فیلتر (سال/ماه شمسی)
        $jm = (int) request('jm'); // ماه جلالی 1..12
        $jy = (int) request('jy'); // سال جلالی

        // نام ماه‌های شمسی
        $jalaliMonths = [
            1=>'فروردین',2=>'اردیبهشت',3=>'خرداد',4=>'تیر',5=>'مرداد',6=>'شهریور',
            7=>'مهر',8=>'آبان',9=>'آذر',10=>'دی',11=>'بهمن',12=>'اسفند'
        ];

        // سال‌های دراپ‌داون (بازه‌ی معقول)
        $currentJYear = Verta::now()->year;
        $years = range($currentJYear, $currentJYear-5); // 6 سال اخیر

        // فیلتر مجموعه بر اساس ماه/سال شمسی (اگر داده شده)
        $filtered = isset($answers) ? $answers->filter(function($a) use($jm,$jy){
            $v = Verta::instance($a->created_at);
            return (!$jm || $v->month == $jm) && (!$jy || $v->year == $jy);
        }) : collect();

        // گروهبندی: اگر ستون form_id وجود دارد بر اساس آن؛
        // وگرنه بر اساس "زمان ثبت دقیقه‌ای + ارزیاب" تا پاسخ‌های یک فرم کنار هم باشند.
        $grouped = $filtered->groupBy(function($a){
            if (isset($a->form_id)) {
                return 'form-'.$a->form_id;
            }
            // کلید جایگزین
            $minute = \Illuminate\Support\Carbon::parse($a->created_at)->format('Y-m-d H:i');
            return $minute.'|by-'.$a->user_id;
        });

        // برای نمایش، گروه‌ها را بر اساس تاریخ نزولی مرتب می‌کنیم
        $grouped = $grouped->sortByDesc(function($group){
            return optional($group->first())->created_at;
        });
    @endphp

    <div class="py-6 max-w-7xl mx-auto px-3 px-sm-6 lg:px-8" dir="rtl">
        {{-- نوار فیلتر ماهانه (شمسی) --}}
        <div class="card shadow-sm mb-3">
            <div class="card-body py-2">
                <form method="GET" class="row g-2 align-items-end">
                    <div class="col-6 col-sm-3">
                        <label class="form-label mb-1">ماه</label>
                        <select name="jm" class="form-select">
                            <option value="">همه ماه‌ها</option>
                            @foreach($jalaliMonths as $mVal => $mName)
                                <option value="{{ $mVal }}" {{ $jm===$mVal ? 'selected' : '' }}>{{ $mName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 col-sm-3">
                        <label class="form-label mb-1">سال</label>
                        <select name="jy" class="form-select">
                            <option value="">همه سال‌ها</option>
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ $jy===$y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 d-flex gap-2">
                        <button class="btn btn-primary mt-3 mt-sm-auto">اعمال فیلتر</button>
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary mt-3 mt-sm-auto">حذف فیلتر</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-3 p-3 p-sm-4">
            @if($grouped->isEmpty())
                <div class="text-center text-muted py-4">
                    هیچ پاسخی با این فیلتر پیدا نشد.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th style="min-width:220px">سؤال</th>
                                <th style="width:120px">امتیاز</th>
                                <th>نظر</th>
                                <th style="width:170px">تاریخ</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($grouped as $key => $rows)
                            @php
                                $first = $rows->first();
                                $v = Verta::instance($first->created_at);
                                $dateLabel = $v->format('Y/m/d H:i'); // تاریخ شمسی سرگروه
                                $avg = number_format($rows->avg('score'), 2);
                                $count = $rows->count();
                                $formTitle = isset($first->form) ? ($first->form->title ?? 'فرم ارزیابی') : 'فرم ارزیابی';
                            @endphp

                            {{-- ردیف سرگروهِ فرم: تاریخ و خلاصه --}}
                            <tr class="table-active">
                                <td colspan="4">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-secondary-subtle text-secondary-emphasis border">{{ $formTitle }}</span>
                                            <span class="badge bg-info-subtle text-info-emphasis border">سؤالات: {{ $count }}</span>
                                            <span class="badge bg-primary-subtle text-primary-emphasis border">میانگین: {{ $avg }}</span>
                                        </div>
                                        <div class="text-muted">
                                            <i class="bi bi-calendar-event"></i>
                                            {{ $dateLabel }}
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- ردیف‌های سوالات این فرم --}}
                            @foreach($rows as $answer)
                                <tr>
                                    <td class="text-start">
                                        {{ optional($answer->question)->title ?? '—' }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge {{ $answer->score >= 4 ? 'bg-success' : ($answer->score >= 3 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                            {{ $answer->score }}
                                        </span>
                                    </td>
                                    <td class="text-start">
                                        {{ $answer->comment ?: '—' }}
                                    </td>
                                    <td class="text-center text-muted">
                                        {{-- تاریخ هر سطر را تکرار نمی‌کنیم؛ برای دسترسی‌پذیریِ بیشتر، به‌صورت کم‌رنگ می‌گذاریم --}}
                                        {{ Verta::instance($answer->created_at)->format('Y/m/d') }}
                                    </td>
                                </tr>
                            @endforeach

                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    {{-- Bootstrap Icons (درصورت نیاز) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</x-app-layout>
