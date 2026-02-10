<?php

namespace App\Http\Controllers;

use App\Models\AriyaProduct;
use Illuminate\Http\Request;

class PublicProductsController extends Controller
{
    /**
     * لیست محصولات + مدل‌ها
     * GET /api/public/products
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $inStock = $request->boolean('in_stock', false); // فقط موجودها
        $perPage = (int) $request->query('per_page', 20);
        $perPage = max(1, min($perPage, 100)); // سقف 100

        $query = AriyaProduct::query()
            ->with(['varieties' => function ($v) use ($inStock) {
                if ($inStock) $v->where('quantity', '>', 0);
                $v->orderByDesc('is_placeholder')->orderBy('model_name');
            }]);

        if ($q !== '') {
            $query->where('title', 'like', "%{$q}%")
                  ->orWhereHas('varieties', function ($v) use ($q) {
                      $v->where('model_name', 'like', "%{$q}%")
                        ->orWhere('unique_key', 'like', "%{$q}%");
                  });
        }

        if ($inStock) {
            // محصولاتی که حداقل یک مدل موجود دارند
            $query->whereHas('varieties', fn($v) => $v->where('quantity', '>', 0));
        }

        $products = $query->orderByDesc('id')->paginate($perPage);

        // شکل خروجی تمیز
        $data = $products->through(function ($p) {
            return [
                'ariya_id'       => $p->ariya_id,
                'title'          => $p->title,
                'base_price'     => (int) $p->base_price,
                'base_quantity'  => (int) $p->base_quantity,
                'has_varieties'  => (bool) $p->has_varieties,
                'synced_at'      => optional($p->synced_at)->toIso8601String(),
                'varieties'      => $p->varieties->map(function ($v) {
                    return [
                        'variety_id'      => $v->ariya_variety_id, // null برای placeholder
                        'model_name'      => $v->model_name,
                        'unique_key'      => $v->unique_key,
                        'price'           => (int) $v->price,
                        'quantity'        => (int) $v->quantity,
                        'is_placeholder'  => (bool) $v->is_placeholder,
                        'synced_at'       => optional($v->synced_at)->toIso8601String(),
                    ];
                })->values(),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $data,
                'meta' => [
                    'current_page' => $products->currentPage(),
                    'per_page'     => $products->perPage(),
                    'total'        => $products->total(),
                    'last_page'    => $products->lastPage(),
                ]
            ],
        ]);
    }

    /**
     * جزئیات یک محصول با مدل‌ها
     * GET /api/public/products/{ariya_id}
     */
    public function show($ariya_id)
    {
        $product = AriyaProduct::query()
            ->where('ariya_id', (int)$ariya_id)
            ->with(['varieties' => fn($v) => $v->orderByDesc('is_placeholder')->orderBy('model_name')])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => [
                'ariya_id'       => $product->ariya_id,
                'title'          => $product->title,
                'base_price'     => (int) $product->base_price,
                'base_quantity'  => (int) $product->base_quantity,
                'has_varieties'  => (bool) $product->has_varieties,
                'synced_at'      => optional($product->synced_at)->toIso8601String(),
                'varieties'      => $product->varieties->map(fn($v) => [
                    'variety_id'     => $v->ariya_variety_id,
                    'model_name'     => $v->model_name,
                    'unique_key'     => $v->unique_key,
                    'price'          => (int) $v->price,
                    'quantity'       => (int) $v->quantity,
                    'is_placeholder' => (bool) $v->is_placeholder,
                ])->values(),
            ]
        ]);
    }
}
