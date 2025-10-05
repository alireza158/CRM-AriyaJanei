<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" dir="rtl">
            لیست افراد جهت ارزیابی
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="alert alert-success text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg p-4 sm:p-6" dir="rtl">
            <div class="overflow-x-auto">
                <table class="table table-bordered table-striped w-full text-center min-w-[700px] sm:min-w-full">
                    <thead>
                        <tr>
                            <th>نام</th>
                         
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($targets as $target)
                            <tr>
                                <td>{{ $target->name }}</td>
                            
                                <td>
                                    <a href="{{ route('evaluations.evaluate', $target->id) }}" class="btn btn-sm btn-primary">
                                        فرم ارزیابی
                                    </a>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted">موردی برای ارزیابی یافت نشد.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
