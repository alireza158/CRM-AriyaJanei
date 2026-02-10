<?php

namespace App\Http\Controllers;
use App\Models\EmbedToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Services\AriyaService;

use App\Models\CrmOrder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
class MarketerOrderController extends Controller
{
    protected $ariyaAuth;

    public function __construct(AriyaService $ariyaAuth)
    {
        $this->ariyaAuth = $ariyaAuth;
    }

    // 🛍️ صفحه ایجاد سفارش
public function create()
{
  

    $token = $this->ariyaAuth->getToken();
    $baseUrl = config('services.ariya.base_url', 'https://api.ariyajanebi.ir/v1');

    

    // ✅ روش‌های ارسال
    $shippings = Http::withToken($token)
        ->accept('application/json')
        ->get("$baseUrl/admin/shippings")
        ->json('data.shippings.data')
        ?? [];

        
        
    return view('marketer.orders.create', compact('shippings'));
}
// middleware

private function validateEmbedTokenOrAbort(Request $request): EmbedToken
{
    $token = (string) $request->query('token');

    abort_if(!$token, 403);

    $embedToken = EmbedToken::where('token', $token)
        ->where('active', true)
        ->where(function ($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        })
        ->first();

    abort_if(!$embedToken, 403);

    return $embedToken;
}
public function embedCreate(Request $request)
{
    
    // ✅ فقط همین
    $embedToken = $this->validateEmbedTokenOrAbort($request);

    $tokenApi = $this->ariyaAuth->getToken();
    $baseUrl = config('services.ariya.base_url', 'https://api.ariyajanebi.ir/v1');

    $shippings = Http::withToken($tokenApi)
        ->acceptJson()
        ->get("$baseUrl/admin/shippings")
        ->json('data.shippings.data') ?? [];

    // ✅ توکن رو به ویو بده که توی action فرم استفاده بشه
    return view('marketer.orders.embed-create', compact('shippings', 'embedToken'));
}


public function embedStore(Request $request)
{
    // ✅ همان چک توکن برای امنیت
   
        $embedToken = $this->validateEmbedTokenOrAbort($request);
   
    // اینجا همان store خودت را صدا بزن یا کپی کن
    return $this->store($request);
}


    // 🔍 جستجوی مشتری با موبایل (استفاده از مسیر مجاز marketer)
 public function findCustomer(Request $request)
{
    $mobile = trim($request->query('mobile'));

    if (empty($mobile) || strlen($mobile) < 10) {
        return response()->json([
            'success' => false,
            'message' => 'شماره معتبر نیست',
        ], 422);
    }

    try {
        $token = $this->ariyaAuth->getToken();
        $baseUrl = config('services.ariya.base_url', 'https://api.ariyajanebi.ir/v1');

        $response = Http::withToken($token)
            ->accept('application/json')
            ->get("$baseUrl/admin/customers", [
                'version'   => 'new2',
                'search3'   => $mobile,
                'searchBy3' => 'mobile',
            ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'خطا در اتصال به سرور آریا',
                'error'   => $response->body(),
            ], 500);
        }

        $data = $response->json();
        $customer = $data['data']['customers']['data'][0] ?? null;

        if ($customer) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $customer['id'],
                    'first_name' => $customer['first_name'] ?? '',
                    'last_name' => $customer['last_name'] ?? '',
                    'full_name' => $customer['full_name']
                        ?? trim(($customer['first_name'] ?? '') . ' ' . ($customer['last_name'] ?? '')),
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'مشتری یافت نشد',
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'message' => 'خطای سیستمی: ' . $e->getMessage(),
        ], 500);
    }
}

public function store(Request $request)
{
    $validated = $request->validate([
        'customer_name'    => 'required|string|max:255',
        'customer_mobile'  => 'required|string|max:15',
        'customer_address' => 'required|string|max:500',
        'province_id'      => 'required|integer',
        'city_id'          => 'nullable|integer',
        'shipping_id'      => 'required|integer',
        'shipping_price'   => 'required|integer|min:0',
        'discount_amount'  => 'nullable|integer|min:0',
        'total_price'      => 'required|integer|min:0',
        'products'         => 'required|array|min:1',
        'products.*.id'    => 'required|integer',
        'products.*.quantity'   => 'required|integer|min:1',
        'products.*.variety_id' => 'required|integer',
        'payment_status'   => 'required|string|in:paid,pending',
    ]);
// 🛡️ جلوگیری از خطای تقسیم بر صفر در API
// 🛡️ جلوگیری از ارسال مقادیر صفر به API
if (empty($validated['shipping_price']) || $validated['shipping_price'] <= 0) {
    $validated['shipping_price'] = 1000; // حداقل هزینه ارسال
}
if (empty($validated['city_id']) ) {
    $validated['city_id'] = 1; // حداقل هزینه ارسال
}

// 🧮 برای هر محصول، وزن و تعداد را بررسی کن تا صفر نباشد
foreach ($validated['products'] as &$product) {
    if (empty($product['quantity']) || $product['quantity'] <= 0) {
        $product['quantity'] = 1;
    }
    // وزن فرضی مثبت بفرست تا API کرش نکند
    $product['weight'] = 1;
}
unset($product);


    try {
        $token = $this->ariyaAuth->getToken();
        $baseUrl = config('services.ariya.base_url', 'https://api.ariyajanebi.ir/v1');

        $nameParts = explode(' ', trim($validated['customer_name']), 2);
        $firstName = $nameParts[0] ?? '';
        $lastName  = $nameParts[1] ?? 'بدون‌نام‌خانوادگی';

        // 👤 بررسی مشتری
        $check = Http::withToken($token)
            ->accept('application/json')
            ->get("$baseUrl/admin/customers", [
                'version' => 'new2',
                'search3' => $validated['customer_mobile'],
                'searchBy3' => 'mobile',
            ]);

        $customerData = $check->json('data.customers.data.0') ?? null;

        if (!$customerData) {
            $create = Http::withToken($token)
                ->asForm()
                ->accept('application/json')
                ->post("$baseUrl/admin/customers", [
                    'first_name' => $firstName,
                    'last_name'  => $lastName,
                    'mobile'     => $validated['customer_mobile'],
                ]);
            $customerData = $create->json('data.customer');
        }

        $customerId = $customerData['id'] ?? null;
        if (!$customerId) {
            return back()->with('error', '❌ شناسه مشتری دریافت نشد.');
        }

        // 🏠 ایجاد آدرس
        $addressResponse = Http::withToken($token)
            ->asForm()
            ->accept('application/json')
            ->post("$baseUrl/admin/customers/addresses", [
                'city'         => $validated['city_id'],
                'first_name'   => $firstName,
                'last_name'    => $lastName,
                'address'      => $validated['customer_address'],
                'postal_code'  => '0000000000',
                'mobile'       => $validated['customer_mobile'],
                'customer_id'  => $customerId,
            ]);
           

        $addressId = $addressResponse->json('data.address.id') ?? null;

        if (!$addressId) {
            return back()->with('error', '❌ شناسه آدرس دریافت نشد.');
        }

        // 📦 ثبت سفارش
      $orderData = [
    'customer_id'     => $customerId,
    'address_id'      => $addressId,
    'shipping_id'     => $validated['shipping_id'],
    'discount_amount' => 1,
    'description'     => 'سفارش از سمت مارکتر',
   'payment_status' => 'pending',
    'pre_invoice' => 1,
    // 💡 اضافه می‌کنیم تا خطای تقسیم بر صفر رفع شود
    'shipping_price'  => $validated['shipping_price'] ?? 1000,
    'custom_weight'   => 1, // وزن پیش‌فرض برای جلوگیری از تقسیم بر صفر

    'varieties'       => collect($validated['products'])
        ->map(fn($p) => [
            'id' => (int) $p['variety_id'],
            'quantity' => (int) $p['quantity'] > 0 ? (int) $p['quantity'] : 1,
            // 🧱 اضافه: وزن پیش‌فرض برای هر آیتم
            'weight' => 1
        ])
        ->toArray(),
];


        $response = Http::withToken($token)
            ->accept('application/json')
            ->post("$baseUrl/admin/orders", $orderData);

        if ($response->failed()) {
            return back()->with('error', '❌ خطا در ثبت سفارش: ' . $response->body());
        }

        return redirect()->route('marketer.orders.create')
            ->with('success', '✅ سفارش با موفقیت ثبت شد.');

    } catch (\Throwable $e) {
        return back()->with('error', '⚠️ خطای سیستمی: ' . $e->getMessage());
    }
}


/**
 * ولیدیشن مشترک draft
 */
private function validateDraftPayload(Request $request): array
{
    return $request->validate([
        'customer_name'    => 'required|string|max:255',
        'customer_mobile'  => 'required|string|max:20',
        'customer_address' => 'required|string|max:1000',
        'province_id'      => 'required|integer',
        'city_id'          => 'nullable|integer',
        'shipping_id'      => 'required|integer',
        'shipping_price'   => 'required|integer|min:0',
        'discount_amount'  => 'nullable|integer|min:0',
        'total_price'      => 'required|integer|min:0',

        'products'              => 'required|array|min:1',
        'products.*.id'         => 'required|integer',
        'products.*.variety_id' => 'required|integer',
        'products.*.quantity'   => 'required|integer|min:1',
        'products.*.price'      => 'nullable|integer|min:0',
    ]);
}

/**
 * ساخت/ذخیره پیش‌نویس
 * اگر این درخواست از embed باشد، token را به عنوان embed_token ذخیره می‌کنیم.
 */
public function saveDraft(Request $request)
{
    $validated = $this->validateDraftPayload($request);
    $embedToken = (string) $request->query('token'); // اگر embed بود

    $order = DB::transaction(function () use ($validated, $embedToken) {
        $order = CrmOrder::create([
            'uuid' => (string) Str::uuid(),
            'created_by' => auth()->id() ?? null,
            'status' => 'draft',

            'customer_name' => $validated['customer_name'],
            'customer_mobile' => $validated['customer_mobile'],
            'customer_address' => $validated['customer_address'],
            'province_id' => $validated['province_id'],
            'city_id' => $validated['city_id'] ?? null,
            'shipping_id' => $validated['shipping_id'],
            'shipping_price' => $validated['shipping_price'],
            'discount_amount' => $validated['discount_amount'] ?? 0,
            'total_price' => $validated['total_price'],

            'embed_token' => $embedToken ?: null,
        ]);

        foreach ($validated['products'] as $p) {
            $order->items()->create([
                'product_id' => (int) $p['id'],
                'variety_id' => (int) $p['variety_id'],
                'quantity' => (int) $p['quantity'],
                'price' => (int) ($p['price'] ?? 0),
            ]);
        }

        return $order;
    });

    // ✅ بعد از ذخیره: اگر قفل برای خود کاربر بوده آزادش کن
    $this->releaseLockIfOwned($order);

    // ✅ برگرد به صفحه لیست فاکتورهای draft
    // اگر embedToken داری و میخوای لیست هم محدود به همون embed باشه، اینجا queryString رو نگه دار
    $to = redirect()->route('crm.orders.draft.index');

    if ($embedToken) {
        $to->withHeaders(['X-Embed-Token' => $embedToken]); // اختیاری
        return redirect()->route('crm.orders.draft.index', ['token' => $embedToken])
            ->with('success', '✅ پیش‌نویس ذخیره شد.');
    }

    return $to->with('success', '✅ پیش‌نویس ذخیره شد.');
}

/**
 * صفحه ادیت پیش‌نویس
 */
public function editDraft(string $uuid, Request $request)
{
    $order = CrmOrder::with('items')->where('uuid', $uuid)->firstOrFail();

    // اگر سفارش از embed ساخته شده، ادیت هم باید با همان token باشد
    if ($order->embed_token) {
        $t = (string) $request->query('token');
        abort_if(!$t || $t !== $order->embed_token, 403);
    }

    // همان shippings قبلی
    $tokenApi = $this->ariyaAuth->getToken();
    $baseUrl = config('services.ariya.base_url', 'https://api.ariyajanebi.ir/v1');
    $shippings = Http::withToken($tokenApi)->acceptJson()->get("$baseUrl/admin/shippings")
        ->json('data.shippings.data') ?? [];

    return view('crm.orders.edit', compact('order', 'shippings'));
}

/**
 * آپدیت پیش‌نویس
 */
public function updateDraft(string $uuid, Request $request)
{
    $order = CrmOrder::with('items')->where('uuid', $uuid)->firstOrFail();
    abort_if($order->status !== 'draft', 403);

    if ($order->embed_token) {
        $t = (string) $request->query('token');
        abort_if(!$t || $t !== $order->embed_token, 403);
    }

    $validated = $this->validateDraftPayload($request);

    DB::transaction(function () use ($order, $validated) {
        $order->update([
            'customer_name' => $validated['customer_name'],
            'customer_mobile' => $validated['customer_mobile'],
            'customer_address' => $validated['customer_address'],
            'province_id' => $validated['province_id'],
            'city_id' => $validated['city_id'] ?? null,
            'shipping_id' => $validated['shipping_id'],
            'shipping_price' => $validated['shipping_price'],
            'discount_amount' => $validated['discount_amount'] ?? 0,
            'total_price' => $validated['total_price'],
        ]);

        $order->items()->delete();
        foreach ($validated['products'] as $p) {
            $order->items()->create([
                'product_id' => (int) $p['id'],
                'variety_id' => (int) $p['variety_id'],
                'quantity' => (int) $p['quantity'],
                'price' => (int) ($p['price'] ?? 0),
            ]);
        }
    });

    return back()->with('success', '✅ پیش‌نویس بروزرسانی شد.');
}

/**
 * ثبت نهایی در آریا از روی Draft
 * اینجا عملاً داده‌های $order را به همان store خودت تزریق می‌کنیم.
 */
public function submitDraft(string $uuid, Request $request)
{
    $order = CrmOrder::with('items')->where('uuid', $uuid)->firstOrFail();
    abort_if($order->status !== 'draft', 403);

    if ($order->embed_token) {
        $t = (string) $request->query('token');
        abort_if(!$t || $t !== $order->embed_token, 403);
    }

    // تبدیل Draft به Request قابل استفاده برای store()
    $payload = [
        'customer_name'    => $order->customer_name,
        'customer_mobile'  => $order->customer_mobile,
        'customer_address' => $order->customer_address,
        'province_id'      => $order->province_id,
        'city_id'          => $order->city_id,
        'shipping_id'      => $order->shipping_id,
        'shipping_price'   => $order->shipping_price,
        'discount_amount'  => $order->discount_amount,
        'total_price'      => $order->total_price,
        'payment_status'   => 'pending',
        'products'         => $order->items->map(fn($it) => [
            'id' => (int) $it->product_id,
            'variety_id' => (int) $it->variety_id,
            'quantity' => (int) $it->quantity,
        ])->toArray(),
    ];

    // یک Request جدید بسازیم
    $newRequest = Request::create($request->url(), 'POST', $payload);
    $newRequest->headers->replace($request->headers->all());
    $newRequest->setLaravelSession($request->session());

    // اجرای store فعلی شما
    $response = $this->store($newRequest);

    // اگر store موفق بود، سفارش را submitted کنیم
    // چون store شما redirect می‌کند، بهترین کار اینه که با session موفقیت تشخیص بدیم
    // اینجا ساده‌ترین حالت:
    $order->update(['status' => 'submitted']);

    return $response;
}
 // ✅ مدت اعتبار قفل (ثانیه)
    private int $LOCK_TTL_SECONDS = 120; // 2 دقیقه
    private int $HEARTBEAT_EXTEND_SECONDS = 120; // تمدید 2 دقیقه

    private function userDisplayName(): string
    {
        $u = auth()->user();
        if (!$u) return 'Unknown';
        return $u->name ?? $u->email ?? ('User#'.$u->id);
    }

    /**
     * ✅ صفحه لیست پیش‌نویس‌ها
     */
    public function draftIndex(Request $request)
    {
        // draft ها
        $orders = CrmOrder::query()
            ->with(['lockedByUser'])
            ->where('status', 'draft')
            ->orderByDesc('id')
            ->paginate(20);

        return view('crm.orders.drafts-index', compact('orders'));
    }

    /**
     * ✅ گرفتن قفل (Acquire lock) - اتمیک
     */
    public function draftAcquireLock(string $uuid, Request $request)
    {
        $userId = auth()->id();
        abort_if(!$userId, 403);

        $now = now();
        $expires = $now->copy()->addSeconds($this->LOCK_TTL_SECONDS);

        $result = DB::transaction(function () use ($uuid, $userId, $now, $expires) {
            /** @var CrmOrder $order */
            $order = CrmOrder::where('uuid', $uuid)->lockForUpdate()->firstOrFail();

            abort_if($order->status !== 'draft', 403);

            // اگر قفل دارد و منقضی نشده و متعلق به خود کاربر نیست => رد
            if ($order->locked_by && $order->lock_expires_at && $now->lt($order->lock_expires_at) && (int)$order->locked_by !== (int)$userId) {
                $lockerName = optional($order->lockedByUser)->name
                    ?? optional($order->lockedByUser)->email
                    ?? ('User#'.$order->locked_by);

                return [
                    'ok' => false,
                    'locked_by' => $order->locked_by,
                    'locked_by_name' => $lockerName,
                    'lock_expires_at' => $order->lock_expires_at?->toDateTimeString(),
                ];
            }

            // در غیر این صورت: قفل را بگیر/تمدید کن
            $order->locked_by = $userId;
            $order->locked_at = $now;
            $order->lock_expires_at = $expires;
            $order->save();

            return [
                'ok' => true,
                'locked_by' => $userId,
                'locked_by_name' => $this->userDisplayName(),
                'lock_expires_at' => $expires->toDateTimeString(),
            ];
        });

        return response()->json($result);
    }

    /**
     * ✅ تمدید قفل (Heartbeat) - فقط اگر قفل مال همین کاربر باشد
     */
    public function draftHeartbeat(string $uuid, Request $request)
    {
        $userId = auth()->id();
        abort_if(!$userId, 403);

        $now = now();
        $newExpires = $now->copy()->addSeconds($this->HEARTBEAT_EXTEND_SECONDS);

        $result = DB::transaction(function () use ($uuid, $userId, $now, $newExpires) {
            $order = CrmOrder::where('uuid', $uuid)->lockForUpdate()->firstOrFail();

            abort_if($order->status !== 'draft', 403);

            // اگر قفل مال این کاربر نیست یا منقضی شده => fail
            if ((int)$order->locked_by !== (int)$userId || !$order->lock_expires_at || $now->gte($order->lock_expires_at)) {
                $lockerName = optional($order->lockedByUser)->name
                    ?? optional($order->lockedByUser)->email
                    ?? ($order->locked_by ? ('User#'.$order->locked_by) : null);

                return [
                    'ok' => false,
                    'message' => 'قفل معتبر نیست یا توسط کاربر دیگری گرفته شده است.',
                    'locked_by' => $order->locked_by,
                    'locked_by_name' => $lockerName,
                    'lock_expires_at' => $order->lock_expires_at?->toDateTimeString(),
                ];
            }

            $order->locked_at = $now;
            $order->lock_expires_at = $newExpires;
            $order->save();

            return [
                'ok' => true,
                'lock_expires_at' => $newExpires->toDateTimeString(),
            ];
        });

        return response()->json($result);
    }

    /**
     * ✅ آزاد کردن قفل (Unlock) - فقط صاحب قفل
     */
    public function draftReleaseLock(string $uuid, Request $request)
    {
        $userId = auth()->id();
        abort_if(!$userId, 403);

        $result = DB::transaction(function () use ($uuid, $userId) {
            $order = CrmOrder::where('uuid', $uuid)->lockForUpdate()->firstOrFail();

            // فقط صاحب قفل اجازه دارد
            if ((int)$order->locked_by !== (int)$userId) {
                return ['ok' => false, 'message' => 'شما صاحب قفل نیستید.'];
            }

            $order->locked_by = null;
            $order->locked_at = null;
            $order->lock_expires_at = null;
            $order->save();

            return ['ok' => true];
        });

        return response()->json($result);
    }

private function releaseLockIfOwned(CrmOrder $order): void
{
    $uid = auth()->id();
    if (!$uid) return;

    // فقط اگر قفل مال همین کاربره آزاد کن
    if ((int) $order->locked_by === (int) $uid) {
        $order->locked_by = null;
        $order->locked_at = null;
        $order->lock_expires_at = null;
        $order->save();
    }
}


public function exportProductsExcel(Request $request)
{
    // ✅ امنیت: فقط با توکن embed

    $token = $this->ariyaAuth->getToken();
    $baseUrl = config('services.ariya.base_url', 'https://api.ariyajanebi.ir/v1');

    // 1) همه محصولات (صفحه به صفحه)
    $page = 1;
    $lastPage = 1;
    $products = [];

    do {
        $res = Http::withToken($token)->acceptJson()
            ->get("{$baseUrl}/front/products", ['page' => $page]);

        $json = $res->json();
        $items = $json['data']['products']['data'] ?? [];
        $lastPage = (int)($json['data']['products']['last_page'] ?? 1);

        $products = array_merge($products, $items);
        $page++;
    } while ($page <= 1);

    // 2) جزئیات هر محصول برای گرفتن مدل‌ها و موجودی
    $rows = [];
    foreach ($products as $p) {
        $pid = $p['id'] ?? null;
        if (!$pid) continue;

        $detailRes = Http::withToken($token)->acceptJson()
            ->get("{$baseUrl}/front/products/{$pid}");

        $product = $detailRes->json('data.product') ?? null;
        if (!$product) continue;

        $title = $product['title'] ?? '';
        $basePrice = $product['price'] ?? 0;

        $varieties = $product['varieties'] ?? [];

        // اگر مدل ندارد، یک ردیف بدون مدل بده
        if (count($varieties) === 0) {
            $rows[] = [
                'product_id'   => $pid,
                'variety_id'   => $pid,
                'product'      => $title,
                'model'        => 'بدون مدل',
                'unique_key'   => '',
                'price'        => (int)$basePrice,
                'quantity'     => (int)($product['quantity'] ?? 0),
            ];
            continue;
        }

        // اگر مدل دارد، برای هر مدل یک ردیف
        foreach ($varieties as $v) {
            $modelName =
                trim(collect($v['attributes'] ?? [])
                    ->map(fn($a) => $a['pivot']['value'] ?? '')
                    ->filter()
                    ->implode(' '));

            if ($modelName === '') {
                $modelName = trim($v['unique_attributes_key'] ?? '') ?: ('مدل '.$v['id']);
            }

            $rows[] = [
                'product_id' => (int)($pid),
                'variety_id' => (int)($v['id'] ?? 0),
                'product'    => $title,
                'model'      => $modelName,
                'unique_key' => (string)($v['unique_attributes_key'] ?? ''),
                'price'      => (int)(($v['price'] ?? 0) ?: $basePrice),
                'quantity'   => (int)($v['quantity'] ?? 0),
            ];
        }
    }

    // 3) دانلود اکسل
    $export = new class($rows) implements FromArray, WithHeadings {
        public function __construct(private array $rows) {}
        public function array(): array { return $this->rows; }
        public function headings(): array {
            return ['product_id','variety_id','product','model','unique_key','price','quantity'];
        }
    };
$client = Http::withToken($token)
    ->acceptJson()
    ->timeout(20)          // ✅ خیلی مهم
    ->retry(2, 500);       // ✅ اگر لحظه‌ای قطع شد

    if ($res->failed()) {
    logger()->error('EXPORT FAILED products list', ['body' => $res->body()]);
    return response('خطا در دریافت لیست محصولات', 500);
}

    return Excel::download($export, 'products-with-stock.xlsx');
}
}
