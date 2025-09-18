<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfBlocked
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->isBlocked()) {
            Auth::logout();
            return redirect()->route('login')
                ->withErrors(['email' => "حساب شما تا {$user->blocked_until->format('Y-m-d H:i')} مسدود است."]);
        }

        return $next($request);
    }
}

