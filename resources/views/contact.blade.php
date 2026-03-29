<!doctype html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>آریا جانبی</title>

  <link rel="stylesheet" href="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.css">
  <script src="https://static.neshan.org/sdk/leaflet/1.4.0/leaflet.js"></script>
  <script src="https://static.neshan.org/sdk/leaflet/1.4.0/neshan-leaflet.js"></script>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

  <style>
    body{background:#f7f7fb}
    .req-star{color:#dc3545}
    body{
      margin:0;
      font-family:"Kalameh", Tahoma, sans-serif;
      color:#1b1b1f;
      line-height:1.9;
      direction:rtl;
      text-align:right;
    }
    @font-face {
      font-family: "Kalameh";
      src: url("/fonts/KalamehFaNum-Bold.ttf") format("truetype");
      font-weight: 700;
      font-style: normal;
      font-display: swap;
    }
    #map{
      height: 420px;
      border-radius: 14px;
      overflow: hidden;
      border: 1px solid #e6e6ef;
    }
  </style>
</head>

<body>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-9">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">

          <div class="text-center mb-3">
            <a href="https://ariyajanebi.ir" target="_blank"
               class="d-inline-flex align-items-center gap-2 text-decoration-none text-dark">
              <img src="{{ asset('images/logo.png') }}" alt="آریا جانبی" style="height:48px;width:auto">
              <h4 class="mb-0">آریا جانبی</h4>
            </a>
          </div>

          {{-- نمایش کد/نام بازدیدکننده از URL --}}
          <div class="alert alert-secondary py-2">
            <span class="fw-bold">بازدیدکننده:</span>
            <span>{{ $visitor }}</span>
          </div>

          @if ($errors->has('form'))
            <div class="alert alert-danger">{{ $errors->first('form') }}</div>
          @endif

          @if ($errors->any())
            <div class="alert alert-danger">
              <div class="fw-bold mb-2">لطفاً این موارد را تکمیل کنید:</div>
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          @if (session('ok'))
            <div class="alert alert-success">ثبت شد ✅</div>
          @endif

          <form method="POST" action="{{ route('contact.submit', ['visitor' => $visitor]) }}" class="needs-validation" novalidate>
            @csrf

            {{-- visitor_name از URL میاد (در submit استفاده میشه) --}}
            {{-- نیازی به input نیست، اما اگر خواستی برای دیباگ داشته باشی میتونی hidden بذاری --}}
            {{-- <input type="hidden" name="visitor_name" value="{{ $visitor }}"> --}}

            <div class="mb-3">
              <label class="form-label">شهر <span class="req-star">*</span></label>
              <input type="text" name="city"
                     class="form-control @error('city') is-invalid @enderror"
                     value="{{ old('city') }}" maxlength="60" required>
              @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
              <label class="form-label d-block">نوع ارتباط <span class="req-star">*</span></label>

              <div class="d-flex gap-4 flex-wrap">
                <div class="form-check">
                  <input class="form-check-input @error('relation_type') is-invalid @enderror"
                         type="radio" name="relation_type" id="rel1" value="مرتبط"
                         {{ old('relation_type') === 'مرتبط' ? 'checked' : '' }} required>
                  <label class="form-check-label" for="rel1">مرتبط</label>
                </div>

                <div class="form-check">
                  <input class="form-check-input @error('relation_type') is-invalid @enderror"
                         type="radio" name="relation_type" id="rel2" value="غیر مرتبط"
                         {{ old('relation_type') === 'غیر مرتبط' ? 'checked' : '' }} required>
                  <label class="form-check-label" for="rel2">غیر مرتبط</label>
                </div>
              </div>

              @error('relation_type') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

              <div class="alert alert-info mt-3 mb-0" id="relation-help">
                لطفا نوع ارتباط را انتخاب کنید.
              </div>
            </div>

            <hr class="my-4">

            <div class="mb-3">
              <label class="form-label">آدرس <span class="req-star">*</span></label>
              <input type="text" name="address" id="address"
                     class="form-control @error('address') is-invalid @enderror"
                     value="{{ old('address') }}" maxlength="200" required>
              @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror

              <div class="row g-2 mt-2">
                <div class="col-12 col-md-8">
                  <button type="button" class="btn btn-outline-secondary w-100" id="myLocationBtn">
                    لوکیشن من (GPS)
                  </button>
                  <div class="small text-muted mt-1" id="geoStatus"></div>
                </div>
                <div class="col-12 col-md-4 d-flex align-items-center">
                  <div class="small text-muted" id="latlng-preview"></div>
                </div>
              </div>

              <div class="mb-2 info mt-3">
                روی نقشه کلیک کنید تا موقعیت فروشگاه ثبت شود
                <div id="preview" class="small text-muted mt-1"></div>
              </div>

              <div id="map" class="mb-3"></div>

              <input type="hidden" name="lat" id="lat" value="{{ old('lat') }}">
              <input type="hidden" name="lng" id="lng" value="{{ old('lng') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">نام فروشگاه (تابلو فروشگاه) <span class="req-star">*</span></label>
              <input type="text" name="shop_name"
                     class="form-control @error('shop_name') is-invalid @enderror"
                     value="{{ old('shop_name') }}" maxlength="120" required>
              @error('shop_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">نام مالک <span class="req-star">*</span></label>
              <input type="text" name="owner_name"
                     class="form-control @error('owner_name') is-invalid @enderror"
                     value="{{ old('owner_name') }}" maxlength="120" required>
              @error('owner_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
              <label class="form-label">شماره تماس مالک فروشگاه (تصمیم گیرنده) <span class="req-star">*</span></label>
              <input type="text" name="owner_phone"
                     class="form-control @error('owner_phone') is-invalid @enderror"
                     value="{{ old('owner_phone') }}" maxlength="30" inputmode="tel" dir="ltr" required>
              @error('owner_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
              <div class="form-text">مثال: 0912xxxxxxx</div>
            </div>

            {{-- سکشن مرتبط --}}
            <div id="section-related" style="display:none;">

              <div class="mb-3">
                <label class="form-label">زمینه فعالیت <span class="req-star">*</span></label>
                <select name="activity_field" class="form-select @error('activity_field') is-invalid @enderror">
                  <option value="" disabled {{ old('activity_field') ? '' : 'selected' }}>انتخاب</option>
                  @foreach (['موبایل + جانبی','فقط جانبی','تعمیرات + جانبی','ترکیبی'] as $opt)
                    <option value="{{ $opt }}" {{ old('activity_field')===$opt ? 'selected' : '' }}>{{ $opt }}</option>
                  @endforeach
                </select>
                @error('activity_field') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">اندازه فروشگاه <span class="req-star">*</span></label>
                <select name="shop_size" class="form-select @error('shop_size') is-invalid @enderror">
                  <option value="" disabled {{ old('shop_size') ? '' : 'selected' }}>انتخاب</option>
                  @foreach (['کمتر از 15 متر','بین 15 تا 30 متر','بیشتر از 30 متر'] as $opt)
                    <option value="{{ $opt }}" {{ old('shop_size')===$opt ? 'selected' : '' }}>{{ $opt }}</option>
                  @endforeach
                </select>
                @error('shop_size') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">موقعیت فروشگاه <span class="req-star">*</span></label>
                <select name="shop_location" class="form-select @error('shop_location') is-invalid @enderror">
                  <option value="" disabled {{ old('shop_location') ? '' : 'selected' }}>انتخاب</option>
                  @foreach (['مسیر خیابان اصلی','همکف پاساژ','طبقات پاساژ','کوچه فرعی'] as $opt)
                    <option value="{{ $opt }}" {{ old('shop_location')===$opt ? 'selected' : '' }}>{{ $opt }}</option>
                  @endforeach
                </select>
                @error('shop_location') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-4">
                <label class="form-label d-block">گِرید فروشگاه <span class="req-star">*</span></label>
                @php
                  $grades = [
                    'A - خرید عمده/فروشگاه بزرگ/فروش پرچمدار',
                    'B - ویترین متوسط / فروش میان رده',
                    'C - حجم خرید کم/ تعمیرکار/ فروش پایین رده',
                  ];
                @endphp
                <div class="d-flex gap-4 flex-wrap">
                  @foreach ($grades as $i => $g)
                    <div class="form-check">
                      <input class="form-check-input @error('shop_grade') is-invalid @enderror"
                             type="radio" name="shop_grade" id="grade{{ $i }}" value="{{ $g }}"
                             {{ old('shop_grade')===$g ? 'checked' : '' }}>
                      <label class="form-check-label" for="grade{{ $i }}">{{ $g }}</label>
                    </div>
                  @endforeach
                </div>
                @error('shop_grade') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
              </div>

              <div class="mb-4">
                <label class="form-label d-block">اجناس اصلی (میتونید چندین گزینه را انتخاب کنید)</label>
                @php
                  $goods = [
                    'گارد','گلس','هولدر','کابل + AUX','تبدیل','پاوربانک','فندکی','هدفون',
                    'سرشارژر + شارژر','ایرپاد + هدفون','واچ + بند','اسپیکر',
                    'کاور ایرپاد+ کاور سرشارژر','جاکلیدی','گجت','رینگ لایت','هندزفری','موبایل'
                  ];
                  $oldGoods = old('main_goods', []);
                  if (!is_array($oldGoods)) $oldGoods = [];
                @endphp

                <div class="row g-2">
                  @foreach ($goods as $idx => $item)
                    <div class="col-6 col-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="main_goods[]"
                               id="good{{ $idx }}" value="{{ $item }}"
                               {{ in_array($item, $oldGoods, true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="good{{ $idx }}">{{ $item }}</label>
                      </div>
                    </div>
                  @endforeach
                </div>
                @error('main_goods') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
              </div>

              <div class="mb-4">
                <label class="form-label d-block">مشتری آریا <span class="req-star">*</span></label>
                <div class="d-flex gap-4 flex-wrap">
                  @foreach (['است','نیست'] as $i => $opt)
                    <div class="form-check">
                      <input class="form-check-input @error('arya_customer') is-invalid @enderror"
                             type="radio" name="arya_customer" id="arya{{ $i }}" value="{{ $opt }}"
                             {{ old('arya_customer')===$opt ? 'checked' : '' }}>
                      <label class="form-check-label" for="arya{{ $i }}">{{ $opt }}</label>
                    </div>
                  @endforeach
                </div>
                @error('arya_customer') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
              </div>

              <div class="mb-4">
                <label class="form-label d-block">شرایط پرداخت <span class="req-star">*</span></label>
                <div class="d-flex gap-4 flex-wrap">
                  @foreach (['نقدی','چکی'] as $i => $opt)
                    <div class="form-check">
                      <input class="form-check-input @error('payment_terms') is-invalid @enderror"
                             type="radio" name="payment_terms" id="pay{{ $i }}" value="{{ $opt }}"
                             {{ old('payment_terms')===$opt ? 'checked' : '' }}>
                      <label class="form-check-label" for="pay{{ $i }}">{{ $opt }}</label>
                    </div>
                  @endforeach
                </div>
                @error('payment_terms') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
              </div>

            </div>

            {{-- سکشن غیرمرتبط --}}
            <div id="section-nonrelated" style="display:none;">

              <div class="mb-3">
                <label class="form-label">زمینه فعالیت - غیر مرتبط <span class="req-star">*</span></label>
                <select name="nr_activity" id="nr_activity" class="form-select @error('nr_activity') is-invalid @enderror">
                  <option value="" disabled {{ old('nr_activity') ? '' : 'selected' }}>انتخاب</option>
                  @foreach (['لوازم رایانه (کامپیوتر)','سوپرمارکت','تزیینات خودرو','لوازم برقی','غیره'] as $opt)
                    <option value="{{ $opt }}" {{ old('nr_activity')===$opt ? 'selected' : '' }}>{{ $opt }}</option>
                  @endforeach
                </select>
                @error('nr_activity') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3" id="nr_activity_other_wrap" style="display:none;">
                <label class="form-label">غیره: (نام شغل) <span class="req-star">*</span></label>
                <input type="text" name="nr_activity_other" id="nr_activity_other"
                       class="form-control @error('nr_activity_other') is-invalid @enderror"
                       value="{{ old('nr_activity_other') }}" maxlength="120">
                @error('nr_activity_other') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label class="form-label d-block">اجناس - غیر مرتبط <span class="req-star">*</span></label>

                @php
                  $nrGoods = ['کابل','شارژر','گارد','اجناس تزیینی','AUX','هندزفری','غیره'];
                  $oldNrGoods = old('nr_goods', []);
                  if (!is_array($oldNrGoods)) $oldNrGoods = [];
                @endphp

                <div class="row g-2">
                  @foreach ($nrGoods as $i => $g)
                    <div class="col-6 col-md-4">
                      <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox" name="nr_goods[]"
                               id="nrgood{{ $i }}" value="{{ $g }}"
                               {{ in_array($g, $oldNrGoods, true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="nrgood{{ $i }}">{{ $g }}</label>
                      </div>
                    </div>
                  @endforeach
                </div>

                @error('nr_goods') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
              </div>

              <div class="mb-4" id="nr_goods_other_wrap" style="display:none;">
                <label class="form-label">غیره: (نام اجناس) <span class="req-star">*</span></label>
                <input type="text" name="nr_goods_other" id="nr_goods_other"
                       class="form-control @error('nr_goods_other') is-invalid @enderror"
                       value="{{ old('nr_goods_other') }}" maxlength="200">
                @error('nr_goods_other') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

            </div>

            <div class="mb-4">
              <label class="form-label d-block">تمایل به همکاری <span class="req-star">*</span></label>
              <div class="d-flex gap-4 flex-wrap">
                @foreach (['دارد','ندارد','نیاز به مذاکره دارد'] as $i => $opt)
                  <div class="form-check">
                    <input class="form-check-input @error('cooperation_interest') is-invalid @enderror"
                           type="radio" name="cooperation_interest" id="coop{{ $i }}" value="{{ $opt }}"
                           {{ old('cooperation_interest')===$opt ? 'checked' : '' }} required>
                    <label class="form-check-label" for="coop{{ $i }}">{{ $opt }}</label>
                  </div>
                @endforeach
              </div>
              @error('cooperation_interest') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
<div class="mb-4">
  <label class="form-label">توضیحات (اختیاری)</label>
  <textarea name="description"
            class="form-control @error('description') is-invalid @enderror"
            rows="3"
            maxlength="2000"
            placeholder="اگر توضیح اضافه‌ای لازم بود اینجا بنویسید...">{{ old('description') }}</textarea>
  @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

            <button type="submit" class="btn btn-primary w-100">ارسال</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<!-- Loading Modal -->
<div class="modal fade" id="sendingModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-body text-center p-4">
        <div class="spinner-border" role="status" aria-hidden="true"></div>
        <div class="mt-3 fw-bold">در حال ارسال اطلاعات...</div>
        <div class="text-muted small mt-1">لطفاً چند لحظه صبر کنید</div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS (برای modal و validation) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
(() => {
  'use strict';

  // -----------------------
  // 1) نمایش سکشن‌ها (مرتبط/غیرمرتبط)
  // -----------------------
  const rel1 = document.getElementById('rel1');
  const rel2 = document.getElementById('rel2');
  const related = document.getElementById('section-related');
  const nonrelated = document.getElementById('section-nonrelated');
  const relationHelp = document.getElementById('relation-help');

  function getMode() {
    if (rel1 && rel1.checked) return 'related';
    if (rel2 && rel2.checked) return 'nonrelated';
    return 'none';
  }

  function disableAll(sectionEl, disabled) {
    if (!sectionEl) return;
    sectionEl.querySelectorAll('input,select,textarea').forEach(el => {
      el.disabled = disabled;
      if (disabled) el.required = false;
    });
  }

  function setSection(mode) {
    if (mode === 'related') {
      relationHelp.textContent =
        'لطفا در این قسمت اطلاعات مشاغلی که به صورت مستقیم با فروش موبایل و لوازم جانبی در ارتباط هستند را وارد کنید.';

      related.style.display = '';
      nonrelated.style.display = 'none';

      disableAll(related, false);
      disableAll(nonrelated, true);

      ['activity_field','shop_size','shop_location'].forEach(name => {
        const el = document.querySelector(`[name="${name}"]`);
        if (el) el.required = true;
      });

    } else if (mode === 'nonrelated') {
      relationHelp.textContent =
        'لطفا در این قسمت اطلاعات مشاغلی که به صورت غیر مستقیم با فروش موبایل و لوازم جانبی در ارتباط هستند را وارد کنید.';

      related.style.display = 'none';
      nonrelated.style.display = '';

      disableAll(related, true);
      disableAll(nonrelated, false);

      ['nr_activity'].forEach(name => {
        const el = document.querySelector(`[name="${name}"]`);
        if (el) el.required = true;
      });

      syncNrActivityOther();
      syncNrGoodsOther();

    } else {
      relationHelp.textContent = 'لطفا نوع ارتباط را انتخاب کنید.';
      related.style.display = 'none';
      nonrelated.style.display = 'none';
      disableAll(related, true);
      disableAll(nonrelated, true);
    }
  }

  [rel1, rel2].forEach(r => r && r.addEventListener('change', () => setSection(getMode())));
  setSection(getMode());

  // -----------------------
  // 2) غیرمرتبط: گزینه "غیره"
  // -----------------------
  const nrActivity = document.getElementById('nr_activity');
  const nrActivityOtherWrap = document.getElementById('nr_activity_other_wrap');
  const nrActivityOther = document.getElementById('nr_activity_other');

  const nrGoodsOtherWrap = document.getElementById('nr_goods_other_wrap');
  const nrGoodsOther = document.getElementById('nr_goods_other');

  function syncNrActivityOther() {
    if (!nrActivity || nrActivity.disabled) return;
    const isOther = (nrActivity.value === 'غیره');

    if (nrActivityOtherWrap && nrActivityOther) {
      nrActivityOtherWrap.style.display = isOther ? '' : 'none';
      nrActivityOther.required = isOther;
      if (!isOther) nrActivityOther.value = '';
    }
  }

  function syncNrGoodsOther() {
    if (nrGoodsOther && nrGoodsOther.disabled) return;
    const checked = Array.from(document.querySelectorAll('input[name="nr_goods[]"]:checked'))
      .some(el => el.value === 'غیره');

    if (nrGoodsOtherWrap && nrGoodsOther) {
      nrGoodsOtherWrap.style.display = checked ? '' : 'none';
      nrGoodsOther.required = checked;
      if (!checked) nrGoodsOther.value = '';
    }
  }

  if (nrActivity) nrActivity.addEventListener('change', syncNrActivityOther);
  document.querySelectorAll('input[name="nr_goods[]"]').forEach(el => {
    el.addEventListener('change', syncNrGoodsOther);
  });

  syncNrActivityOther();
  syncNrGoodsOther();

  // -----------------------
  // 3) Bootstrap validation
  // -----------------------
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });

})();
</script>

<script>
(() => {
  const form = document.querySelector('form.needs-validation');
  if (!form) return;

  const modalEl = document.getElementById('sendingModal');
  const sendingModal = modalEl ? new bootstrap.Modal(modalEl) : null;

  form.addEventListener('submit', () => {
    const lat = document.getElementById('lat')?.value?.trim();
    const lng = document.getElementById('lng')?.value?.trim();

    if (!form.checkValidity() || !lat || !lng) return;

    if (sendingModal) sendingModal.show();

    const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.dataset.originalText = submitBtn.innerHTML;
      submitBtn.innerHTML = 'در حال ارسال...';
    }
  });
})();
</script>

<script>
(() => {
  'use strict';

  const myLocationBtn = document.getElementById('myLocationBtn');
  const geoStatus = document.getElementById('geoStatus');

  if (!myLocationBtn || !navigator.geolocation) {
    if (geoStatus) geoStatus.textContent = 'مرورگر شما از GPS پشتیبانی نمی‌کند';
    return;
  }

  // این متغیر map پایین‌تر ساخته میشه، پس باید داخل scope global باشه:
})();
</script>
<script>
(() => {
  'use strict';

  const MAP_KEY = 'web.e5385054f3844638822482d4d6da3472';

  const latInput = document.getElementById('lat');
  const lngInput = document.getElementById('lng');
  const preview  = document.getElementById('preview');

  const defaultLat = latInput.value ? +latInput.value : 35.699756;
  const defaultLng = lngInput.value ? +lngInput.value : 51.338076;

  let marker = null;
  let accuracyCircle = null;

  // ساخت نقشه
  window.map = new L.Map('map', {
    key: MAP_KEY,
    maptype: 'neshan',
    poi: true,
    traffic: false,
    center: [defaultLat, defaultLng],
    zoom: (latInput.value && lngInput.value) ? 16 : 13
  });

  function updatePreview(lat, lng) {
    preview.textContent = `Lat: ${lat.toFixed(6)} , Lng: ${lng.toFixed(6)}`;
  }

  function setMarker(lat, lng, zoom = 16, accuracy = null) {
    if (!marker) marker = L.marker([lat, lng]).addTo(window.map);
    else marker.setLatLng([lat, lng]);

    // دایره دقت GPS (اختیاری)
    if (accuracy != null) {
      if (!accuracyCircle) {
        accuracyCircle = L.circle([lat, lng], { radius: accuracy }).addTo(window.map);
      } else {
        accuracyCircle.setLatLng([lat, lng]);
        accuracyCircle.setRadius(accuracy);
      }
    }

    latInput.value = lat;
    lngInput.value = lng;
    updatePreview(lat, lng);
    window.map.setView([lat, lng], zoom);
  }

  // اگر قبلاً مختصات ذخیره شده بود
  if (latInput.value && lngInput.value) {
    setMarker(+latInput.value, +lngInput.value, 16);
  }

  // کلیک روی نقشه
  window.map.on('click', (e) => {
    setMarker(e.latlng.lat, e.latlng.lng, 16);
  });

  // ✅ GPS با Leaflet locate()
  const myLocationBtn = document.getElementById('myLocationBtn');
  const geoStatus = document.getElementById('geoStatus');

  function locateMe() {
    if (!navigator.geolocation) {
      geoStatus.textContent = 'مرورگر شما از GPS پشتیبانی نمی‌کند';
      return;
    }

    geoStatus.textContent = 'در حال دریافت لوکیشن...';

    window.map.locate({
      setView: true,
      maxZoom: 16,
      enableHighAccuracy: true,
      timeout: 10000,
      maximumAge: 0
    });
  }

  window.map.on('locationfound', (e) => {
    const lat = e.latlng.lat;
    const lng = e.latlng.lng;
    const accuracy = e.accuracy; // متر

    setMarker(lat, lng, 16, accuracy);
    geoStatus.textContent = `لوکیشن دریافت شد (دقت تقریبی: ${Math.round(accuracy)} متر)`;
  });

  window.map.on('locationerror', (e) => {
    geoStatus.textContent =
      'دسترسی داده نشده است.';
    console.log('Location error:', e);
    
  });

  if (myLocationBtn) {
    myLocationBtn.addEventListener('click', locateMe);
  }

  // ✅ اگر میخوای خودکار روی لود هم لوکیشن رو بگیره، این خط رو فعال کن:
  // locateMe();

})();
</script>


</body>
</html>
