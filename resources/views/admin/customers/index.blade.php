<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">مدیریت مشتریان</h2>
    </x-slot>

<link href="https://lib.arvancloud.ir/bootstrap/5.3.0-alpha1/css/bootstrap.rtl.min.css" rel="stylesheet">

    {{-- اگر داخل layout لود نکردی، اینو هم اضافه کن --}}
    
<script src="https://lib.arvancloud.ir/jquery/3.6.3/jquery.js"></script>

    {{-- Datepicker (Persian) --}}
  <link rel="stylesheet" href="{{ asset('lib/persian-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('lib/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('lib/jalalidatepicker.min.css') }}">

<script src="{{ asset('lib/jquery.min.js') }}"></script>
<script src="{{ asset('lib/persian-date.min.js') }}"></script>
<script src="{{ asset('lib/persian-datepicker.min.js') }}"></script>
<script src="{{ asset('lib/flatpickr.min.js') }}"></script>
<script src="{{ asset('lib/jalalidatepicker.min.js') }}"></script>
    <div class="container mt-4">

        {{-- پیام موفقیت --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php $user = Auth::user(); @endphp

        {{-- فرم سرچ + مرتب‌سازی --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                @php
                    // برای اینکه هم Admin/internalManager و هم Marketer کار کنه
                    $indexRoute = $user->hasRole('Marketer')
                        ? route('customersAdmin2.index')
                        : route('admin.customersAdmin.index');
                @endphp

                <form method="GET" action="{{ $indexRoute }}" class="row g-2 align-items-center">

                    <div class="col-md-4">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="جستجو نام یا شماره"
                               class="form-control">
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> جستجو
                        </button>
                    </div>

                    {{-- مرتب سازی --}}
                    <div class="col-md-3">
                        <select name="sort" class="form-select" onchange="this.form.submit()">
                            <option value="" {{ request('sort') == '' ? 'selected' : '' }}>مرتب‌سازی عادی</option>
                            <option value="last_note" {{ request('sort') == 'last_note' ? 'selected' : '' }}>
                                مرتب‌سازی بر اساس آخرین یادداشت
                            </option>
                        </select>
                    </div>

                    {{-- مشتری جدید --}}
                    <div class="col-md-3">
                        <a href="{{ route('admin.customersCreate.create') }}" class="btn btn-success w-100">
                            <i class="bi bi-plus-circle"></i> مشتری جدید
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="{{ route('admin.customersAdmin.export.excel') }}" class="btn btn-outline-success w-100">
                            <i class="bi bi-file-earmark-excel"></i> خروجی اکسل همه مشتری‌ها
                        </a>
                    </div>

                    {{-- بازه تاریخی (فقط وقتی last_note انتخاب شده) --}}
                    @if(request('sort') === 'last_note')
                        <div class="col-md-3">
                            <input type="text"
                                   id="note_from"
                                   name="note_from"
                                   value="{{ request('note_from') }}"
                                   class="form-control"
                                   placeholder="از تاریخ (مثلا 1402/01/01)">
                        </div>

                        <div class="col-md-3">
                            <input type="text"
                                   id="note_to"
                                   name="note_to"
                                   value="{{ request('note_to') }}"
                                   class="form-control"
                                   placeholder="تا تاریخ (مثلا 1402/12/29)">
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-outline-primary w-100">
                                اعمال بازه
                            </button>
                        </div>

                        <div class="col-md-1">
                            <a class="btn btn-outline-secondary w-100"
                               href="{{ $indexRoute . '?' . http_build_query(array_filter([
                                    'search' => request('search'),
                                    'sort' => 'last_note',
                               ])) }}">
                                پاک
                            </a>
                        </div>
                    @endif

                </form>
            </div>
        </div>

        {{-- جدول مشتریان --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center">
                        <thead class="table-dark">
                        <tr>
                            <th>شناسه مشتری</th>
                            <th>نام</th>
                            <th>شماره</th>
                            <th>بازاریاب</th>
                            <th>شهر</th>
                            <th>نحوه آشنایی</th>
                            <th>یادداشت‌ها</th>
                            <th>ارتباط</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>{{ $customer->display_customer_id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->marketer?->name ?? '-' }}</td>
                                @if ( $customer->city == null)
                                       <td>{{ $customer->address }}</td>
                                @else
<td>{{ $customer->city }}</td>
                                @endif
                             
                                <td>{{ $customer->referenceType?->name ?? '-' }}</td>

                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#invoicesModal-{{ $customer->id }}">
                                        مشاهده فاکتورها
                                    </button>

                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#notesModal-{{ $customer->id }}">
                                        مشاهده یادداشت‌ها
                                    </button>
                                </td>

                                {{-- ارتباط --}}
                                <td>
                                    @if($user->hasRole('Admin') || $user->hasRole('internalManager'))
                                        @if($customer->phone)
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle"
                                                        data-bs-toggle="dropdown">
                                                    ارتباط
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                           href="https://wa.me/{{ preg_replace('/^0/', '98', $customer->phone) }}"
                                                           target="_blank">
                                                            <i class="bi bi-whatsapp text-success"></i> واتساپ
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="sms:{{ $customer->phone }}">
                                                            <i class="bi bi-chat-dots text-primary"></i> پیامک
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="tel:{{ $customer->phone }}">
                                                            <i class="bi bi-telephone text-dark"></i> تماس
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- عملیات --}}
                                <td>
                                    @if($user->hasRole('Admin') || $user->hasRole('internalManager')|| $user->hasRole('SaleManager'))
                                        <a href="{{ route('admin.customersedit.edit', $customer->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-square"></i> ویرایش
                                        </a>

                                        <form action="{{ route('admin.customersdelete.destroy', $customer) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('آیا مطمئن هستید؟')" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i> حذف
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-muted">هیچ مشتری یافت نشد.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- مودال‌ها --}}
                @foreach($customers as $customer)

                    {{-- Modal فاکتورها --}}
                    <div class="modal fade" id="invoicesModal-{{ $customer->id }}" data-customer="{{ $customer->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-info text-white">
                                    <h5 class="modal-title">فاکتورهای {{ $customer->name }} (شناسه: {{ $customer->display_customer_id }})</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body" dir="rtl">
                                    @forelse($customer->invoices as $invoice)
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <strong>شماره فاکتور:</strong> INV-{{ str_pad($invoice->id, 5, '0', STR_PAD_LEFT) }} |
                                                <strong>تاریخ:</strong> {{ \Morilog\Jalali\Jalalian::fromDateTime($invoice->invoice_date)->format('Y/m/d') }}
                                            </div>

                                            <div class="card-body">
                                                @if($invoice->description)
                                                    <p><strong>توضیحات:</strong> {{ $invoice->description }}</p>
                                                @endif

                                                @if($invoice->attachments->count())
                                                    <div class="mb-3 rtl-text no-print">
                                                        <h3 class="font-bold text-lg mb-3 text-blue-600">پیوست‌های فاکتور</h3>

                                                        @foreach($invoice->attachments as $attachment)
                                                            @php
                                                                $path = asset('storage/' . $attachment->path);
                                                                $ext  = strtolower(pathinfo($attachment->path, PATHINFO_EXTENSION));
                                                            @endphp

                                                            @if(in_array($ext, ['jpg','jpeg','png','webp','gif']))
                                                                <img src="{{ $path }}"
                                                                     alt="پیوست فاکتور {{ $loop->iteration }}"
                                                                     class="img-fluid rounded border mb-3"
                                                                     style="max-height: 380px;">

                                                            @elseif($ext === 'pdf')
                                                                <div class="mb-3">
                                                                    <p class="text-sm text-muted mb-2">PDF پیوست {{ $loop->iteration }}</p>
                                                                    <iframe src="{{ $path }}" class="w-100 rounded border" style="height: 600px;"></iframe>
                                                                    <a href="{{ $path }}" target="_blank" class="text-primary mt-2 d-inline-block">
                                                                        باز کردن / دانلود PDF
                                                                    </a>
                                                                </div>

                                                            @elseif(in_array($ext, ['html','htm']))
                                                                <div class="mb-3">
                                                                    <p class="text-sm text-muted mb-2">HTML پیوست {{ $loop->iteration }}</p>
                                                                    <iframe
                                                                        src="{{ $path }}"
                                                                        class="w-100 rounded border"
                                                                        style="height: 600px;"
                                                                        sandbox="allow-same-origin allow-scripts allow-forms allow-popups"
                                                                    ></iframe>

                                                                    <a href="{{ $path }}" target="_blank" class="text-primary mt-2 d-inline-block">
                                                                        باز کردن HTML در تب جدید
                                                                    </a>
                                                                </div>

                                                            @else
                                                                <div class="mb-2">
                                                                    <a href="{{ $path }}" target="_blank" class="text-primary">
                                                                        دانلود فایل پیوست {{ $loop->iteration }} ({{ $ext }})
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">هیچ فاکتوری ثبت نشده است.</p>
                                    @endforelse
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal یادداشت‌ها --}}
                    <div class="modal fade" id="notesModal-{{ $customer->id }}" data-customer="{{ $customer->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">یادداشت‌های {{ $customer->name }} (شناسه: {{ $customer->display_customer_id }})</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body" dir="rtl">
                                    <ul class="list-group" id="notes-list-{{ $customer->id }}">
                                        @foreach($customer->notes as $note)
                                            <li class="list-group-item d-flex justify-content-between align-items-start" data-id="{{ $note->id }}">
                                                <div>
                                                    <span class="note-content">{{ $note->content }}</span>
                                                </div>

                                                <div>
                                                    @php $creator = $note->user; @endphp

                                                    @if($creator && $creator->hasRole('Admin'))
                                                        <span class="badge bg-primary ms-1">{{ $creator->name }}</span>
                                                    @elseif($creator && $creator->hasRole('Marketer'))
                                                        <span class="badge bg-warning text-dark ms-1">{{ $creator->name }}</span>
                                                    @else
                                                        <span class="badge bg-secondary ms-1">{{ $creator->name ?? '-' }}</span>
                                                    @endif

                                                    <small>{{ \Morilog\Jalali\Jalalian::fromDateTime($note->created_at)->format('Y/m/d H:i') }}</small>

                                                    @if($user->hasRole('Admin') || $user->hasRole('internalManager'))
                                                        <button class="btn btn-sm btn-danger delete-note">
                                                            <i class="bi bi-trash"></i> حذف
                                                        </button>
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="mt-3">
                                        <textarea class="form-control mb-2" placeholder="یادداشت جدید"></textarea>
                                        <button class="btn btn-success w-100 add-note">ثبت یادداشت</button>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

                {{-- صفحه‌بندی --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $customers->appends([
                        'search'    => request('search'),
                        'sort'      => request('sort'),
                        'note_from' => request('note_from'),
                        'note_to'   => request('note_to'),
                    ])->links('pagination::bootstrap-5') }}
                </div>

            </div>
        </div>
    </div>

<script>
    $(document).ready(function() {

        jalaliDatepicker.startWatch();
    });
</script>
    <script>
        $(document).ready(function () {
            if ($('#note_from').length) {
                $('#note_from, #note_to').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    initialValue: false,
                    autoClose: true
                });
            }
        });
    </script>

    {{-- Note Ajax --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            document.addEventListener('click', function(e){
                const modal = e.target.closest('.modal');

                // افزودن یادداشت
                if(e.target.classList.contains('add-note') && modal){
                    const customerId = modal.dataset.customer;
                    const textarea = modal.querySelector('textarea');
                    const content = textarea.value.trim();
                    if(!content) return alert('محتوا نمی‌تواند خالی باشد');

                    fetch(`/admin/customers/${customerId}/notes2`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({content})
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success){
                            const ul = modal.querySelector('ul.list-group');
                            const li = document.createElement('li');
                            li.className = 'list-group-item d-flex justify-content-between align-items-start';
                            li.dataset.id = data.note.id;

                            li.innerHTML = `
                                <div><span class="note-content">${data.note.content}</span></div>
                                <div>
                                    <span class="badge bg-primary ms-1">${data.note.creator}</span>
                                    <small class="text-muted ms-1">${data.note.created_at}</small>
                                    <button class="btn btn-sm btn-danger delete-note">حذف</button>
                                </div>
                            `;

                            ul.prepend(li);
                            textarea.value = '';
                        } else {
                            alert('ثبت یادداشت موفقیت‌آمیز نبود.');
                        }
                    }).catch(err => console.error(err));
                }

                // حذف یادداشت
                if (e.target.classList.contains('delete-note')) {
                    const li = e.target.closest('li[data-id]');
                    if (!li) return;

                    const noteId = li.dataset.id;
                    if (!confirm('آیا مطمئن هستید؟')) return;

                    e.target.disabled = true;

                    fetch(`/admin/customers/notes/${noteId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            li.remove();
                        } else {
                            alert('حذف یادداشت موفقیت‌آمیز نبود.');
                            e.target.disabled = false;
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        e.target.disabled = false;
                    });
                }
            });
        });
    </script>

</x-app-layout>
