<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">ارزیابی‌های ماهیانه</h2>
    </x-slot>

    <div class="p-4">
        <form method="GET" class="mb-4 flex gap-2 items-end">
            <div>
                <label>ماه</label>
                <select name="month" class="form-select">
                    @for($m=1;$m<=12;$m++)
                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                            {{ $m }}
                        </option>
                    @endfor
                </select>
            </div>
            <div>
                <label>سال</label>
                <select name="year" class="form-select">
                    @for($y = now()->year-5; $y <= now()->year; $y++)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
            </div>
            <button type="submit" class="btn btn-primary">اعمال فیلتر</button>
        </form>

        @forelse($grouped as $groupKey => $answers)
            @php
                $first = $answers->first();
            @endphp
            <div class="mb-6 p-4 border rounded bg-gray-50">
                <h3 class="font-bold mb-2">
                    ارزیاب: {{ $first->evaluator->name }}
                    → ارزیابی‌شونده: {{ $first->target->name }}
                </h3>
                <table class="table table-bordered w-full text-center">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>سوال</th>
                            <th>امتیاز</th>
                            <th>نظر</th>
                            <th>تاریخ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($answers as $i => $answer)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td>{{ $answer->question->title }}</td>
                                <td>{{ $answer->score }}</td>
                                <td>{{ $answer->comment }}</td>
                                <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($answer->created_at)->format('Y/m/d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @empty
            <p class="text-center text-muted">هیچ ارزیابی‌ای برای این ماه ثبت نشده است.</p>
        @endforelse
    </div>
</x-app-layout>
