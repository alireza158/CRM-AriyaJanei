<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductControllerWeb extends Controller
{




    public function index(Request $request)
    {
        $page = $request->get('page', 1); // صفحه موردنظر

        $response = Http::get('https://api.ariyajanebi.ir/v1/front/products', [
            'page' => $page
        ]);

        if ($response->successful()) {
            $json = $response->json();
            $products = $json['data']['products']['data'] ?? [];
            $pagination = [
                'current_page' => $json['data']['products']['current_page'] ?? 1,
                'last_page' => $json['data']['products']['last_page'] ?? 1,
            ];
        } else {
            $products = [];
            $pagination = ['current_page' => 1, 'last_page' => 1];
            session()->flash('error', 'خطا در دریافت اطلاعات محصولات از API');
        }

        return view('productsWeb.index', compact('products', 'pagination'));
    }


}
