<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>چاپ درخواست #{{ $ticket->id }}</title>
    <style>
        body { font-family: tahoma, sans-serif; direction: rtl; margin: 24px; }
        .sheet { max-width: 820px; margin: 0 auto; }
        .header { display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; }
        h1 { font-size: 20px; margin: 0; }
        .meta { font-size: 12px; color:#555; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ddd; padding: 10px; vertical-align: top; }
        th { background: #f7f7f7; width: 220px; text-align: left; }
        .footer { margin-top:24px; display:flex; gap:24px; }
        .sign { flex:1; min-height:80px; border:1px dashed #bbb; padding:8px; }
        @media print { .no-print { display:none !important; } }
    </style>
</head>
<body>
    <div class="sheet">
        <div class="header">
            <h1>فرم چاپ درخواست</h1>
            <div class="meta">شماره: #{{ $ticket->id }}</div>
        </div>

        <table>
            <tbody>
                <tr>
                    <th>کاربر</th>
                    <td>{{ $ticket->user->name }}</td>
                </tr>
                <tr>
                    <th>عنوان</th>
                    <td>{{ $ticket->title }}</td>
                </tr>
                <tr>
                    <th>توضیحات</th>
                    <td>{{ $ticket->description }}</td>
                </tr>
                <tr>
                    <th>وضعیت</th>
                    <td>{{ $ticket->status }}</td>
                </tr>
                <tr>
                    <th>مدیر واحد</th>
                    <td>{{ optional($ticket->manager)->name ?? '—' }}</td>
                </tr>
                <tr>
                    <th>مدیر داخلی/ادمین</th>
                    <td>{{ optional($ticket->superManager)->name ?? '—' }}</td>
                </tr>
                <tr>
                    <th>تاریخ ثبت</th>
                    <td>{{ $ticket->created_at->format('Y/m/d') }} — {{ $ticket->created_at->format('H:i') }}</td>
                </tr>
                <tr>
                    <th>آخرین تغییر</th>
                    <td>{{ $ticket->updated_at->format('Y/m/d') }} — {{ $ticket->updated_at->format('H:i') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <div class="sign"><strong>امضای مدیر واحد</strong></div>
            <div class="sign"><strong>امضای مدیر داخلی/ادمین</strong></div>
            <div class="sign"><strong>امضای کاربر</strong></div>
        </div>

        <div class="no-print" style="margin-top:16px; text-align:center;">
            <button onclick="window.print()">چاپ</button>
        </div>
    </div>

    <script>
        window.addEventListener('load', function(){ window.print(); });
    </script>
</body>
</html>