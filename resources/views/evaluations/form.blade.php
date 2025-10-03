{{-- resources/views/evaluations/form.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">
            فرم ارزیابی {{ $target->name }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6" dir="rtl">
            <form action="{{ route('evaluations.store',$target) }}" method="POST">
                @csrf
                <table class="table table-bordered table-striped w-full text-center min-w-[700px] sm:min-w-full">
                    <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>سوال</th>
                            <th>توضیحات</th>
                            <th>امتیاز (۱ تا ۵)</th>
                            <th>نظر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($form->questions as $i => $q)
                            <tr>
                                <td>{{ $i+1 }}</td>
                                <td class="text-right">{{ $q->title }}</td>
                                <td class="text-right">{{ $q->description }}</td>
                                <td>
                                    <select name="answers[{{ $q->id }}]" class="form-select" required>
                                        <option value="">انتخاب...</option>
                                        @for($s=1;$s<=5;$s++)
                                            <option value="{{ $s }}">{{ $s }}</option>
                                        @endfor
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="comments[{{ $q->id }}]" class="form-control" placeholder="نظر اختیاری">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-success w-50">ثبت ارزیابی</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
