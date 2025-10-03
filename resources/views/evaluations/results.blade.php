{{-- resources/views/evaluations/results.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">
            نتایج ارزیابی {{ $target->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6" dir="rtl">
            <table class="table table-bordered table-striped w-full text-center min-w-[700px] sm:min-w-full">
                <thead>
                    <tr>
                        <th>سوال</th>
                        <th>امتیاز</th>
                        <th>نظر</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($answers as $answer)
                        <tr>
                            <td class="text-right">{{ $answer->question->title }}</td>
                            <td>{{ $answer->score }}</td>
                            <td>{{ $answer->comment ?? '-' }}</td>
                            <td>
                                {{ \Hekmatinasser\Verta\Verta::instance($answer->created_at)->format('Y/m/d') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">هیچ پاسخی ثبت نشده است.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
