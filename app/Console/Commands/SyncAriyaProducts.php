<?php

// app/Console/Commands/SyncAriyaProducts.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\AriyaProduct;
use App\Models\AriyaProductVariety;
use App\Services\AriyaService;

class SyncAriyaProducts extends Command
{
  protected $signature = 'ariya:sync-products';
  protected $description = 'Sync products & varieties from Ariya API into DB';

  public function __construct(private AriyaService $ariyaAuth)
  {
    parent::__construct();
  }

  public function handle(): int
  {
    $token = $this->ariyaAuth->getToken();
    $baseUrl = config('services.ariya.base_url', 'https://api.ariyajanebi.ir/v1');

    $now = now();

    // 1) همه محصولات صفحه به صفحه
    $page = 3;
    $lastPage = 3;
    $products = [];

    do {
      $res = Http::withToken($token)->acceptJson()
        ->get("{$baseUrl}/front/products", ['page' => $page]);

      $json = $res->json();
      $items = $json['data']['products']['data'] ?? [];
      $lastPage = (int)($json['data']['products']['last_page'] ?? 1);

      $products = array_merge($products, $items);
      $page++;
    } while ($page <= 5);

    $this->info("Loaded list: ".count($products)." products");

    // 2) جزئیات هر محصول + ذخیره
    foreach ($products as $p) {
      $pid = $p['id'] ?? null;
      if (!$pid) continue;

      $detail = Http::withToken($token)->acceptJson()
        ->get("{$baseUrl}/front/products/{$pid}")
        ->json('data.product');

      if (!$detail) continue;

      DB::transaction(function () use ($detail, $now) {
        // --- Product upsert ---
        $product = AriyaProduct::updateOrCreate(
          ['ariya_id' => (int)$detail['id']],
          [
            'title'         => (string)($detail['title'] ?? ''),
            'base_price'    => (int)($detail['price'] ?? 0),
            'base_quantity' => (int)($detail['quantity'] ?? 0),
            'has_varieties' => !empty($detail['varieties']),
            'synced_at'     => $now,
          ]
        );

        $varieties = $detail['varieties'] ?? [];

        // --- اگر مدل ندارد: یک placeholder در جدول مدل‌ها ---
        if (count($varieties) === 0) {
          // اطمینان از اینکه فقط یک placeholder داریم
          AriyaProductVariety::updateOrCreate(
            [
              'ariya_product_id' => $product->id,
              'is_placeholder'   => true,
            ],
            [
              'ariya_variety_id' => null,
              'model_name'       => '-',
              'unique_key'       => null,
              'price'            => (int)($detail['price'] ?? 0),
              'quantity'         => (int)($detail['quantity'] ?? 0),
              'synced_at'        => $now,
            ]
          );

          // و اگر قبلاً variety واقعی داشته، حذفش کن (اختیاری)
          AriyaProductVariety::where('ariya_product_id', $product->id)
            ->where('is_placeholder', false)
            ->delete();

          return;
        }

        // اگر مدل دارد: placeholder را حذف کن (اختیاری)
        AriyaProductVariety::where('ariya_product_id', $product->id)
          ->where('is_placeholder', true)
          ->delete();

        // --- varieties واقعی ---
        foreach ($varieties as $v) {
          $modelName = collect($v['attributes'] ?? [])
            ->map(fn($a) => $a['pivot']['value'] ?? '')
            ->filter()
            ->implode(' ');
          $modelName = trim($modelName);

          if ($modelName === '') {
            $modelName = trim((string)($v['unique_attributes_key'] ?? ''));
            if ($modelName === '') $modelName = 'مدل '.$v['id'];
          }

          AriyaProductVariety::updateOrCreate(
            [
              'ariya_product_id' => $product->id,
              'ariya_variety_id' => (int)($v['id'] ?? 0),
            ],
            [
              'model_name'     => $modelName,
              'unique_key'     => $v['unique_attributes_key'] ?? null,
              'price'          => (int)(($v['price'] ?? 0) ?: ($detail['price'] ?? 0)),
              'quantity'       => (int)($v['quantity'] ?? 0),
              'is_placeholder' => false,
              'synced_at'      => $now,
            ]
          );
        }

        // پاکسازی مدل‌هایی که دیگر در API نیستند (اختیاری ولی خیلی مفید)
        $apiVarietyIds = collect($varieties)->pluck('id')->map(fn($x)=>(int)$x)->all();
        AriyaProductVariety::where('ariya_product_id', $product->id)
          ->where('is_placeholder', false)
          ->whereNotIn('ariya_variety_id', $apiVarietyIds)
          ->delete();
      });
    }

    $this->info('Sync done ✅');
    return self::SUCCESS;
  }
}
