<!doctype html>
<html lang="fa" dir="rtl">
  @php
  logger()->info('EMBED CREATE LOADED', [
    'url' => request()->fullUrl(),
    'referer' => request()->headers->get('referer'),
    'ua' => request()->userAgent(),
  ]);
@endphp

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  

  <!-- Select2 -->
<script src="{{ asset('lib/bootstrap.bundle.min.js') }}"></script>

  

<link rel="stylesheet" href="{{ asset('lib/select2.min.css') }}">

<link rel="stylesheet" href="{{ asset('lib/bootstrap.rtl.min.css') }}">
  <!-- Select2 -->

<script src="{{ asset('lib/jquery.min.js') }}"></script>
<script src="{{ asset('lib/select2.min.js') }}"></script>

 
  <title>ثبت سفارش</title>

  <style>
    :root{
      --brand: #0d6efd;
      --card-radius: 18px;
    }

    body{
      background: radial-gradient(1200px 600px at 80% -10%, rgba(13,110,253,.12), transparent 55%),
                  radial-gradient(900px 500px at 10% 0%, rgba(25,135,84,.10), transparent 55%),
                  #f6f8fb;
    }

    .page-shell{
      max-width: 980px;
      margin: 0 auto;
    }

    .topbar{
      background: linear-gradient(135deg, rgba(13,110,253,.12), rgba(13,110,253,.02));
      border: 1px solid rgba(13,110,253,.10);
      border-radius: var(--card-radius);
      padding: 18px 18px;
    }

    .card-soft{
      border: 1px solid rgba(0,0,0,.07);
      border-radius: var(--card-radius);
      box-shadow: 0 12px 30px rgba(16, 24, 40, .06);
      background: rgba(255,255,255,.85);
      backdrop-filter: blur(6px);
    }

    .section-title{
      font-weight: 800;
      letter-spacing: -.3px;
      margin-bottom: .75rem;
    }

    .hint{
      font-size: .85rem;
      color: #6c757d;
    }

    .form-control, .form-select{
      border-radius: 14px;
    }

    .btn{
      border-radius: 14px;
    }

    /* Select2 Bootstrap-ish */
    .select2-container--default .select2-selection--single{
      height: 42px;
      border-radius: 14px;
      border: 1px solid #dee2e6;
      display: flex;
      align-items: center;
      padding: 0 .5rem;
      background: #fff;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
      line-height: 42px;
      padding-right: .25rem;
      padding-left: 1.5rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
      height: 42px;
      right: .5rem;
    }
    .select2-dropdown{
      border-radius: 14px;
      border: 1px solid #dee2e6;
      overflow: hidden;
    }

    /* product row styling */
    .product-row{
      background: linear-gradient(180deg, #ffffff, #fbfcff);
      border: 1px solid rgba(0,0,0,.08);
      border-radius: 16px;
      padding: 14px;
    }

    .badge-soft{
      background: rgba(13,110,253,.10);
      color: #0d6efd;
      border: 1px solid rgba(13,110,253,.15);
      font-weight: 700;
    }

    .sticky-submit{
      
      bottom: 12px;
      z-index: 5;
    }

    .summary-box{
      border: 1px dashed rgba(13,110,253,.35);
      background: rgba(13,110,253,.05);
      border-radius: 16px;
      padding: 14px;
    }
    /* -------- Global Loader -------- */
.global-loader{
  position: fixed;
  inset: 0;
  background: rgba(246,248,251,.96);
  backdrop-filter: blur(6px);
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
}

.loader-card{
  background: #fff;
  border-radius: 22px;
  padding: 28px 34px;
  box-shadow: 0 25px 60px rgba(16,24,40,.15);
  text-align: center;
  min-width: 300px;
  max-width: 90vw;
}

.loader-card .spinner-border{
  width: 3rem;
  height: 3rem;
}

.loader-progress{
  height: 10px;
  border-radius: 999px;
  overflow: hidden;
}

.loader-progress .progress-bar{
  border-radius: 999px;
}

.hint{
  font-size: .85rem;
  color: #6c757d;
}

.row-head{
  border: 1px solid rgba(0,0,0,.08);
  border-radius: 16px;
  padding: 12px 14px;
  background: linear-gradient(180deg, #ffffff, #fbfcff);
  text-align: right;
}

.row-head:hover{
  box-shadow: 0 10px 24px rgba(16,24,40,.06);
}

.row-body{
  animation: fadeIn .15s ease-out;
}

.product-row.is-open .chev{
  transform: rotate(180deg);
}

.chev{
  transition: transform .15s ease;
  font-size: 18px;
  line-height: 1;
}

@keyframes fadeIn{
  from{ opacity: 0; transform: translateY(-4px); }
  to{ opacity: 1; transform: translateY(0); }
}

  </style>
</head>

<body class="py-4">
  <!-- Global Loader -->
<!-- Global Loader -->
<div id="globalLoader" class="global-loader">
  <div class="loader-card">
    <div class="spinner-border text-primary mb-3" role="status"></div>

    <div class="fw-bold mb-2">در حال بارگذاری محصولات…</div>

    <div class="progress mb-2 loader-progress">
      <div id="globalProgressBar"
           class="progress-bar progress-bar-striped progress-bar-animated"
           role="progressbar"
           style="width: 0%"></div>
    </div>

    <div class="d-flex justify-content-between">
      <small id="globalProgressText" class="hint">0%</small>
      <small id="globalProgressStatus" class="hint">در حال آماده‌سازی...</small>
    </div>
  </div>
</div>



  <div class="container page-shell">

    <!-- Header -->
    <div class="topbar mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle d-flex align-items-center justify-content-center"
             style="width:44px;height:44px;background:rgba(13,110,253,.12);border:1px solid rgba(13,110,253,.18);">
          <span class="fs-4">🧾</span>
        </div>
        <div>
          <div class="h5 mb-0 fw-bold">ثبت سفارش جدید</div>
          <div class="hint">اطلاعات مشتری، ارسال و محصولات را وارد کنید</div>
        </div>
      </div>
<a class="btn btn-success"
   href="{{ route('marketer.orders.embed.products.excel', ['token' => request('token')]) }}">
  ⬇️ خروجی اکسل محصولات
</a>

      <span class="badge badge-soft px-3 py-2">
        وضعیت پرداخت: در انتظار
      </span>
    </div>

    <!-- Messages -->
    @if(session('success'))
      <div class="alert alert-success border-0 shadow-sm rounded-4 fw-bold">
        ✅ {{ session('success') }}
      </div>
    @endif

    @if(session('error'))
      <div class="alert alert-danger border-0 shadow-sm rounded-4 fw-bold" style="white-space: pre-wrap">
        {!! session('error') !!}
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger border-0 shadow-sm rounded-4">
        <div class="fw-bold mb-2">⚠️ خطا در ارسال فرم:</div>
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Form -->
    <form action="{{ route('marketer.orders.embed.store', ['token' => request('token')]) }}" method="POST" id="orderForm">
      @csrf

      <!-- Customer card -->
      <div class="card-soft p-3 p-md-4 mb-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
          <div class="section-title mb-0">👤 اطلاعات مشتری</div>
          <small id="customer_status" class="hint"></small>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-semibold">شماره موبایل</label>
            <div class="input-group">
              <span class="input-group-text rounded-start-4">📱</span>
              <input type="text" name="customer_mobile" id="customer_mobile" class="form-control rounded-end-4" required>
            </div>
            <div class="hint mt-1">حداقل 10 رقم وارد کنید تا مشتری بررسی شود.</div>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">نام مشتری</label>
            <div class="input-group">
              <span class="input-group-text rounded-start-4">🪪</span>
              <input type="text" name="customer_name" id="customer_name" class="form-control rounded-end-4" required>
            </div>
          </div>
        </div>

        <input type="hidden" name="customer_id" id="customer_id">
      </div>

      <!-- Shipping card -->
      <div class="card-soft p-3 p-md-4 mb-4">
        <div class="section-title">🚚 ارسال و مقصد</div>

        <div class="row g-3 align-items-end">
          <div class="col-lg-6">
            <label class="form-label fw-semibold">شیوه ارسال</label>
            <select id="shipping_id" name="shipping_id" class="form-select" required>
              <option value="">انتخاب روش ارسال...</option>
              @foreach($shippings as $ship)
                @if($ship['name'] === 'پیک')
                  <option value="{{ $ship['id'] }}">پیک (فقط داخل گرگان)</option>
                @elseif($ship['name'] === 'ارسال فوری')
                  <option value="{{ $ship['id'] }}">ارسال فوری (فقط داخل استان گلستان)</option>
               @elseif(in_array($ship['name'], ['پس کرایه( تیپاکس - باربری )','تیپاکس','مراجعه حضوری برای دریافت']))
  <option value="{{ $ship['id'] }}">{{ $ship['name'] }}</option>
@endif

              @endforeach
            </select>
            <div class="hint mt-2" id="shipping_label">هزینه ارسال: ۰ تومان</div>
            <input type="hidden" id="shipping_price" name="shipping_price" value="0">
          </div>

          <div class="col-lg-6">
            <div class="summary-box">
              <div class="d-flex justify-content-between align-items-center">
                <div class="fw-bold">📦 روش ارسال</div>
              
              </div>
              <div class="hint mt-2">
                با انتخاب روش ارسال، استان/شهر به صورت خودکار محدود می‌شود (پیک: گرگان | فوری: گلستان | تحویل فروشگاه: ثابت).
              </div>
            </div>
          </div>
        </div>

        <!-- Province / City -->
        <div id="locationWrapper" class="row g-3 mt-2">
          <div class="col-md-6">
            <label class="form-label fw-semibold">استان</label>
            <select id="province_id" name="province_id" class="form-select" disabled>
              <option value="">ابتدا روش ارسال را انتخاب کنید</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label fw-semibold">شهر</label>
            <select id="city_id" name="city_id" class="form-select" disabled>
              <option value="">ابتدا استان را انتخاب کنید</option>
            </select>
          </div>
        </div>

        <!-- Address -->
        <div id="addressWrapper" class="mt-3">
          <label class="form-label fw-semibold">آدرس</label>
          <textarea
            id="customer_address"
            name="customer_address"
            class="form-control"
            rows="3"
            required
            placeholder="خیابان - کوچه - مجتمع - پلاک - کد پستی"
          ></textarea>
        </div>
      </div>

      <!-- Products card -->
      <div class="card-soft mb-4">
        <div class="p-3 p-md-4 border-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
          <div>
            <div class="section-title mb-1">🛍️ محصولات</div>
            <div class="hint">محصول/مدل را انتخاب کنید و تعداد را وارد کنید (موجودی کنترل می‌شود).</div>
          </div>
         
        </div>

    

         <div id="productRows"></div>

<div class="p-3 p-md-4 border-top d-flex justify-content-center fw-semibold">
  <button type="button" id="addRow" class="btn btn-primary" style="width:190px;height:50px;">
    ➕ افزودن محصول
  </button>
</div>


      <!-- Summary card -->
      <div class="card-soft p-3 p-md-4 mb-4">
        <div class="section-title">💳 جمع‌بندی</div>

        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label fw-semibold">تخفیف (تومان)</label>
            <input type="number" name="discount_amount" id="discount" class="form-control" value="0" readonly style="background-color: var(--bs-secondary-bg);">
          </div>

          <div class="col-md-4">
            <label class="form-label fw-semibold">هزینه ارسال</label>
            <input type="text" class="form-control" readonly value="با انتخاب شهر محاسبه می‌شود" style="background-color: var(--bs-secondary-bg);">
          </div>

          <div class="col-md-4">
            <label class="form-label fw-semibold">جمع کل (تومان)</label>
            <input type="text" name="total_price" id="total_price" class="form-control fw-bold" readonly style="background-color: var(--bs-secondary-bg);">
          </div>
        </div>

        <input type="hidden" name="payment_status" value="pending">
      </div>

      <!-- Sticky submit -->
      <div class="sticky-submit">
      <button type="submit"
        formaction="{{ route('crm.orders.draft.save') }}?token={{ request('token') }}"
        class="btn btn-warning w-100 fs-5 py-3 shadow-sm mb-2">
  💾 ذخیره پیش‌نویس (برای ادیت بعدی)
</button>

<button type="submit" class="btn btn-primary w-100 fs-5 py-3 shadow-sm">
  ✅ ثبت نهایی
</button>

        <div class="hint text-center mt-2">
          با ثبت سفارش، موجودی آیتم‌ها دوباره بررسی می‌شود.
        </div>
      </div>

    </form>
  </div>
</div>

<script>
const shippings = @json($shippings);

let areaProvinces = [];
let selectedShipping = null;

/* -------------------- Select2 helpers (Province/City) -------------------- */
function initLocationSelect2(selectEl, placeholder) {
  if (!window.jQuery || !window.jQuery.fn?.select2) return;

  const $el = $(selectEl);

  // اگر قبلاً select2 شده بود، destroy
  if ($el.hasClass('select2-hidden-accessible')) {
    $el.off('select2:select select2:clear'); // جلوگیری از دوبار bind شدن
    $el.select2('destroy');
  }

  $el.select2({
    width: '100%',
    dir: 'rtl',
    placeholder: placeholder,
    allowClear: true,
  });

  // خیلی مهم: event native که listener های معمولی هم بگیرن
  $el.on('select2:select select2:clear', function () {
    this.dispatchEvent(new Event('change', { bubbles: true }));
  });
}

function setSelectDisabled(selectEl, disabled) {
  selectEl.disabled = disabled;
  if (window.jQuery && $(selectEl).hasClass('select2-hidden-accessible')) {
    $(selectEl).prop('disabled', disabled).trigger('change.select2');
  }
}

/* -------------------- Area API -------------------- */
async function loadArea() {
  const res = await fetch('https://api.ariyajanebi.ir/v1/front/area?version=new2', {
    headers: { 'Accept': 'application/json' }
  });
  const data = await res.json();
  areaProvinces = data?.data?.provinces ?? [];
}

// پیدا کردن استان گلستان از داده‌ها (با اسم)
function getGolestanProvince() {
  return areaProvinces.find(p => (p.name ?? '').trim().includes('گلستان')) ?? null;
}

/* -------------------- Fill selects -------------------- */
function fillProvincesSelect(provincesToShow) {
  const provinceSelect = document.getElementById('province_id');
  provinceSelect.innerHTML = '<option value=""></option>'; // برای allowClear بهتره

  (provincesToShow ?? []).forEach(p => {
    const opt = document.createElement('option');
    opt.value = p.id;
    opt.textContent = (p.name ?? '').trim();
    provinceSelect.appendChild(opt);
  });

  // refresh select2
  initLocationSelect2(provinceSelect, 'انتخاب استان...');
}

function fillCities(citiesToShow) {
  const citySelect = document.getElementById('city_id');
  citySelect.innerHTML = '<option value=""></option>';

  (citiesToShow ?? []).forEach(c => {
    const opt = document.createElement('option');
    opt.value = c.id;
    opt.textContent = (c.name ?? '').trim();
    citySelect.appendChild(opt);
  });

  // enable/disable
  setSelectDisabled(citySelect, (citiesToShow ?? []).length === 0);

  // refresh select2
  initLocationSelect2(citySelect, 'انتخاب شهر...');
}

function fillCitiesByProvinceId(provinceId) {
  const province = areaProvinces.find(p => Number(p.id) === Number(provinceId));
  fillCities(province?.cities ?? []);
}

/* -------------------- Total (اگر نسخه‌ی جدیدت رو داری، این رو میتونی حذف کنی) -------------------- */
function updateTotal() {
  // اگر در اسکریپت محصولات، updateTotal رو بازنویسی کردی، این تابع رو حذف کن تا تداخل نشه.
  const discount = parseInt(document.getElementById('discount')?.value || 0);
  const shipping = parseInt(document.getElementById('shipping_price')?.value || 1000);

  let total = 0;
  document.querySelectorAll('.product-row').forEach(row => {
    const price = parseInt(row.querySelector('.price-field')?.value || 0);
    const quantity = parseInt(row.querySelector('.quantity-input')?.value || 1);
    total += price * quantity;
  });

  document.getElementById('total_price').value = Math.max(total + shipping - discount, 0);
}

/* -------------------- Shipping type helpers -------------------- */
function isFori(ship) {
  const n = (ship?.name ?? '').trim();
  return n.includes('ارسال فوری');
}
function isPeyk(ship) {
  const n = (ship?.name ?? '').trim();
  return n.includes('پیک');
}
function isShopDelivery(ship) {
  const n = (ship?.name ?? '').trim();
  return n.includes('مراجعه حضوری');
}

function setShopDeliveryMode(enable) {
  const locationWrapper = document.getElementById('locationWrapper');
  const addressWrapper = document.getElementById('addressWrapper');

  const provinceSelect = document.getElementById('province_id');
  const citySelect = document.getElementById('city_id');
  const addressEl = document.getElementById('customer_address');

  if (enable) {
    if (locationWrapper) locationWrapper.classList.add('d-none');
    if (addressWrapper) addressWrapper.classList.add('d-none');

    // مهم: disabled نکن! چون اگر disabled باشه ارسال نمیشه
    setSelectDisabled(provinceSelect, false);
    setSelectDisabled(citySelect, false);

    if (addressEl) addressEl.value = 'مراجعه حضوری برای دریافت';

  } else {
    if (locationWrapper) locationWrapper.classList.remove('d-none');
    if (addressWrapper) addressWrapper.classList.remove('d-none');
  }
}

/* -------------------- Main -------------------- */
document.addEventListener('DOMContentLoaded', async () => {
  const shippingSelect = document.getElementById('shipping_id');
  const provinceSelect = document.getElementById('province_id');
  const citySelect = document.getElementById('city_id');
  const shippingLabel = document.getElementById('shipping_label');

  // init select2 از اول (حتی اگر خالی/disabled باشند)
  initLocationSelect2(provinceSelect, 'انتخاب استان...');
  initLocationSelect2(citySelect, 'انتخاب شهر...');

  await loadArea();

  // انتخاب شیوه ارسال
  shippingSelect.addEventListener('change', (e) => {
    const sid = parseInt(e.target.value);
    selectedShipping = shippings.find(s => Number(s.id) === Number(sid)) ?? null;

    // ریست‌ها
    setSelectDisabled(provinceSelect, false);
    setSelectDisabled(citySelect, true);

    provinceSelect.innerHTML = '<option value=""></option>';
    citySelect.innerHTML = '<option value=""></option>';
    initLocationSelect2(provinceSelect, 'انتخاب استان...');
    initLocationSelect2(citySelect, 'انتخاب شهر...');

    // قیمت پایه ارسال
    let basePrice = selectedShipping?.default_price ?? 0;
    if (!basePrice || basePrice <= 0) basePrice = 1000;

    document.getElementById('shipping_price').value = basePrice;
    shippingLabel.textContent = `هزینه ارسال پایه: ${basePrice.toLocaleString()} تومان`;

    // ✅ تحویل درب فروشگاه
    if (isShopDelivery(selectedShipping)) {
      const golestan = getGolestanProvince();

      setShopDeliveryMode(true);

      if (golestan) {
        fillProvincesSelect([golestan]);
        provinceSelect.value = String(golestan.id);
        if (window.jQuery) $(provinceSelect).trigger('change.select2');

        const gorgan = (golestan.cities ?? []).find(c => (c.name ?? '').trim().includes('گرگان')) ?? null;

        if (gorgan) {
          fillCities([gorgan]);
          citySelect.value = String(gorgan.id);
          if (window.jQuery) $(citySelect).trigger('change.select2');
        } else {
          fillCities(golestan.cities ?? []);
          citySelect.value = '';
          if (window.jQuery) $(citySelect).trigger('change.select2');
        }
      } else {
        fillProvincesSelect(areaProvinces);
        provinceSelect.value = '';
        if (window.jQuery) $(provinceSelect).trigger('change.select2');
        fillCities([]);
        citySelect.value = '';
        if (window.jQuery) $(citySelect).trigger('change.select2');
      }

      document.getElementById('shipping_price').value = 0;
shippingLabel.textContent = `🏬 مراجعه حضوری برای دریافت — هزینه ارسال: ۰ تومان`;
      updateTotal();
      return; // ادامه قوانین اجرا نشود
    } else {
      setShopDeliveryMode(false);
    }

    // قوانین محدودیت‌ها
    const golestan = getGolestanProvince();

    // 1) ارسال فوری => فقط استان گلستان + شهرهای گلستان
    if (isFori(selectedShipping)) {
      if (!golestan) {
        fillProvincesSelect(areaProvinces);
      } else {
        fillProvincesSelect([golestan]);
        provinceSelect.value = String(golestan.id);
        if (window.jQuery) $(provinceSelect).trigger('change.select2');

        fillCities(golestan.cities ?? []);
        setSelectDisabled(citySelect, false);
      }
    }
    // 2) پیک => فقط استان گلستان و فقط شهر گرگان
    else if (isPeyk(selectedShipping)) {
      if (!golestan) {
        fillProvincesSelect(areaProvinces);
      } else {
        fillProvincesSelect([golestan]);
        provinceSelect.value = String(golestan.id);
        if (window.jQuery) $(provinceSelect).trigger('change.select2');

        const gorgan = (golestan.cities ?? []).find(c => (c.name ?? '').trim().includes('گرگان')) ?? null;
        if (gorgan) {
          fillCities([gorgan]);
          citySelect.value = String(gorgan.id);
          if (window.jQuery) $(citySelect).trigger('change.select2');

          // چون فقط یک شهر مجاز است
          setSelectDisabled(citySelect, true);
        } else {
          fillCities([]);
        }
      }
    }
    // حالت عادی => همه استان‌ها
    else {
      fillProvincesSelect(areaProvinces);
      setSelectDisabled(citySelect, true);
      citySelect.innerHTML = '<option value=""></option>';
      initLocationSelect2(citySelect, 'ابتدا استان را انتخاب کنید');
    }

    updateTotal();
  });

  // انتخاب استان
  provinceSelect.addEventListener('change', (e) => {
    if (isPeyk(selectedShipping)) return;

    const pid = e.target.value;
    if (!pid) {
      setSelectDisabled(citySelect, true);
      fillCities([]);
      return;
    }

    // ارسال فوری => شهرها همان گلستان
    if (isFori(selectedShipping)) {
      const golestan = getGolestanProvince();
      fillCities(golestan?.cities ?? []);
      setSelectDisabled(citySelect, false);
      return;
    }

    // حالت عادی
    fillCitiesByProvinceId(pid);
    setSelectDisabled(citySelect, false);
  });

  // انتخاب شهر (آپدیت قیمت/جمع)
  citySelect.addEventListener('change', (e) => {
    const cityName = e.target.selectedOptions[0]?.textContent?.trim() ?? '';

    let price = selectedShipping?.default_price ?? 0;
    if (!price || price <= 0) price = 1000;

    document.getElementById('shipping_price').value = price;
    shippingLabel.textContent = `📦 شهر: ${cityName} — هزینه ارسال: ${price.toLocaleString()} تومان`;
    updateTotal();
  });
});
</script>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const mobileInput = document.getElementById('customer_mobile');
    const nameInput = document.getElementById('customer_name');
    const statusEl = document.getElementById('customer_status');
    const hiddenId = document.getElementById('customer_id');
    let timer = null;

    // ✅ کمک‌کننده: قفل/آزاد کردن نام
    function lockName(lock) {
        nameInput.readOnly = lock;
        nameInput.classList.toggle('bg-light', lock); // اختیاری برای نمایش ظاهری
        nameInput.classList.toggle('cursor-not-allowed', lock); // اگر Tailwind داری
    }

    mobileInput.addEventListener('input', function () {
        const mobile = this.value.trim();
        clearTimeout(timer);

        if (mobile.length < 10) {
            nameInput.value = '';
            hiddenId.value = '';
            statusEl.textContent = '';
            lockName(false); // ✅ آزاد
            return;
        }

        timer = setTimeout(() => findCustomer(mobile), 600);
    });

    async function findCustomer(mobile) {
        statusEl.textContent = '🔎 در حال بررسی...';
        statusEl.className = 'text-muted';

        try {
            const res = await fetch(`{{ route('customers.find') }}?mobile=${mobile}`, {
                headers: { 'Accept': 'application/json' }
            });
            const data = await res.json();

            if (data.success && data.data) {
                nameInput.value = data.data.full_name;
                hiddenId.value = data.data.id;

                lockName(true); // ✅ قفل کن

                statusEl.textContent = '✅ مشتری یافت شد';
                statusEl.className = 'text-success';
            } else {
                nameInput.value = '';
                hiddenId.value = '';

                lockName(false); // ✅ آزاد کن

                statusEl.textContent = '⚠️ مشتری جدید';
                statusEl.className = 'text-warning';
            }
        } catch (error) {
            console.error('خطا در ارتباط با سرور:', error);

            lockName(false); // ✅ در خطا هم آزاد باشد

            statusEl.textContent = '❌ خطا در ارتباط با سرور';
            statusEl.className = 'text-danger';
        }
    }
});
</script>

<script>
let allProducts = [];
const productDetailsCache = new Map();
function hideGlobalLoader() {
  const loader = document.getElementById('globalLoader');
  if (!loader) return;

  loader.style.opacity = '0';
  loader.style.pointerEvents = 'none';

  setTimeout(() => {
    loader.remove();
  }, 300);
}

document.addEventListener('DOMContentLoaded', async () => {
  try {
    setGlobalProgress(0, 'شروع بارگذاری...');
    await loadAllProducts();
    setGlobalProgress(100, 'در حال آماده‌سازی فرم...');
    addProductRow();
    document.getElementById('addRow').addEventListener('click', addProductRow);
  } finally {
    hideGlobalLoader();
  }
});


/* -------------------- Helpers -------------------- */
function createEl(html) {
  const tmp = document.createElement('div');
  tmp.innerHTML = html.trim();
  return tmp.firstChild;
}

// فرمت قیمت: سه رقم جدا + تا 3 رقم اعشار (اگر وجود داشته باشد)
function formatPrice(val) {
  const n = Number(val);
  if (!Number.isFinite(n)) return '';
  return n.toLocaleString('fa-IR', {
    minimumFractionDigits: 0,
    maximumFractionDigits: 3,
  });
}

// خروجی فرمت‌شده رو برگردون به عدد خام
function unformatPrice(str) {
  if (str === null || str === undefined) return 0;
  // جداکننده‌های فارسی/انگلیسی را حذف کن
  const cleaned = String(str)
    .replaceAll(',', '')
    .replaceAll('٬', '')
    .replaceAll('،', '')
    .trim();
  const n = Number(cleaned);
  return Number.isFinite(n) ? n : 0;
}

/* -------------------- Duplicate rules -------------------- */
function getCurrentSelections(exceptRow = null) {
  const selections = {
    // محصولِ بدون مدل => فقط productId یکتا
    singleProducts: new Set(),
    // محصولِ مدل‌دار => productId => Set(varietyId)
    varietyMap: new Map(),
  };

  document.querySelectorAll('.product-row').forEach(row => {
    if (exceptRow && row === exceptRow) return;

    const pId = parseInt(row.querySelector('.product-select')?.value || 0);
    if (!pId) return;

    const vSel = row.querySelector('.variety-select');
    const vId = parseInt(vSel?.value || 0);

    // اگر variety-select disabled باشد یعنی «بدون مدل»
    const isSingle = !!vSel && vSel.disabled === true;

    if (isSingle) {
      selections.singleProducts.add(pId);
    } else {
      if (vId) {
        if (!selections.varietyMap.has(pId)) selections.varietyMap.set(pId, new Set());
        selections.varietyMap.get(pId).add(vId);
      }
    }
  });

  return selections;
}

function showRowWarning(row, msg) {
  let el = row.querySelector('.dup-warning');
  if (!el) {
    el = document.createElement('small');
    el.className = 'dup-warning text-danger d-block mt-2 fw-semibold';
    row.appendChild(el);
  }
  el.textContent = msg || '';
}

function clearRowWarning(row) {
  const el = row.querySelector('.dup-warning');
  if (el) el.textContent = '';
}

function refreshVarietyOptionLocks() {
  document.querySelectorAll('.product-row').forEach(row => {
    const pId = parseInt(row.querySelector('.product-select')?.value || 0);
    const vSel = row.querySelector('.variety-select');
    if (!pId || !vSel || vSel.disabled) return; // فقط برای محصول مدل‌دار

    const selections = getCurrentSelections(row);
    const usedSet = selections.varietyMap.get(pId) || new Set();

    Array.from(vSel.options).forEach(opt => {
      const vId = parseInt(opt.value || 0);
      if (!vId) return;

      if (usedSet.has(vId)) {
        opt.disabled = true;

        if (!opt.dataset.locked) {
          opt.textContent = `${opt.textContent} (قبلاً انتخاب شده)`;
          opt.dataset.locked = '1';
        }
      } else {
        opt.disabled = false;

        if (opt.dataset.locked) {
          opt.textContent = opt.textContent.replace(/\s*\(قبلاً انتخاب شده\)\s*$/, '');
          delete opt.dataset.locked;
        }
      }
    });
  });
}
function setGlobalProgress(percent, statusText) {
  const bar = document.getElementById('globalProgressBar');
  const txt = document.getElementById('globalProgressText');
  const st  = document.getElementById('globalProgressStatus');

  const p = Math.max(0, Math.min(100, Number(percent) || 0));

  if (bar) bar.style.width = `${p}%`;
  if (txt) txt.textContent = `${Math.round(p)}%`;
  if (st && statusText !== undefined) st.textContent = statusText;
}

/* -------------------- Load products -------------------- */
async function loadAllProducts() {
  setGlobalProgress(0, 'در حال بارگذاری لیست محصولات...');

  let page = 1;
  let lastPage = null;
  allProducts = [];

  while (true) {
    const res = await fetch(`https://api.ariyajanebi.ir/v1/front/products?page=${page}`, {
      headers: { 'Accept': 'application/json' }
    });
    const data = await res.json();

    const items = data?.data?.products?.data ?? [];
    const lp = data?.data?.products?.last_page ?? null;

    if (lastPage === null && lp) lastPage = lp;
    if (items.length) allProducts.push(...items);

    if (lastPage) {
      const percent = Math.min(100, Math.round((page / lastPage) * 100));
      setGlobalProgress(percent, `در حال دریافت صفحه ${page} از ${lastPage}...`);
    } else {
      setGlobalProgress(0, `در حال دریافت صفحه ${page}...`);
    }

    if (!lp || page >= lp || items.length === 0) break;
    page++;
  }

  setGlobalProgress(100, `✅ ${allProducts.length} محصول بارگذاری شد`);
}


/* -------------------- Rows -------------------- */
function addProductRow() {
  const container = document.getElementById('productRows');
  const index = container.children.length;

  const row = createEl(`
  <div class="product-row mb-3" data-row>
    <!-- Header (collapsed view) -->
    <button type="button" class="row-head w-100 d-flex justify-content-between align-items-center">
      <div class="d-flex flex-column text-start">
        <div class="fw-semibold">
          آیتم #${index + 1}
          <span class="head-title text-muted ms-2">—</span>
        </div>
        <small class="text-muted head-sub">برای ویرایش کلیک کنید</small>
      </div>

      <div class="d-flex align-items-center gap-2">
        <span class="badge bg-light text-dark head-qty">×0</span>
        <span class="badge bg-primary head-total">0</span>
        <span class="chev">▾</span>
      </div>
    </button>

    <!-- Body (expanded view) -->
    <div class="row-body mt-2" hidden>
      <div class="border rounded-3 p-3 bg-light">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div class="fw-semibold">جزئیات</div>
          <button type="button" class="btn btn-outline-danger btn-sm remove-row">حذف</button>
        </div>

        <div class="row g-2 align-items-end">
          <div class="col-md-5">
            <label class="form-label">محصول</label>
            <select name="products[${index}][id]" class="form-select form-select-sm product-select" required>
              <option value="">انتخاب محصول</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">مدل</label>
            <select name="products[${index}][variety_id]" class="form-select form-select-sm variety-select" required>
              <option value="">ابتدا محصول را انتخاب کنید</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">تعداد</label>
            <input type="number" name="products[${index}][quantity]" class="form-control form-control-sm quantity-input" min="0" value="0" required>
          </div>

          <div class="col-md-2">
            <label class="form-label">قیمت</label>
            <input type="text" class="form-control form-control-sm price-view" readonly>
            <input type="hidden" name="products[${index}][price]" class="price-raw" value="0">
            <div class="mt-1">
              <span class="badge bg-secondary stock-badge">—</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  `);

  container.appendChild(row);

  const productSelect = row.querySelector('.product-select');
  fillProductSelect(productSelect);
  initProductSelect2(productSelect);

  // حذف
  row.querySelector('.remove-row').addEventListener('click', () => {
    row.remove();
    updateTotal();
    refreshVarietyOptionLocks();
  });

  // باز/بسته کردن (single open)
  row.querySelector('.row-head').addEventListener('click', () => {
    openRow(row);
  });

  // بعد از اضافه شدن، همون ردیف باز بشه
  openRow(row);

  updateTotal();
}
function closeAllRows(except = null) {
  document.querySelectorAll('[data-row]').forEach(r => {
    if (except && r === except) return;
    r.classList.remove('is-open');
    const body = r.querySelector('.row-body');
    if (body) body.hidden = true;
  });
}

function openRow(row) {
  closeAllRows(row);
  row.classList.add('is-open');
  const body = row.querySelector('.row-body');
  if (body) body.hidden = false;
}

function updateRowHeader(row) {
  const pText = row.querySelector('.product-select')?.selectedOptions?.[0]?.textContent?.trim() || '';
  const vSel = row.querySelector('.variety-select');
  const vText = (vSel && !vSel.disabled)
    ? (vSel.selectedOptions?.[0]?.textContent?.trim() || '')
    : (vSel && vSel.disabled ? 'بدون مدل' : '');

  const qty = parseInt(row.querySelector('.quantity-input')?.value || 0) || 0;
  const price = parseFloat(row.querySelector('.price-raw')?.value || 0) || 0;
  const lineTotal = price * qty;

  row.querySelector('.head-title').textContent = pText ? pText : '—';
  row.querySelector('.head-sub').textContent = vText ? `مدل: ${vText}` : 'برای ویرایش کلیک کنید';
  row.querySelector('.head-qty').textContent = `×${qty}`;
  row.querySelector('.head-total').textContent = formatPrice(lineTotal);
}

function initProductSelect2(selectEl) {
  $(selectEl).select2({
    width: '100%',
    dir: 'rtl',
    placeholder: 'جستجوی محصول...',
    allowClear: true,
  });

  // ✅ مهم: Select2 -> Native change event (bubbles) برای اینکه document.addEventListener بگیره
  $(selectEl).on('select2:select select2:clear', function () {
    this.dispatchEvent(new Event('change', { bubbles: true }));
  });
}


function fillProductSelect(selectEl) {
  selectEl.innerHTML = '<option value="">انتخاب محصول</option>';
  allProducts.forEach(p => {
    const opt = document.createElement('option');
    opt.value = p.id;
    opt.textContent = `${p.title} (${formatPrice(p.price)} تومان)`;
    selectEl.appendChild(opt);
  });
}

function filterProducts(inputEl, selectEl) {
  const search = (inputEl.value || '').toLowerCase();
  selectEl.innerHTML = '<option value="">انتخاب محصول</option>';

  const filtered = allProducts.filter(p => (p.title ?? '').toLowerCase().includes(search));
  filtered.forEach(p => {
    const opt = document.createElement('option');
    opt.value = p.id;
    opt.textContent = `${p.title} (${formatPrice(p.price)} تومان)`;
    selectEl.appendChild(opt);
  });
}

/* -------------------- API Cache -------------------- */
async function getProductDetails(productId) {
  if (productDetailsCache.has(productId)) return productDetailsCache.get(productId);

  const res = await fetch(`https://api.ariyajanebi.ir/v1/front/products/${productId}`, {
    headers: { 'Accept': 'application/json' }
  });
  const data = await res.json();
  const product = data?.data?.product ?? null;

  productDetailsCache.set(productId, product);
  return product;
}

/* -------------------- Stock rules -------------------- */
function setStockUI(row, stockQty) {
  const qtyInput = row.querySelector('.quantity-input');
  const badge = row.querySelector('.stock-badge');

  const qty = Number.isFinite(Number(stockQty)) ? Number(stockQty) : 0;

  if (qty > 0) {
    qtyInput.disabled = false;
    qtyInput.min = '1';
    qtyInput.max = String(qty);

    const current = parseInt(qtyInput.value || '0');
    if (current < 1) qtyInput.value = '1';
    if (current > qty) qtyInput.value = String(qty);

    badge.className = 'badge bg-success stock-badge';
    badge.textContent = `موجودی: ${qty}`;
  } else {
    qtyInput.value = '0';
    qtyInput.min = '0';
    qtyInput.max = '0';
    qtyInput.disabled = true;

    badge.className = 'badge bg-danger stock-badge';
    badge.textContent = 'ناموجود';
  }
}

/* -------------------- Events -------------------- */
document.addEventListener('change', async (e) => {
  // انتخاب محصول
  if (e.target.classList.contains('product-select')) {
    const row = e.target.closest('.product-row');
    const productId = parseInt(e.target.value);
    const varietySelect = row.querySelector('.variety-select');

    const priceRaw = row.querySelector('.price-raw');
    const priceView = row.querySelector('.price-view');

    clearRowWarning(row);

    // reset
    varietySelect.innerHTML = '<option value="">در حال بارگذاری...</option>';
    varietySelect.disabled = true;

    priceRaw.value = '0';
    priceView.value = '';
    setStockUI(row, 0);
    updateTotal();
updateRowHeader(row);

    if (!productId) {
      varietySelect.innerHTML = '<option value="">ابتدا محصول را انتخاب کنید</option>';
      refreshVarietyOptionLocks();
      return;
    }

    try {
      const product = await getProductDetails(productId);
      if (!product) {
        varietySelect.innerHTML = '<option value="">خطا در دریافت محصول</option>';
        refreshVarietyOptionLocks();
        return;
      }

      const varieties = product.varieties ?? [];
      const selections = getCurrentSelections(row);

      // بدون مدل => محصول یکتا
      if (!varieties.length) {
        if (selections.singleProducts.has(productId)) {
          showRowWarning(row, '⚠️ این محصول قبلاً اضافه شده است.');
          e.target.value = '';
          varietySelect.innerHTML = '<option value="">ابتدا محصول را انتخاب کنید</option>';
          varietySelect.disabled = true;

          priceRaw.value = '0';
          priceView.value = '';
          setStockUI(row, 0);
          updateTotal();
          refreshVarietyOptionLocks();
          updateRowHeader(row);

          return;
        }

        varietySelect.innerHTML = `<option value="${product.id}" selected>بدون مدل</option>`;
        varietySelect.disabled = true;

        const price = product.price || 0;
        priceRaw.value = String(price);
        priceView.value = formatPrice(price);

        setStockUI(row, product.quantity ?? 0);
        updateTotal();
        refreshVarietyOptionLocks();
        updateRowHeader(row);

        return;
      }

      // با مدل
      varietySelect.innerHTML = '<option value="">انتخاب مدل...</option>';
      let autoSelectVarietyId = null;

      product.varieties.forEach(v => {
        const rawModelName =
          (v.attributes?.map(a => a.pivot?.value).join(' ').trim()) ||
          (v.unique_attributes_key?.trim()) ||
          `مدل ${v.id}`;

        const isC33a = String(rawModelName).trim().toLowerCase() === 'c33a';

        const opt = document.createElement('option');
        opt.value = v.id;
        opt.textContent = isC33a ? '-' : rawModelName;

        if (isC33a && autoSelectVarietyId === null) {
          autoSelectVarietyId = v.id;
          opt.selected = true;
        }

        varietySelect.appendChild(opt);
      });

      varietySelect.disabled = false;

      // قفل کردن مدل‌هایی که قبلاً انتخاب شده‌اند
      refreshVarietyOptionLocks();
updateRowHeader(row);

      // اگر c33a بود، خودکار انتخاب کن و change بزن
      if (autoSelectVarietyId !== null) {
        varietySelect.value = String(autoSelectVarietyId);
        varietySelect.dispatchEvent(new Event('change', { bubbles: true }));
      }

    } catch (err) {
      console.error(err);
      varietySelect.innerHTML = '<option value="">خطا در بارگذاری</option>';
      refreshVarietyOptionLocks();
    }
  }

  // انتخاب مدل
  if (e.target.classList.contains('variety-select')) {
    const row = e.target.closest('.product-row');
    const productId = parseInt(row.querySelector('.product-select').value);
    const varietyId = parseInt(e.target.value);

    const priceRaw = row.querySelector('.price-raw');
    const priceView = row.querySelector('.price-view');

    clearRowWarning(row);

    if (!productId || !varietyId) {
      refreshVarietyOptionLocks();
      return;
    }

    // جلوگیری از انتخاب مدل تکراری
    const selections = getCurrentSelections(row);
    const usedSet = selections.varietyMap.get(productId) || new Set();
updateRowHeader(row);

    if (usedSet.has(varietyId)) {
      showRowWarning(row, '⚠️ این مدل قبلاً انتخاب شده است.');
      e.target.value = '';
      priceRaw.value = '0';
      priceView.value = '';
      setStockUI(row, 0);
      updateTotal();
      refreshVarietyOptionLocks();
       updateRowHeader(row);
      return;
    }

    try {
      const product = await getProductDetails(productId);
      const variety = (product?.varieties ?? []).find(v => Number(v.id) === Number(varietyId));

      if (variety) {
        const price = variety.price || product.price || 0;

        // خام برای ارسال
        priceRaw.value = String(price);

        // فرمت برای نمایش
        priceView.value = formatPrice(price);

        setStockUI(row, variety.quantity ?? 0);
        updateTotal();
        refreshVarietyOptionLocks();
        updateRowHeader(row);

      }
    } catch (err) {
      console.error(err);
      refreshVarietyOptionLocks();
    }
  }
});

// تایپ تعداد
document.addEventListener('input', (e) => {
  if (e.target.classList.contains('quantity-input')) {
    const input = e.target;
    if (input.disabled) return;

    const row = input.closest('.product-row'); // ✅ این مهمه

    if (input.value === '') {
      updateTotal();
      updateRowHeader(row); // ✅
      return;
    }

    const min = parseInt(input.min || '1');
    const max = parseInt(input.max || '0');
    let val = parseInt(input.value);

    if (Number.isNaN(val)) return;

    if (max > 0 && val > max) val = max;
    if (val < min) val = min;

    input.value = String(val);

    updateTotal();
    updateRowHeader(row); // ✅
  }
});


document.addEventListener('blur', (e) => {
  if (e.target.classList.contains('quantity-input')) {
    const input = e.target;
    if (input.disabled) return;

    const row = input.closest('.product-row'); // ✅ این مهمه

    if (input.value === '') {
      input.value = input.min || '1';
    }

    updateTotal();
    updateRowHeader(row); // ✅
  }
}, true);


/* -------------------- Total -------------------- */
function updateTotal() {
  const discount = parseFloat(document.getElementById('discount')?.value || 0) || 0;
  const shipping = parseFloat(document.getElementById('shipping_price')?.value || 0) || 0;

  let total = 0;
  document.querySelectorAll('.product-row').forEach(row => {
    const price = parseFloat(row.querySelector('.price-raw')?.value || 0) || 0;
    const quantity = parseInt(row.querySelector('.quantity-input')?.value || 0) || 0;
    total += price * quantity;
  });

  const finalTotal = Math.max(total + shipping - discount, 0);

  // نمایش جمع کل به صورت فرمت شده (سه رقم + اعشار تا 3)
  document.getElementById('total_price').value = formatPrice(finalTotal);
}
</script>

<script>
(function () {
  function toEnglishDigits(str) {
    return String(str || '')
      .replace(/[۰-۹]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d))
      .replace(/[٠-٩]/g, d => '٠١٢٣٤٥٦٧٨٩'.indexOf(d));
  }

  function toInt(val) {
    const s = toEnglishDigits(val)
      .replaceAll(',', '')
      .replaceAll('٬', '')
      .replaceAll('،', '')
      .trim();
    const n = parseFloat(s);
    return Number.isFinite(n) ? Math.trunc(n) : 0;
  }

  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('orderForm');
    if (!form) return;

    form.addEventListener('submit', () => {
      // total_price -> int
      const totalEl = document.getElementById('total_price');
      if (totalEl) totalEl.value = String(toInt(totalEl.value));

      // shipping_price -> int
      const shipEl = document.getElementById('shipping_price');
      if (shipEl) shipEl.value = String(toInt(shipEl.value));

      // discount -> int (اگر می‌خوای)
      const discEl = document.getElementById('discount');
      if (discEl) discEl.value = String(toInt(discEl.value));

      // قیمت‌های محصولات -> int (اگر price-raw دارید)
      document.querySelectorAll('.price-raw').forEach(el => {
        el.value = String(toInt(el.value));
      });

      // تعدادها -> int
      document.querySelectorAll('.quantity-input').forEach(el => {
        el.value = String(toInt(el.value));
      });
    }, { capture: true });
  });
})();
</script>
<script>
(function () {
  function showRowError(row, msg) {
    let el = row.querySelector('.stock-error');
    if (!el) {
      el = document.createElement('div');
      el.className = 'stock-error alert alert-danger py-2 mt-2 mb-0';
      row.appendChild(el);
    }
    el.textContent = msg;
  }

  function clearRowError(row) {
    const el = row.querySelector('.stock-error');
    if (el) el.remove();
  }

  function isOutOfStockRow(row) {
    const productId = row.querySelector('.product-select')?.value;
    if (!productId) return false; // اگر محصول انتخاب نشده، اینجا کاری نداریم (required خودش می‌گیرد)

    const qtyInput = row.querySelector('.quantity-input');
    const badge = row.querySelector('.stock-badge');

    // اگر ناموجود باشد در setStockUI شما qtyInput.disabled = true و badge "ناموجود"
    const disabled = !!qtyInput?.disabled;
    const badgeText = (badge?.textContent || '').trim();

    // شرط قوی‌تر: هم disabled باشد هم badge ناموجود
    return disabled && (badgeText.includes('ناموجود') || badgeText === 'ناموجود');
  }

  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('orderForm');
    if (!form) return;

    form.addEventListener('submit', (e) => {
      let hasError = false;
      let firstBadRow = null;

      document.querySelectorAll('.product-row').forEach(row => {
        clearRowError(row);

        if (isOutOfStockRow(row)) {
          hasError = true;
          if (!firstBadRow) firstBadRow = row;

          showRowError(row, '❌ این کالا/مدل ناموجود است. لطفاً گزینه دیگری انتخاب کنید.');
        }
      });

      if (hasError) {
        e.preventDefault();
        e.stopPropagation();

        // اسکرول به اولین ردیف مشکل‌دار
        firstBadRow?.scrollIntoView({ behavior: 'smooth', block: 'center' });

        // یک هشدار کلی هم می‌تونی اضافه کنی (اختیاری)
        // alert('برخی آیتم‌ها ناموجود هستند و امکان ثبت سفارش وجود ندارد.');
      }
    }, { capture: true });
  });
})();
</script>


{{-- اینجا اسکریپت محصولات/مشتری‌ت را هم پایین همین صفحه بگذار (مثل قبل) --}}

</body>
</html>
