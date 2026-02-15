<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureExternalSyncToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $expectedToken = config('services.external_sync.token');

        if (blank($expectedToken)) {
            return response()->json([
                'message' => 'External sync token is not configured.',
            ], 500);
        }

        $providedToken = $request->bearerToken();

        if (! hash_equals($expectedToken, (string) $providedToken)) {
            return response()->json([
                'message' => 'Unauthorized.',
            ], 401);
        }

        return $next($request);
    }
}
