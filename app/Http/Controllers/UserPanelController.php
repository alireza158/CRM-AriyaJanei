<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserProduct;

class UserPanelController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userProducts = $user->userProducts()->with('product')->get();

        return view('marketer.sales.index', compact('user', 'userProducts'));
    }
}
