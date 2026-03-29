<x-layouts.app>
    @php
        $sortedManagers = $managers->sortBy(function ($manager) {
            $roleNames = $manager->roles->pluck('name');

            if ($roleNames->contains('Owner')) {
                return 0;
            }

            if ($roleNames->contains('InternalManager')) {
                return 1;
            }

            return 2;
        })->values();

        function managerBadgeMeta($manager)
        {
            $roleNames = $manager->roles->pluck('name');

            if ($roleNames->contains('Owner')) {
                return [
                    'label' => 'مدیر کل',
                    'class' => 'owner',
                ];
            }

            if ($roleNames->contains('InternalManager')) {
                return [
                    'label' => 'مدیر داخلی',
                    'class' => 'internal',
                ];
            }

            return [
                'label' => 'مدیر',
                'class' => 'default',
            ];
        }
    @endphp

    <x-slot name="header">
        <div class="users-header">
            <div>
                <h2 class="users-title mb-0">مدیریت کاربران</h2>
                <div class="users-subtitle">مدیران، کارمندان و نقش‌های دسترسی</div>
            </div>

            <a href="{{ route('admin.users.createManager') }}" class="btn btn-primary users-add-btn">
                <span>➕</span>
                <span>ایجاد مدیر جدید</span>
            </a>
        </div>
    </x-slot>

    <div class="container py-4 users-page" dir="rtl">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="users-search-box mb-4">
            <div class="search-input-wrap">
                <span class="search-icon">🔍</span>
                <input
                    type="text"
                    id="userSearchInput"
                    class="form-control users-search-input"
                    placeholder="جستجو بر اساس نام، شماره یا نقش..."
                    autocomplete="off"
                >
            </div>
        </div>

        @if($sortedManagers->isEmpty())
            <div class="users-empty">
                <div class="users-empty__icon">👥</div>
                <h4 class="fw-bold mb-2">هنوز مدیری ثبت نشده</h4>
                <p class="text-muted mb-4">برای شروع، یک مدیر جدید ایجاد کنید.</p>

                <a href="{{ route('admin.users.createManager') }}" class="btn btn-primary rounded-pill px-4">
                    ایجاد مدیر جدید
                </a>
            </div>
        @else
            <div id="defaultManagersSection">
                <div class="section-head mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">لیست مدیران</h5>
                        <div class="text-muted small">مدیر کل و مدیر داخلی در بالاترین اولویت نمایش داده می‌شوند.</div>
                    </div>
                </div>

                <div class="row g-4" id="managerGrid">
                    @foreach($sortedManagers as $manager)
                        @php
                            $badgeMeta = managerBadgeMeta($manager);
                        @endphp

                        <div class="col-12 col-md-6 col-xl-4">
                            <div class="manager-card h-100">
                                <div class="manager-card__top">
                                    <div class="manager-card__identity">
                                        <div class="manager-avatar">
                                            {{ mb_substr($manager->name, 0, 1) }}
                                        </div>

                                        <div class="manager-meta">
                                            <div class="manager-name">{{ $manager->name }}</div>
                                            <div class="manager-phone">{{ $manager->phone }}</div>

                                            @if($manager->roles->count())
                                                <div class="role-badges mt-2">
                                                    @foreach($manager->roles as $role)
                                                        <span class="role-badge">{{ $role->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="manager-card__badges">
                                        <span class="soft-badge role-state {{ $badgeMeta['class'] }}">
                                            {{ $badgeMeta['label'] }}
                                        </span>
                                        <span class="soft-badge primary">{{ $manager->employees->count() }} کارمند</span>
                                    </div>
                                </div>

                                <div class="manager-card__footer">
                                    <button
                                        type="button"
                                        class="btn btn-primary rounded-pill px-4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#managerModal{{ $manager->id }}"
                                    >
                                        مشاهده جزئیات
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div id="searchResultsSection" class="d-none">
                <div class="section-head mb-3">
                    <div>
                        <h5 class="fw-bold mb-1">نتایج جستجو</h5>
                        <div class="text-muted small">مدیرها و کارمندها جداگانه نمایش داده می‌شوند.</div>
                    </div>
                    <div class="search-result-counter" id="searchResultCounter">0 نتیجه</div>
                </div>

                <div class="row g-3" id="searchResultsGrid">
                    @foreach($sortedManagers as $manager)
                        @php
                            $badgeMeta = managerBadgeMeta($manager);

                            $managerSearch = $manager->name . ' ' . $manager->phone;
                            foreach ($manager->roles as $role) {
                                $managerSearch .= ' ' . $role->name;
                            }
                        @endphp

                        <div
                            class="col-12 col-md-6 col-xl-4 search-result-item d-none"
                            data-search-type="manager"
                            data-search="{{ mb_strtolower($managerSearch) }}"
                        >
                            <div class="search-user-card h-100">
                                <div class="search-user-card__head">
                                    <div class="search-user-card__identity">
                                        <div class="manager-avatar">
                                            {{ mb_substr($manager->name, 0, 1) }}
                                        </div>

                                        <div class="search-user-meta">
                                            <div class="search-user-name">{{ $manager->name }}</div>
                                            <div class="search-user-phone">{{ $manager->phone }}</div>

                                            @if($manager->roles->count())
                                                <div class="role-badges mt-2">
                                                    @foreach($manager->roles as $role)
                                                        <span class="role-badge">{{ $role->name }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="search-user-badges">
                                        <span class="soft-badge role-state {{ $badgeMeta['class'] }}">
                                            {{ $badgeMeta['label'] }}
                                        </span>
                                        <span class="soft-badge primary">{{ $manager->employees->count() }} کارمند</span>
                                    </div>
                                </div>

                                <div class="search-user-card__footer">
                                    <button
                                        type="button"
                                        class="btn btn-primary rounded-pill px-4"
                                        data-bs-toggle="modal"
                                        data-bs-target="#managerModal{{ $manager->id }}"
                                    >
                                        مشاهده جزئیات
                                    </button>
                                </div>
                            </div>
                        </div>

                        @foreach($manager->employees as $employee)
                            @php
                                $employeeSearch = $employee->name . ' ' . $employee->phone . ' ' . $manager->name . ' ' . $manager->phone;
                                foreach ($employee->roles as $role) {
                                    $employeeSearch .= ' ' . $role->name;
                                }
                            @endphp

                            <div
                                class="col-12 col-md-6 col-xl-4 search-result-item d-none"
                                data-search-type="employee"
                                data-search="{{ mb_strtolower($employeeSearch) }}"
                            >
                                <div class="search-user-card employee h-100">
                                    <div class="search-user-card__head">
                                        <div class="search-user-card__identity">
                                            <div class="employee-avatar lg">👤</div>

                                            <div class="search-user-meta">
                                                <div class="search-user-name">{{ $employee->name }}</div>
                                                <div class="search-user-phone">{{ $employee->phone }}</div>
                                                <div class="search-user-parent">
                                                    مدیر مربوطه:
                                                    <strong>{{ $manager->name }}</strong>
                                                </div>

                                                @if($employee->roles->count())
                                                    <div class="role-badges mt-2">
                                                        @foreach($employee->roles as $role)
                                                            <span class="role-badge">{{ $role->name }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="search-user-badges">
                                            <span class="soft-badge">کارمند</span>
                                        </div>
                                    </div>

                                    <div class="search-user-card__footer">
                                        <div class="d-flex flex-wrap gap-2">
                                            <button
                                                type="button"
                                                class="btn btn-outline-secondary rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#rolesModal{{ $employee->id }}"
                                            >
                                                نقش‌ها
                                            </button>

                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-user-action rounded-pill px-3 dropdown-toggle"
                                                    type="button"
                                                    data-bs-toggle="dropdown"
                                                    aria-expanded="false"
                                                >
                                                    عملیات
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end text-end shadow-sm border-0 rounded-4">
                                                    <li>
                                                        <a class="dropdown-item py-2"
                                                           href="{{ route('admin.users.editEmployee', $employee->id) }}">
                                                            ✏️ ویرایش
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <button
                                                            class="dropdown-item py-2"
                                                            type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#resetEmployeeModal{{ $employee->id }}"
                                                        >
                                                            🔑 ریست پسورد
                                                        </button>
                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <button
                                                            class="dropdown-item text-danger py-2"
                                                            type="button"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteEmployeeModal{{ $employee->id }}"
                                                        >
                                                            🗑 حذف
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>

                <div id="managerNoResult" class="users-empty d-none mt-4">
                    <div class="users-empty__icon">🔎</div>
                    <h4 class="fw-bold mb-2">کاربری پیدا نشد</h4>
                    <p class="text-muted mb-0">نام، شماره یا نقش دیگری را جستجو کنید.</p>
                </div>
            </div>

            @foreach($sortedManagers as $manager)
                @php
                    $badgeMeta = managerBadgeMeta($manager);
                @endphp

                <div class="modal fade" id="managerModal{{ $manager->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content border-0 shadow rounded-4 users-modal">
                            <div class="modal-header users-modal-header">
                                <div class="manager-modal-head">
                                    <div class="manager-avatar lg">
                                        {{ mb_substr($manager->name, 0, 1) }}
                                    </div>

                                    <div>
                                        <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                                            <h5 class="modal-title mb-0">{{ $manager->name }}</h5>
                                            <span class="soft-badge role-state {{ $badgeMeta['class'] }}">
                                                {{ $badgeMeta['label'] }}
                                            </span>
                                        </div>

                                        <div class="manager-phone">{{ $manager->phone }}</div>

                                        @if($manager->roles->count())
                                            <div class="role-badges mt-2">
                                                @foreach($manager->roles as $role)
                                                    <span class="role-badge">{{ $role->name }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="manager-toolbar">
                                    <div class="manager-toolbar__left">
                                        <a href="{{ route('admin.users.createEmployee', $manager->id) }}"
                                           class="btn btn-sm btn-light rounded-pill px-3">
                                            افزودن کارمند
                                        </a>

                                        <button
                                            type="button"
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#rolesModalManager{{ $manager->id }}"
                                        >
                                            نقش‌ها
                                        </button>
                                    </div>

                                    <div class="manager-toolbar__right">
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-sm btn-user-action rounded-pill px-3 dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false"
                                            >
                                                عملیات مدیر
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end text-end shadow-sm border-0 rounded-4">
                                                <li>
                                                    <a class="dropdown-item py-2"
                                                       href="{{ route('admin.users.editManager', $manager->id) }}">
                                                        ✏️ ویرایش مدیر
                                                    </a>
                                                </li>
                                                <li>
                                                    <button
                                                        class="dropdown-item py-2"
                                                        type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#resetManagerModal{{ $manager->id }}"
                                                    >
                                                        🔑 ریست پسورد
                                                    </button>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <button
                                                        class="dropdown-item text-danger py-2"
                                                        type="button"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteManagerModal{{ $manager->id }}"
                                                    >
                                                        🗑 حذف مدیر
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="employee-section">
                                    <div class="employee-section__head">
                                        <div>
                                            <h6 class="fw-bold mb-1">کارمندان زیرمجموعه</h6>
                                            <small class="text-muted">لیست کارمندان این مدیر</small>
                                        </div>
                                    </div>

                                    @if($manager->employees->isEmpty())
                                        <div class="employees-empty">
                                            هیچ کارمندی برای این مدیر ثبت نشده است.
                                        </div>
                                    @else
                                        <div class="employee-list">
                                            @foreach($manager->employees as $employee)
                                                <div class="employee-card">
                                                    <div class="employee-card__main">
                                                        <div class="employee-avatar">👤</div>

                                                        <div class="employee-meta">
                                                            <div class="employee-name">{{ $employee->name }}</div>
                                                            <div class="employee-phone">{{ $employee->phone }}</div>

                                                            @if($employee->roles->count())
                                                                <div class="role-badges mt-2">
                                                                    @foreach($employee->roles as $role)
                                                                        <span class="role-badge">{{ $role->name }}</span>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="employee-card__actions">
                                                        <button
                                                            type="button"
                                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#rolesModal{{ $employee->id }}"
                                                        >
                                                            نقش‌ها
                                                        </button>

                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-sm btn-user-action rounded-pill px-3 dropdown-toggle"
                                                                type="button"
                                                                data-bs-toggle="dropdown"
                                                                aria-expanded="false"
                                                            >
                                                                عملیات
                                                            </button>

                                                            <ul class="dropdown-menu dropdown-menu-end text-end shadow-sm border-0 rounded-4">
                                                                <li>
                                                                    <a class="dropdown-item py-2"
                                                                       href="{{ route('admin.users.editEmployee', $employee->id) }}">
                                                                        ✏️ ویرایش
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <button
                                                                        class="dropdown-item py-2"
                                                                        type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#resetEmployeeModal{{ $employee->id }}"
                                                                    >
                                                                        🔑 ریست پسورد
                                                                    </button>
                                                                </li>
                                                                <li><hr class="dropdown-divider"></li>
                                                                <li>
                                                                    <button
                                                                        class="dropdown-item text-danger py-2"
                                                                        type="button"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#deleteEmployeeModal{{ $employee->id }}"
                                                                    >
                                                                        🗑 حذف
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">
                                    بستن
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="rolesModalManager{{ $manager->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content border-0 shadow rounded-4 users-modal">
                            <div class="modal-header">
                                <h5 class="modal-title">مدیریت نقش‌ها: {{ $manager->name }}</h5>
                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <form action="{{ route('admin.users.updateRoles', $manager->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <p class="text-muted small mb-3">نقش‌های موردنظر را انتخاب کنید.</p>

                                    <div class="row g-2">
                                        @foreach($roles as $role)
                                            <div class="col-12 col-sm-6">
                                                <label class="role-check">
                                                    <input
                                                        type="checkbox"
                                                        name="roles[]"
                                                        value="{{ $role->name }}"
                                                        @if($manager->roles->contains('name', $role->name)) checked @endif
                                                    >
                                                    <span>{{ $role->name }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">
                                        بستن
                                    </button>
                                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                                        ذخیره
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteManagerModal{{ $manager->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4 users-modal">
                            <div class="modal-header">
                                <h5 class="modal-title">حذف مدیر</h5>
                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                آیا از حذف <strong>{{ $manager->name }}</strong> و کارمندان زیرمجموعه‌اش مطمئن هستید؟
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">
                                    انصراف
                                </button>

                                <form action="{{ route('admin.users.destroyManager', $manager->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                                        حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="resetManagerModal{{ $manager->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow rounded-4 users-modal">
                            <div class="modal-header">
                                <h5 class="modal-title">ریست پسورد</h5>
                                <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                پسورد <strong>{{ $manager->name }}</strong> ریست شود؟
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">
                                    انصراف
                                </button>

                                <form action="{{ route('admin.users.resetPassword', $manager->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-info text-white rounded-pill px-4">
                                        ریست پسورد
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($manager->employees as $employee)
                    <div class="modal fade" id="rolesModal{{ $employee->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content border-0 shadow rounded-4 users-modal">
                                <div class="modal-header">
                                    <h5 class="modal-title">مدیریت نقش‌ها: {{ $employee->name }}</h5>
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <form action="{{ route('admin.users.updateRoles', $employee->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <p class="text-muted small mb-3">نقش‌های موردنظر را انتخاب کنید.</p>

                                        <div class="row g-2">
                                            @foreach($roles as $role)
                                                <div class="col-12 col-sm-6">
                                                    <label class="role-check">
                                                        <input
                                                            type="checkbox"
                                                            name="roles[]"
                                                            value="{{ $role->name }}"
                                                            @if($employee->roles->contains('name', $role->name)) checked @endif
                                                        >
                                                        <span>{{ $role->name }}</span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">
                                            بستن
                                        </button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                                            ذخیره
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="deleteEmployeeModal{{ $employee->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow rounded-4 users-modal">
                                <div class="modal-header">
                                    <h5 class="modal-title">حذف کارمند</h5>
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    آیا از حذف <strong>{{ $employee->name }}</strong> مطمئن هستید؟
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">
                                        انصراف
                                    </button>

                                    <form action="{{ route('admin.users.destroyEmployee', $employee->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                                            حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="resetEmployeeModal{{ $employee->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow rounded-4 users-modal">
                                <div class="modal-header">
                                    <h5 class="modal-title">ریست پسورد</h5>
                                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    پسورد <strong>{{ $employee->name }}</strong> ریست شود؟
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">
                                        انصراف
                                    </button>

                                    <form action="{{ route('admin.users.resetPassword', $employee->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-info text-white rounded-pill px-4">
                                            ریست پسورد
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endif
    </div>

    @push('styles')
        <style>
            .users-page {
                --u-bg: #f6f8fc;
                --u-card: #ffffff;
                --u-card-2: #fbfcff;
                --u-border: #e9eef5;
                --u-text: #111827;
                --u-muted: #6b7280;
                --u-soft: #f3f6fb;
                --u-primary-soft: rgba(13, 110, 253, 0.10);
                --u-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
                --u-owner-soft: rgba(220, 53, 69, 0.12);
                --u-internal-soft: rgba(245, 158, 11, 0.16);
            }

            html.dark .users-page,
            body.dark .users-page,
            [data-bs-theme="dark"] .users-page {
                --u-bg: #0f172a;
                --u-card: #111827;
                --u-card-2: #0b1220;
                --u-border: #243041;
                --u-text: #e5e7eb;
                --u-muted: #94a3b8;
                --u-soft: #1b2433;
                --u-primary-soft: rgba(59, 130, 246, 0.16);
                --u-shadow: 0 10px 30px rgba(0, 0, 0, 0.28);
                --u-owner-soft: rgba(239, 68, 68, 0.15);
                --u-internal-soft: rgba(245, 158, 11, 0.18);
            }

            .users-page {
                background: transparent;
                color: var(--u-text);
                position: relative;
                z-index: 1;
            }

            .users-header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                flex-wrap: wrap;
            }

            .users-title {
                font-size: 1.45rem;
                font-weight: 900;
                color: var(--u-text);
            }

            .users-subtitle {
                color: var(--u-muted);
                margin-top: 4px;
                font-size: .95rem;
            }

            .users-add-btn {
                border-radius: 999px;
                padding: .7rem 1.25rem;
                display: inline-flex;
                align-items: center;
                gap: .5rem;
                font-weight: 700;
            }

            .users-search-box {
                display: flex;
                justify-content: center;
            }

            .search-input-wrap {
                position: relative;
                width: 100%;
                max-width: 760px;
            }

            .search-icon {
                position: absolute;
                top: 50%;
                right: 16px;
                transform: translateY(-50%);
                font-size: 18px;
                pointer-events: none;
                opacity: .75;
                z-index: 2;
            }

            .users-search-input {
                height: 56px;
                border-radius: 18px;
                border: 1px solid var(--u-border);
                background: var(--u-card);
                color: var(--u-text);
                padding-right: 48px;
                box-shadow: var(--u-shadow);
                font-size: .96rem;
            }

            .users-search-input::placeholder {
                color: var(--u-muted);
            }

            .users-search-input:focus {
                border-color: #3b82f6;
                box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.12);
                background: var(--u-card);
                color: var(--u-text);
            }

            .section-head {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 12px;
                flex-wrap: wrap;
            }

            .search-result-counter {
                background: var(--u-soft);
                border: 1px solid var(--u-border);
                color: var(--u-text);
                border-radius: 999px;
                padding: 8px 14px;
                font-size: .84rem;
                font-weight: 700;
            }

            .users-empty {
                background: var(--u-card);
                border: 1px solid var(--u-border);
                border-radius: 24px;
                padding: 48px 24px;
                text-align: center;
                box-shadow: var(--u-shadow);
            }

            .users-empty__icon {
                font-size: 48px;
                margin-bottom: 12px;
            }

            .manager-card,
            .search-user-card {
                background: linear-gradient(180deg, var(--u-card) 0%, var(--u-card-2) 100%);
                border: 1px solid var(--u-border);
                border-radius: 24px;
                padding: 20px;
                box-shadow: var(--u-shadow);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                gap: 18px;
                transition: .2s ease;
                height: 100%;
            }

            .manager-card:hover,
            .search-user-card:hover {
                transform: translateY(-3px);
            }

            .manager-card__top,
            .search-user-card__head {
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            .manager-card__identity,
            .search-user-card__identity {
                display: flex;
                gap: 14px;
                align-items: center;
                min-width: 0;
            }

            .manager-card__badges,
            .search-user-badges {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }

            .manager-card__footer,
            .search-user-card__footer {
                display: flex;
                justify-content: flex-end;
            }

            .manager-avatar {
                width: 56px;
                height: 56px;
                min-width: 56px;
                border-radius: 18px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 22px;
                font-weight: 900;
                color: #fff;
                background: linear-gradient(135deg, #2563eb, #3b82f6);
                box-shadow: 0 10px 24px rgba(37, 99, 235, 0.22);
            }

            .manager-avatar.lg {
                width: 64px;
                height: 64px;
                min-width: 64px;
                border-radius: 20px;
                font-size: 26px;
            }

            .employee-avatar {
                width: 44px;
                height: 44px;
                min-width: 44px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--u-soft);
                border: 1px solid var(--u-border);
                font-size: 18px;
            }

            .employee-avatar.lg {
                width: 56px;
                height: 56px;
                min-width: 56px;
                border-radius: 18px;
                font-size: 22px;
            }

            .manager-meta,
            .search-user-meta,
            .employee-meta {
                min-width: 0;
            }

            .manager-name,
            .search-user-name {
                font-size: 1.05rem;
                font-weight: 900;
                color: var(--u-text);
                margin-bottom: 4px;
            }

            .manager-phone,
            .search-user-phone,
            .employee-phone {
                color: var(--u-muted);
                font-size: .94rem;
            }

            .search-user-parent {
                color: var(--u-muted);
                font-size: .88rem;
                margin-top: 6px;
            }

            .soft-badge {
                display: inline-flex;
                align-items: center;
                padding: 8px 14px;
                border-radius: 999px;
                background: var(--u-soft);
                color: var(--u-text);
                font-size: .84rem;
                font-weight: 700;
                border: 1px solid var(--u-border);
            }

            .soft-badge.primary {
                background: var(--u-primary-soft);
                color: #3b82f6;
                border-color: transparent;
            }

            .soft-badge.role-state.default {
                background: var(--u-soft);
                color: var(--u-text);
            }

            .soft-badge.role-state.owner {
                background: var(--u-owner-soft);
                color: #dc3545;
                border-color: transparent;
            }

            .soft-badge.role-state.internal {
                background: var(--u-internal-soft);
                color: #b45309;
                border-color: transparent;
            }

            html.dark .soft-badge.role-state.internal,
            body.dark .soft-badge.role-state.internal,
            [data-bs-theme="dark"] .soft-badge.role-state.internal {
                color: #fbbf24;
            }

            .role-badges {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }

            .role-badge {
                display: inline-flex;
                align-items: center;
                padding: 6px 12px;
                border-radius: 999px;
                background: var(--u-soft);
                border: 1px solid var(--u-border);
                color: var(--u-text);
                font-size: .8rem;
                font-weight: 700;
            }

            .users-modal {
                background: var(--u-card) !important;
                color: var(--u-text);
                overflow: hidden;
                position: relative;
                z-index: 2102;
                
            }

            .users-modal .modal-header,
            .users-modal .modal-footer {
                border-color: var(--u-border);
                background: var(--u-card) !important;
            }

            .users-modal .modal-body {
                background: var(--u-card) !important;
                color: var(--u-text);
                position: relative;
                z-index: 1;
            }

            .users-modal .text-muted {
                color: var(--u-muted) !important;
            }

            .users-modal-header {
                align-items: flex-start;
                background: var(--u-card) !important;
                position: sticky;
                top: 0;
                z-index: 5;
            }

            .users-modal .modal-footer {
                background: var(--u-card) !important;
                position: sticky;
                bottom: 0;
                z-index: 5;
            }

            .manager-modal-head {
                display: flex;
                gap: 14px;
                align-items: center;
                position: relative;
                z-index: 2;
            }

            .manager-toolbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 12px;
                flex-wrap: wrap;
                margin-bottom: 24px;
                padding-bottom: 16px;
                border-bottom: 1px solid var(--u-border);
                position: relative;
                z-index: 1;
            }

            .manager-toolbar__left,
            .manager-toolbar__right {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
            }

            .employee-section {
                position: relative;
                z-index: 1;
            }

            .employee-section__head {
                margin-bottom: 14px;
            }

            .employees-empty {
                background: var(--u-card);
                border: 1px dashed var(--u-border);
                border-radius: 18px;
                padding: 24px;
                text-align: center;
                color: var(--u-muted);
            }

            .employee-list {
                display: flex;
                flex-direction: column;
                gap: 12px;
                position: relative;
                z-index: 1;
            }

            .employee-card {
                background: var(--u-card-2);
                border: 1px solid var(--u-border);
                border-radius: 20px;
                padding: 16px;
                box-shadow: 0 8px 20px rgba(15, 23, 42, 0.04);
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 14px;
                position: relative;
                z-index: 1;
            }

            html.dark .employee-card,
            body.dark .employee-card,
            [data-bs-theme="dark"] .employee-card {
                box-shadow: none;
            }

            .employee-card__main {
                display: flex;
                align-items: center;
                gap: 12px;
                min-width: 0;
            }

            .employee-card__actions {
                display: flex;
                align-items: center;
                gap: 8px;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .employee-name {
                font-weight: 800;
                color: var(--u-text);
                margin-bottom: 4px;
            }

            .role-check {
                display: flex;
                align-items: center;
                gap: 10px;
                background: var(--u-soft);
                border: 1px solid var(--u-border);
                border-radius: 14px;
                padding: 12px 14px;
                cursor: pointer;
                width: 100%;
                color: var(--u-text);
            }

            .role-check input {
                margin: 0;
            }

            .btn-user-action {
                background: var(--u-card);
                color: var(--u-text);
                border: 1px solid var(--u-border);
                opacity: 1 !important;
            }

            .btn-user-action:hover,
            .btn-user-action:focus,
            .btn-user-action:active,
            .btn-user-action.show {
                background: var(--u-soft) !important;
                color: var(--u-text) !important;
                border-color: var(--u-border) !important;
                box-shadow: none !important;
            }

            .btn-user-action.dropdown-toggle::after {
                margin-right: 8px;
            }

            .dropdown-menu {
             
                border: 1px solid var(--u-border) !important;
                z-index: 2200;
            }

            .dropdown-item {
                color: var(--u-text);
            }

            .dropdown-item:hover,
            .dropdown-item:focus {
                background: var(--u-soft);
                color: var(--u-text);
            }

            .dropdown-divider {
                border-color: var(--u-border);
            }

            .modal-backdrop {
                z-index: 2090 !important;
            }

            .modal-backdrop.show {
                z-index: -1 !important;
                opacity: .72 !important;
            }

            .modal {
                z-index: 2100 !important;
            }

            .modal-dialog {
                position: relative;
                z-index: 2101 !important;
            }

            .modal-content {
                background: var(--u-card) !important;
                border: 1px solid var(--u-border) !important;
                overflow: hidden;
                position: relative;
                z-index: 2102 !important;
            }

            .modal-dialog-scrollable .modal-content {
                overflow: hidden;
                max-height: calc(100vh - 2rem);
            }

            .modal-dialog-scrollable .modal-body {
                overflow-y: auto;
                overscroll-behavior: contain;
            }

            header,
            .navbar,
            .topbar,
            .app-header,
            .main-header {
                z-index: 1030 !important;
            }

            @media (max-width: 992px) {
                .manager-toolbar {
                    flex-direction: column;
                    align-items: stretch;
                }

                .manager-toolbar__left,
                .manager-toolbar__right {
                    width: 100%;
                }
            }

            @media (max-width: 768px) {
                .manager-avatar {
                    width: 48px;
                    height: 48px;
                    min-width: 48px;
                    font-size: 18px;
                    border-radius: 16px;
                }

                .manager-avatar.lg {
                    width: 54px;
                    height: 54px;
                    min-width: 54px;
                    font-size: 22px;
                }

                .employee-card {
                    flex-direction: column;
                    align-items: stretch;
                }

                .employee-card__actions {
                    justify-content: flex-start;
                    padding-top: 4px;
                }
            }

            @media (max-width: 576px) {
                .users-header {
                    align-items: stretch;
                }

                .users-add-btn {
                    width: 100%;
                    justify-content: center;
                }

                .manager-card__footer .btn,
                .search-user-card__footer .btn {
                    width: 100%;
                }

                .manager-toolbar__left > *,
                .manager-toolbar__right > *,
                .employee-card__actions > * {
                    width: 100%;
                }

                .manager-toolbar__left .dropdown .btn,
                .manager-toolbar__right .dropdown .btn,
                .employee-card__actions .dropdown .btn {
                    width: 100%;
                }

                .employee-card__actions .btn {
                    width: 100%;
                }

                .manager-modal-head {
                    align-items: flex-start;
                }

                /* کارت‌ها نباید منوی دراپ‌دان را قطع کنند */
.manager-card,
.search-user-card,
.employee-card,
.users-modal,
.modal-content,
.modal-body,
.employee-list,
.employee-section {
    overflow: visible !important;
}

/* اگر قبلاً isolation گذاشتی، برای والدهایی که استک جدید می‌سازند حذفش کن */
.users-modal,
.modal-content,
.employee-card,
.search-user-card,
.manager-card {
    isolation: auto !important;
}

/* والد دکمه عملیات باید مرجع درست برای منو باشد */
.dropdown {
    position: relative;
    z-index: 3000;
}

/* خود منو همیشه بالاتر از کارت‌ها و محتوا باشد */
.dropdown-menu {
    position: absolute !important;
    z-index: 4000 !important;
    background: var(--u-card) !important;
    border: 1px solid var(--u-border) !important;
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.18) !important;
}

/* وقتی داخل مودال هستیم، باز هم بالاتر بماند */
.modal .dropdown-menu {
    z-index: 5000 !important;
}

/* این بخش‌ها لازم نیست z-index بگیرند؛ برداشتن‌شان جلوی تداخل را می‌گیرد */
.manager-toolbar,
.employee-section,
.employee-list,
.employee-card,
.manager-modal-head {
    z-index: auto !important;
}

/* اگر روی کارت‌ها transform داری، استک جدید می‌سازد؛ hover را سبک نگه دار */
.manager-card:hover,
.search-user-card:hover {
    transform: translateY(-3px);
    z-index: 1;
}

.employee-card:hover {
    z-index: 1;
}
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const searchInput = document.getElementById('userSearchInput');
                const defaultSection = document.getElementById('defaultManagersSection');
                const searchSection = document.getElementById('searchResultsSection');
                const resultItems = document.querySelectorAll('.search-result-item');
                const noResultBox = document.getElementById('managerNoResult');
                const resultCounter = document.getElementById('searchResultCounter');

                function normalizeText(text) {
                    return (text || '')
                        .toString()
                        .trim()
                        .toLowerCase()
                        .replace(/ي/g, 'ی')
                        .replace(/ك/g, 'ک');
                }

                function setDefaultView() {
                    if (defaultSection) defaultSection.classList.remove('d-none');
                    if (searchSection) searchSection.classList.add('d-none');

                    resultItems.forEach(item => item.classList.add('d-none'));

                    if (noResultBox) noResultBox.classList.add('d-none');
                    if (resultCounter) resultCounter.textContent = '0 نتیجه';
                }

                function runSearch(query) {
                    let visibleCount = 0;

                    resultItems.forEach(item => {
                        const searchData = normalizeText(item.getAttribute('data-search'));
                        const matched = searchData.includes(query);

                        item.classList.toggle('d-none', !matched);

                        if (matched) visibleCount++;
                    });

                    if (defaultSection) defaultSection.classList.add('d-none');
                    if (searchSection) searchSection.classList.remove('d-none');

                    if (noResultBox) {
                        noResultBox.classList.toggle('d-none', visibleCount !== 0);
                    }

                    if (resultCounter) {
                        resultCounter.textContent = `${visibleCount} نتیجه`;
                    }
                }

                if (searchInput) {
                    searchInput.addEventListener('input', function () {
                        const query = normalizeText(this.value);

                        if (!query.length) {
                            setDefaultView();
                            return;
                        }

                        runSearch(query);
                    });
                }

                document.querySelectorAll('.modal').forEach(modalEl => {
                    modalEl.addEventListener('show.bs.modal', function () {
                        document.body.classList.add('modal-open-fix');
                    });

                    modalEl.addEventListener('hidden.bs.modal', function () {
                        if (!document.querySelector('.modal.show')) {
                            document.body.classList.remove('modal-open-fix');
                        }
                    });
                });
            });
        </script>
    @endpush

    @stack('styles')
    @stack('scripts')
</x-layouts.app>

<script>
document.addEventListener('shown.bs.dropdown', function (event) {
    const toggle = event.target;
    const dropdown = toggle.closest('.dropdown');
    const menu = dropdown ? dropdown.querySelector('.dropdown-menu') : null;

    if (!menu) return;

    document.body.appendChild(menu);

    const rect = toggle.getBoundingClientRect();
    menu.style.position = 'fixed';
    menu.style.top = (rect.bottom + 6) + 'px';
    menu.style.left = (rect.left + rect.width - menu.offsetWidth) + 'px';
    menu.style.zIndex = '99999';
});

document.addEventListener('hide.bs.dropdown', function (event) {
    const toggle = event.target;
    const dropdown = toggle.closest('.dropdown');
    const menu = document.body.querySelector('.dropdown-menu.show');

    if (!dropdown || !menu) return;

    dropdown.appendChild(menu);
    menu.style.position = '';
    menu.style.top = '';
    menu.style.left = '';
    menu.style.zIndex = '';
});
</script>

