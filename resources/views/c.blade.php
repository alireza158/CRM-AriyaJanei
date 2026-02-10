<x-app-layout>
<link rel="stylesheet" href="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.css"/>
<script src="https://static.neshan.org/sdk/leaflet/v1.9.4/neshan-sdk/v1.0.8/index.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            لیست ثبت‌شده‌ها
        </h2>
    </x-slot>

    <div class="container py-4">

       
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#accessModal">
    🔐 ورود کد دسترسی
</button>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle small">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>نام بازدیدکننده</th>
                        <th>شهر</th>
                        <th>فروشگاه</th>
                        <th>مالک</th>
                       
                        <th>نوع ارتباط</th>
                        <th>تمایل همکاری</th>
                        <th>تاریخ</th>
                        <th>جزئیات</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($contacts as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->visitor_name }}</td>
                        <td>{{ $c->city }}</td>
                        <td>{{ $c->shop_name }}</td>
                        <td>{{ $c->owner_name }}</td>
                      
                        <td>
                            <span class="badge {{ $c->relation_type=='مرتبط' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $c->relation_type }}
                            </span>
                        </td>
                        <td>{{ $c->cooperation_interest }}</td>
                        <td>{{ $c->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                          
                          >
                           
@if(session('allowed_visitor') === $c->visitor_name)
    <a href="{{ route('contacts.edit', $c->id) }}" class="btn btn-sm btn-warning">
        ویرایش
    </a>
@endif

                        
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $contacts->links() }}

    </div>

<!-- Modal -->
<div class="modal fade" id="contactModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">جزئیات بازدید</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="row mb-3">
            <div class="col-md-6"><strong>نام بازدیدکننده:</strong> <span id="m_name"></span></div>
            <div class="col-md-6"><strong>شهر:</strong> <span id="m_city"></span></div>
            <div class="col-md-6"><strong>فروشگاه:</strong> <span id="m_shop"></span></div>
            <div class="col-md-6"><strong>مالک:</strong> <span id="m_owner"></span></div>
            <div class="col-md-6"><strong>تلفن:</strong> <span id="m_phone"></span></div>
            <div class="col-12"><strong>آدرس:</strong> <span id="m_address"></span></div>

            {{-- ✅ توضیحات --}}
            <div class="col-12 mt-2">
              <strong>توضیحات:</strong> <span id="m_description" class="text-muted"></span>
            </div>
        </div>

        <hr>

        <div id="related-box" style="display:none">
            <h6 class="fw-bold mb-2">اطلاعات فروشگاه مرتبط</h6>

            <div class="row g-2">
                <div class="col-md-4"><strong>زمینه فعالیت:</strong> <span id="m_activity"></span></div>
                <div class="col-md-4"><strong>اندازه فروشگاه:</strong> <span id="m_size"></span></div>
                <div class="col-md-4"><strong>موقعیت:</strong> <span id="m_location"></span></div>

                <div class="col-md-6"><strong>گرید:</strong> <span id="m_grade"></span></div>
                <div class="col-md-3"><strong>مشتری آریا:</strong> <span id="m_arya"></span></div>
                <div class="col-md-3"><strong>پرداخت:</strong> <span id="m_payment"></span></div>

                <div class="col-12">
                    <strong>اجناس اصلی:</strong>
                    <ul id="m_main_goods" class="mb-0"></ul>
                </div>
            </div>
        </div>

        <div id="non-related-box" style="display:none">
            <h6 class="fw-bold mb-2">اطلاعات فروشگاه غیرمرتبط</h6>

            <div class="row g-2">
                <div class="col-md-6"><strong>زمینه فعالیت:</strong> <span id="m_nr_activity"></span></div>

                <div class="col-12">
                    <strong>اجناس:</strong>
                    <ul id="m_nr_goods" class="mb-0"></ul>
                </div>

                <div class="col-12">
                    <strong>توضیح اضافی:</strong> <span id="m_nr_other"></span>
                </div>
            </div>
        </div>

        <div id="modal-map" style="height:350px;border-radius:10px;border:1px solid #ddd"></div>

      </div>

    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">حذف رکورد</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p class="mb-0">
            آیا مطمئن هستید که می‌خواهید این رکورد را حذف کنید؟
            <br>
            <strong class="text-danger">این عملیات قابل بازگشت نیست.</strong>
        </p>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>

        <form id="delete-form" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">بله، حذف شود</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
(() => {

    const MAP_KEY = 'web.e5385054f3844638822482d4d6da3472';

    let map = null;
    let marker = null;

    document.querySelectorAll('.show-contact').forEach(btn => {

        btn.addEventListener('click', function () {

            document.getElementById('m_name').textContent   = this.dataset.name || '-';
            document.getElementById('m_city').textContent   = this.dataset.city || '-';
            document.getElementById('m_shop').textContent   = this.dataset.shop || '-';
            document.getElementById('m_owner').textContent  = this.dataset.owner || '-';
            document.getElementById('m_phone').textContent  = this.dataset.phone || '-';
            document.getElementById('m_address').textContent= this.dataset.address || '-';

            // ✅ توضیحات
            document.getElementById('m_description').textContent = this.dataset.description || '-';

            const relation = this.dataset.relation;

            document.getElementById('related-box').style.display = 'none';
            document.getElementById('non-related-box').style.display = 'none';

            if (relation === 'مرتبط') {
                document.getElementById('related-box').style.display = 'block';

                document.getElementById('m_activity').textContent  = this.dataset.activity || '-';
                document.getElementById('m_size').textContent      = this.dataset.size || '-';
                document.getElementById('m_location').textContent  = this.dataset.location || '-';
                document.getElementById('m_grade').textContent     = this.dataset.grade || '-';
                document.getElementById('m_arya').textContent      = this.dataset.arya || '-';
                document.getElementById('m_payment').textContent   = this.dataset.payment || '-';

                const goods = JSON.parse(this.dataset.main_goods || '[]');
                const ul = document.getElementById('m_main_goods');
                ul.innerHTML = '';
                goods.forEach(g => {
                    const li = document.createElement('li');
                    li.textContent = g;
                    ul.appendChild(li);
                });

            } else {
                document.getElementById('non-related-box').style.display = 'block';

                document.getElementById('m_nr_activity').textContent = this.dataset.nr_activity || '-';
                document.getElementById('m_nr_other').textContent    = this.dataset.nr_other || '-';

                const goods = JSON.parse(this.dataset.nr_goods || '[]');
                const ul = document.getElementById('m_nr_goods');
                ul.innerHTML = '';
                goods.forEach(g => {
                    const li = document.createElement('li');
                    li.textContent = g;
                    ul.appendChild(li);
                });
            }

            const lat = parseFloat(this.dataset.lat);
            const lng = parseFloat(this.dataset.lng);

            const modal = new bootstrap.Modal(document.getElementById('contactModal'));
            modal.show();

            setTimeout(() => {

                if (map) {
                    map.remove();
                    map = null;
                }

                if (!lat || !lng) {
                    document.getElementById('modal-map').innerHTML =
                        '<div class="text-muted text-center p-4">موقعیت ثبت نشده</div>';
                    return;
                }

                map = new L.Map('modal-map', {
                    key: MAP_KEY,
                    maptype: 'neshan',
                    poi: true,
                    traffic: false,
                    center: [lat, lng],
                    zoom: 16
                });

                marker = L.marker([lat, lng]).addTo(map);

            }, 300);

        });

    });

})();

// حذف رکورد
document.querySelectorAll('.delete-contact').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const form = document.getElementById('delete-form');
        form.action = `/admin/contacts/${id}`;
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    });
});
</script>
<div class="modal fade" id="accessModal">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="{{ route('admin.access.code') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">ورود کد دسترسی</h5>
      </div>

      <div class="modal-body">
        <input type="password" name="code" class="form-control" placeholder="کد را وارد کنید" required>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
        <button class="btn btn-success">تأیید</button>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="accessModal">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="{{ route('admin.access.code') }}" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title">ورود کد دسترسی</h5>
      </div>

      <div class="modal-body">
        <input type="password" name="code" class="form-control" placeholder="کد را وارد کنید" required>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
        <button class="btn btn-success">تأیید</button>
      </div>
    </form>
  </div>
</div>

</x-app-layout>
