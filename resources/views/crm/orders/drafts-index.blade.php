<!doctype html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{ asset('lib/bootstrap.rtl.min.css') }}">
  <title>لیست پیش‌نویس‌ها</title>

  <style>
    body{
      background:#f6f8fb;
    }
    .card-soft{
      border: 1px solid rgba(0,0,0,.07);
      border-radius: 18px;
      box-shadow: 0 12px 30px rgba(16, 24, 40, .06);
      background: rgba(255,255,255,.90);
    }
    .badge-soft{
      background: rgba(13,110,253,.10);
      color: #0d6efd;
      border: 1px solid rgba(13,110,253,.15);
      font-weight: 700;
    }
  </style>
</head>

<body class="py-4">
<div class="container" style="max-width: 1100px;">

  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <div>
      <div class="h4 fw-bold mb-0">📄 پیش‌نویس‌های سفارش</div>
      <div class="text-muted small">اگر یک نفر داخل فاکتور باشد، نفر بعدی نمی‌تواند وارد ادیت شود.</div>
    </div>
    <a href="{{ route('marketer.orders.create') }}" class="btn btn-primary">
      ➕ ثبت سفارش جدید
    </a>
  </div>

  @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 fw-bold">
      ✅ {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm rounded-4 fw-bold">
      ❌ {{ session('error') }}
    </div>
  @endif

  <div class="card-soft p-3 p-md-4">
    <div class="table-responsive">
      <table class="table align-middle mb-0">
        <thead>
          <tr class="text-muted small">
            <th>کد</th>
            <th>مشتری</th>
            <th>موبایل</th>
            <th>جمع کل</th>
            <th>وضعیت قفل</th>
            <th class="text-end">عملیات</th>
          </tr>
        </thead>
        <tbody>
          @forelse($orders as $o)
            @php
              $isLocked = $o->isLocked();
              $lockerName = $o->lockedByUser?->name ?? $o->lockedByUser?->email ?? ($o->locked_by ? ('User#'.$o->locked_by) : null);
              $expiresAt = $o->lock_expires_at ? $o->lock_expires_at->format('Y-m-d H:i:s') : null;
            @endphp

            <tr>
              <td class="fw-semibold">{{ $o->uuid }}</td>
              <td>{{ $o->customer_name }}</td>
              <td dir="ltr">{{ $o->customer_mobile }}</td>
              <td class="fw-bold">{{ number_format((int)$o->total_price) }}</td>

              <td>
                @if($isLocked)
                  <span class="badge bg-danger">🔒 در حال ویرایش</span>
                  <div class="small text-muted mt-1">
                    توسط: <span class="fw-semibold">{{ $lockerName }}</span><br>
                    تا: <span dir="ltr">{{ $expiresAt }}</span>
                  </div>
                @else
                  <span class="badge bg-success">✅ آزاد</span>
                @endif
              </td>

              <td class="text-end">
                @if($isLocked && (int)$o->locked_by !== (int)auth()->id())
                  <button class="btn btn-secondary" disabled>
                    ⛔ ورود ممنوع
                  </button>
                @else
                  <a href="{{ route('crm.orders.draft.edit', $o->uuid) }}" class="btn btn-warning">
                    ✏️ ویرایش
                  </a>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted py-5">
                هیچ پیش‌نویسی وجود ندارد.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $orders->links() }}
    </div>
  </div>

</div>
</body>
</html>
