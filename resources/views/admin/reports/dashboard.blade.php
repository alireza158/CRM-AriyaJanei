<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            📊 گزارش‌های مدیریتی
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- 📊 نمودار دایره‌ای: نحوه آشنایی مشتریان --}}
            <div class="bg-white p-5 rounded-2xl shadow flex flex-col items-center justify-center">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">نحوه آشنایی مشتریان</h3>
                <div class="w-44 h-44" style="height: 19rem !important;">
                    <canvas id="referenceChart"></canvas>
                </div>
            </div>

            {{-- 📈 نمودار میله‌ای: مشتری‌ها بر اساس شهر --}}
            <div class="bg-white p-5 rounded-2xl shadow flex flex-col items-center justify-center">
                <h3 class="text-lg font-semibold mb-3 text-gray-800">تعداد مشتری‌ها بر اساس شهر</h3>
                <div class="w-full" style="height: 230px; ">
                    <canvas id="cityChart"></canvas>
                </div>
            </div>

        </div>
        {{-- 📋 جدول آمار بازاریاب‌ها --}}
<div class="mt-10 bg-white p-6 rounded-2xl shadow">
    <h3 class="text-xl font-semibold mb-4 text-gray-800 text-right">📋 آمار فعالیت بازاریاب‌ها</h3>

    <div class="overflow-x-auto">
        <table class="table-auto w-full text-right border-collapse border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border border-gray-200 px-4 py-2">نام بازاریاب</th>
                    <th class="border border-gray-200 px-4 py-2">📞 شماره‌های ثبت‌شده</th>
                    <th class="border border-gray-200 px-4 py-2">📝 یادداشت‌ها</th>
                    <th class="border border-gray-200 px-4 py-2">📑 گزارش‌های ارسال‌شده</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marketerStats as $marketer)
                <tr class="hover:bg-gray-50 transition">
                    <td class="border border-gray-200 px-4 py-2 font-semibold text-gray-800">
                        {{ $marketer->name }}
                    </td>
                    <td class="border border-gray-200 px-4 py-2 text-blue-600 font-medium text-center">
                        {{ $marketer->customers_count }}
                    </td>
                    <td class="border border-gray-200 px-4 py-2 text-green-600 font-medium text-center">
                        {{ $marketer->notes_count }}
                    </td>
                    <td class="border border-gray-200 px-4 py-2 text-purple-600 font-medium text-center">
                        {{ $marketer->reports_count }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div></div>

    </div>
    {{-- 📅 فیلتر و نمودار تماس‌ها --}}
<div class="mt-10 bg-white p-6 rounded-2xl shadow">
    <h3 class="text-xl font-semibold mb-4 text-gray-800 text-right">📈 تماس‌های روزانه</h3>

    {{-- فیلترها --}}
    <form id="filterForm" method="GET" action="{{ route('admin.reports') }}" class="flex flex-wrap items-center gap-3 mb-6" dir="rtl">
        {{-- انتخاب بازاریاب --}}
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">بازاریاب:</label>
            <select name="marketer_id" class="border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                <option value="">همه</option>
                @foreach($marketers as $marketer)
                    <option value="{{ $marketer->id }}" {{ request('marketer_id') == $marketer->id ? 'selected' : '' }}>
                        {{ $marketer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- انتخاب ماه --}}
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">ماه:</label>
          @php
    $monthNames = [
        1 => 'فروردین',
        2 => 'اردیبهشت',
        3 => 'خرداد',
        4 => 'تیر',
        5 => 'مرداد',
        6 => 'شهریور',
        7 => 'مهر',
        8 => 'آبان',
        9 => 'آذر',
        10 => 'دی',
        11 => 'بهمن',
        12 => 'اسفند',
    ];
@endphp

<select name="month" class="border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
    @for($m = 1; $m <= 12; $m++)
        <option value="{{ $m }}" {{ request('month', verta()->month) == $m ? 'selected' : '' }}>
            {{ $monthNames[$m] }}
        </option>
    @endfor
</select>

        </div>

        {{-- انتخاب سال --}}
        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1">سال:</label>
            <select name="year" class="border rounded-md px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                @for($y = verta()->year - 2; $y <= verta()->year + 1; $y++)
                    <option value="{{ $y }}" {{ request('year', verta()->year) == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">اعمال</button>
    </form>

    {{-- نمودار --}}
    <div style="height: 300px;">
        <canvas id="callsChart"></canvas>
    </div>


</div>
{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const referenceData = @json($referenceData);
    const cityData = @json($cityData);

    // 📊 نمودار دایره‌ای کوچک
    const ctx1 = document.getElementById('referenceChart').getContext('2d');
    new Chart(ctx1, {
        type: 'pie',
        data: {
            labels: referenceData.map(r => r.label),
            datasets: [{
                data: referenceData.map(r => r.count),
                backgroundColor: [
                    '#3B82F6','#10B981','#F59E0B','#EF4444','#8B5CF6','#14B8A6','#F97316'
                ],
                borderWidth: 1,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            radius: 80, // کوچک‌تر شدن دایره
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 10,
                        font: { size: 11 }
                    }
                }
            }
        }
    });

    // 📈 نمودار میله‌ای فشرده
    const ctx2 = document.getElementById('cityChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: cityData.map(c => c.city),
            datasets: [{
                label: 'تعداد مشتری',
                data: cityData.map(c => c.count),
                backgroundColor: '#3B82F6',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { ticks: { font: { size: 11 } } },
                y: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
    // 📊 نمودار تماس‌ها (موفق / ناموفق)
// 📊 نمودار تماس‌ها (موفق / ناموفق)
const callsData = @json($reportsByDay);
const ctx3 = document.getElementById('callsChart').getContext('2d');
new Chart(ctx3, {
    type: 'bar',
    data: {
        labels: callsData.map(r => r.date),
        datasets: [
             {
                label: 'ناموفق',
                data: callsData.map(r => r.unsuccessful),
                backgroundColor: 'rgba(255, 0, 25, 1)', // قرمز پررنگ‌تر
                borderColor: '#b91c1c',
                borderWidth: 1,
                borderRadius: 6,
            },
            {
                label: 'موفق',
                data: callsData.map(r => r.successful),
                backgroundColor: 'rgba(43, 243, 53, 1)', // سبز
                borderRadius: 6,
            }
           
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: { stacked: true },
            y: { beginAtZero: true, ticks: { stepSize: 1 } }
        },
        plugins: {
            legend: {
                position: 'bottom',
                labels: { font: { size: 11 } }
            }
        }
    }
});



</script>

</x-app-layout>
