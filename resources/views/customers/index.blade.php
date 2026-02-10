<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">مدیریت مشتریان</h2>
    </x-slot>

    <div class="container mt-4">

        {{-- پیام موفقیت --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- فرم جستجو --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.customersAdmin.index') }}" class="row g-2 align-items-center">
                    <div class="col-md-4">
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="جستجو نام یا شماره" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary w-100"><i class="bi bi-search"></i> جستجو</button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.customersCreate.create') }}" class="btn btn-success w-100">
                            <i class="bi bi-plus-circle"></i> مشتری جدید
                        </a>
                    </div>
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
                                <th>نام</th>
                                <th>شماره</th>
                                <th>بازاریاب</th>
                                <th>آدرس</th>
                                <th>نحوه آشنایی</th>
                                <th>یادداشت‌ها</th>
                                <th>ارتباط</th> <!-- ستون جدید -->
                                <th>عملیات</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->marketer?->name ?? '-' }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->referenceType?->name ?? '-' }}</td>

                                    <td>
                                        <!-- دکمه مشاهده یادداشت‌ها -->
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#notesModal-{{ $customer->id }}">
                                            مشاهده یادداشت‌ها
                                        </button>
                                        <td>
                                            @if($customer->phone)
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                                        ارتباط
                                                    </button>
                                                    <ul class="dropdown-menu">

                                                        <!-- واتساپ -->
                                                        <li>
                                                            <a class="dropdown-item" href="https://wa.me/{{ preg_replace('/^0/', '98', $customer->phone) }}" target="_blank">
                                                                <i class="bi bi-whatsapp text-success"></i> واتساپ
                                                            </a>
                                                        </li>

                                                        <!-- پیامک -->
                                                        <li>
                                                            <a class="dropdown-item" href="sms:{{ $customer->phone }}">
                                                                <i class="bi bi-chat-dots text-primary"></i> پیامک
                                                            </a>
                                                        </li>

                                                        <!-- تماس -->
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
                                        </td>

                                        <!-- Modal یادداشت‌ها -->
                                        <div class="modal fade" id="notesModal-{{ $customer->id }}" data-customer="{{ $customer->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title">یادداشت‌های {{ $customer->name }}</h5>
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
                                                                        @if($note->user_id == 1)
                                                                        <span class="badge bg-primary ms-1">ادمین</span>
                                                                    @else
                                                                        <span class="badge bg-warning text-dark ms-1" style="color: rgb(255, 255, 255) !important;">بازاریاب</span>
                                                                    @endif
                                                               <small>{{ \Morilog\Jalali\Jalalian::fromDateTime($note->created_at)->format('Y/m/d H:i') }}</small>


                                                                        <button class="btn btn-sm btn-danger delete-note">
                                                                            <i class="bi bi-trash"></i> حذف</button>
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
                                    </td>

                                   <!-- تو <head> اضافه کن -->




                                    {{-- عملیات --}}
                                    <td>

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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-muted">هیچ مشتری یافت نشد.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- صفحه‌بندی --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $customers->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<link rel="stylesheet" href="{{ asset('lib/bootstrap-icons.css') }}">

<!-- Bootstrap CSS -->

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

            fetch(`/admin/customers/${customerId}/notes`, {
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
                    li.className = 'list-group-item d-flex justify-content-between';
                    li.dataset.id = data.note.id;
                    li.innerHTML = `
                        <span class="note-content">${data.note.content}</span>
                        <div>
                            <span class="badge bg-primary ms-1">ادمین</span>
                           ${data.note.created_at}</small>

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
      // حذف یادداشت
if (e.target.classList.contains('delete-note')) {
    const li = e.target.closest('li[data-id]');
    if (!li) return;
    const noteId = li.dataset.id;
    if (!confirm('آیا مطمئن هستید؟')) return;

    e.target.disabled = true; // optional: prevent double click

    fetch(`/admin/customers/notes/${noteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'application/json' // make sure Laravel returns JSON
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            li.remove(); // حذف عنصر از DOM
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
