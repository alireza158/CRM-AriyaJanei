{{-- resources/views/evaluations/monthly.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2" dir="rtl">
            <h2 class="text-xl fw-bold m-0">ارزیابی‌های ماهانه (شمسی)</h2>

            @php
                // ⚠️ از FQCN استفاده می‌کنیم؛ use داخل Blade ممنوع است
                $jy = isset($jy) ? $jy : \Morilog\Jalali\Jalalian::now()->getYear();
                $jm = isset($jm) ? $jm : \Morilog\Jalali\Jalalian::now()->getMonth();
                $jalaliMonths = [
                    1=>'فروردین',2=>'اردیبهشت',3=>'خرداد',4=>'تیر',5=>'مرداد',6=>'شهریور',
                    7=>'مهر',8=>'آبان',9=>'آذر',10=>'دی',11=>'بهمن',12=>'اسفند'
                ];
            @endphp

            {{-- فیلتر سال/ماه شمسی --}}
            <form method="GET" class="d-flex align-items-end gap-2">
                <div>
                    <label class="form-label mb-1">سال (شمسی)</label>
                    <input type="number" name="jy" class="form-control form-control-sm"
                           value="{{ $jy }}" min="1395" max="1500" style="width:110px">
                </div>
                <div>
                    <label class="form-label mb-1">ماه (شمسی)</label>
                    <select name="jm" class="form-select form-select-sm" style="width:150px">
                        @foreach($jalaliMonths as $mVal => $mName)
                            <option value="{{ $mVal }}" @selected($mVal == $jm)>{{ $mName }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">اعمال فیلتر</button>
                <a href="{{ request()->url() }}" class="btn btn-outline-secondary btn-sm">حذف فیلتر</a>
            </form>
        </div>
    </x-slot>

    <div class="p-3 p-sm-4" dir="rtl">
        @forelse($grouped as $groupKey => $answers)
            @php $first = $answers->first(); @endphp

            <div class="mb-4 p-3 p-sm-4 border rounded-3 bg-light-subtle">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                    <h5 class="fw-bold m-0">
                        ارزیاب: {{ $first->evaluator->name }}
                        <span class="mx-1">→</span>
                        ارزیابی‌شونده: {{ $first->target->name }}
                    </h5>
                    <div class="text-muted small">
                        بازهٔ نمایش: {{ $jalaliMonths[$jm] }} {{ $jy }}
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:70px">ردیف</th>
                                <th class="text-start">سوال</th>
                                <th style="width:110px">امتیاز</th>
                                <th>نظر</th>
                                <th style="width:140px">تاریخ (شمسی)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($answers as $i => $answer)
                                @php
                                    $score = (int)$answer->score;
                                    $badge = $score >= 4 ? 'success' : ($score == 3 ? 'warning' : 'danger');
                                @endphp
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td class="text-start">{{ $answer->question->title }}</td>
                                    <td>
                                        <span class="badge bg-{{ $badge }} px-3 py-2">{{ $score }}</span>
                                    </td>
                                    <td class="text-muted">{{ $answer->comment ?: '—' }}</td>
                                    <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($answer->created_at)->format('Y/m/d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center text-muted border rounded-3 p-4">
                هیچ ارزیابی‌ای برای این ماه ثبت نشده است.
            </div>
        @endforelse
    </div>
</x-app-layout>
