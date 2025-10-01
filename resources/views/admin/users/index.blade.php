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

        {{-- جدول مدیران و کارمندان --}}
        <div class="card shadow-sm">
            <div class="card-header bg-light fw-bold">لیست مدیران و کارمندان</div>
            <div class="card-body p-0">
                <table class="table table-bordered table-hover mb-0 text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>مدیر</th>
                            <th>کارمندان</th>
                            <th>مدیریت نقش‌ها</th>
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
                                                    <span class="d-flex gap-1">
                                                        {{-- ویرایش --}}
                                                        <a href="{{ route('admin.users.editEmployee',$employee->id) }}" class="btn btn-sm btn-outline-success">ویرایش</a>

                                                        {{-- حذف --}}
                                                        <form action="{{ route('admin.users.destroyEmployee',$employee->id) }}" method="POST">
                                                            @csrf @method('DELETE')
                                                            <button onclick="return confirm('حذف کارمند؟')" class="btn btn-sm btn-outline-danger">حذف</button>
                                                        </form>

                                                        {{-- ریست پسورد --}}
                                                        <form action="{{ route('admin.users.resetPassword',$employee->id) }}" method="POST">
                                                            @csrf
                                                            <button onclick="return confirm('پسورد ریست شود؟')" class="btn btn-sm btn-info">ریست پسورد</button>
                                                        </form>

                                                        {{-- مدیریت نقش‌ها --}}
                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#rolesModal{{ $employee->id }}">
                                                            نقش‌ها
                                                        </button>
                                                    </span>
                                                </li>

                                                {{-- Modal نقش‌ها کارمند --}}
                                                <div class="modal fade" id="rolesModal{{ $employee->id }}" tabindex="-1" aria-labelledby="rolesModalLabel{{ $employee->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="rolesModalLabel{{ $employee->id }}">مدیریت نقش‌ها: {{ $employee->name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('admin.users.updateRoles', $employee->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <p>انتخاب نقش‌ها:</p>
                                                                    <div class="row">
                                                                        @foreach($roles as $role)
                                                                            <div class="col-6 mb-2">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}"
                                                                                        id="role{{ $employee->id }}{{ $role->id }}"
                                                                                        @if($employee->roles->contains('name', $role->name)) checked @endif>
                                                                                    <label class="form-check-label" for="role{{ $employee->id }}{{ $role->id }}">
                                                                                        {{ $role->name }}
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                                                    <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </ul>
                                    @endif

                                    {{-- افزودن کارمند --}}
                                    <a href="{{ route('admin.users.createEmployee',$manager->id) }}" class="btn btn-sm btn-outline-primary mt-1">➕ افزودن کارمند</a>
                                </td>

                                {{-- ستون مدیریت نقش مدیر --}}
                                <td>
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#rolesModalManager{{ $manager->id }}">
                                        نقش‌ها
                                    </button>

                                    {{-- Modal نقش‌ها مدیر --}}
                                    <div class="modal fade" id="rolesModalManager{{ $manager->id }}" tabindex="-1" aria-labelledby="rolesModalManagerLabel{{ $manager->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rolesModalManagerLabel{{ $manager->id }}">مدیریت نقش‌ها: {{ $manager->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.users.updateRoles', $manager->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>انتخاب نقش‌ها:</p>
                                                        <div class="row">
                                                            @foreach($roles as $role)
                                                                <div class="col-6 mb-2">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}"
                                                                            id="roleManager{{ $manager->id }}{{ $role->id }}"
                                                                            @if($manager->roles->contains('name', $role->name)) checked @endif>
                                                                        <label class="form-check-label" for="roleManager{{ $manager->id }}{{ $role->id }}">
                                                                            {{ $role->name }}
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                                        <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- ستون عملیات مدیر --}}
                                <td class="d-flex flex-column gap-1">
                                    <a href="{{ route('admin.users.editManager',$manager->id) }}" class="btn btn-sm btn-warning">ویرایش</a>
                                    <form action="{{ route('admin.users.destroyManager',$manager->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button onclick="return confirm('حذف مدیر و کارمندانش؟')" class="btn btn-sm btn-danger">حذف</button>
                                    </form>
                                    <form action="{{ route('admin.users.resetPassword',$manager->id) }}" method="POST">
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
