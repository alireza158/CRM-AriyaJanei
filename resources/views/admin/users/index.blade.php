<x-layouts.app>
    <x-slot name="header">
        <h2 class="fw-bold h4">مدیریت کاربران</h2>
    </x-slot>

    <div class="container mt-4" dir="rtl">
        {{-- دکمه ایجاد مدیر جدید --}}
        <div class="mb-3">
            <a href="{{ route('admin.users.createManager') }}" class="btn btn-primary">
                ➕ ایجاد مدیر جدید
            </a>
        </div>

        {{-- پیام موفقیت --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- جدول مدیران --}}
        <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">لیست مدیران و کارمندان</div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0 text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>مدیر</th>
                            <th>کارمندان</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($managers as $manager)
                            <tr>
                                {{-- ستون مدیر --}}
                                <td>
                                    <strong>{{ $manager->name }}</strong><br>
                                    <small class="text-muted">{{ $manager->phone }}</small>
                                </td>

                                {{-- ستون کارمندان --}}
                                <td class="text-start">
                                    @if($manager->employees->isEmpty())
                                        <span class="text-muted">هیچ کارمندی ثبت نشده</span>
                                    @else
                                        <ul class="list-unstyled mb-2">
                                            @foreach($manager->employees as $employee)
                                                <li class="d-flex justify-content-between align-items-center border-bottom py-1">
                                                    <span>
                                                        👤 {{ $employee->name }}
                                                        <small class="text-muted">({{ $employee->phone }})</small>
                                                    </span>
                                                    <span>
                                                        <a href="{{ route('admin.users.editEmployee',$employee->id) }}" class="btn btn-sm btn-outline-success">ویرایش</a>

                                                        <form action="{{ route('admin.users.destroyEmployee',$employee->id) }}" method="POST" class="d-inline">
                                                            @csrf @method('DELETE')
                                                            <button onclick="return confirm('حذف کارمند؟')" class="btn btn-sm btn-outline-danger">حذف</button>
                                                        </form>

                                                        {{-- دکمه ریست پسورد کارمند --}}
                                                        <form action="{{ route('admin.users.resetPassword',$employee->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button onclick="return confirm('پسورد ریست شود؟')" class="btn btn-sm btn-info">ریست پسورد</button>
                                                        </form>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    {{-- دکمه افزودن کارمند --}}
                                    <a href="{{ route('admin.users.createEmployee',$manager->id) }}" class="btn btn-sm btn-outline-primary">
                                        ➕ افزودن کارمند
                                    </a>
                                </td>

                                {{-- ستون عملیات مدیر --}}
                                <td>
                                    <a href="{{ route('admin.users.editManager',$manager->id) }}" class="btn btn-sm btn-warning">ویرایش</a>

                                    <form action="{{ route('admin.users.destroyManager',$manager->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('حذف مدیر و کارمندانش؟')" class="btn btn-sm btn-danger">حذف</button>
                                    </form>

                                    {{-- دکمه ریست پسورد مدیر --}}
                                    <form action="{{ route('admin.users.resetPassword',$manager->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button onclick="return confirm('پسورد ریست شود؟')" class="btn btn-sm btn-info">ریست پسورد</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>
