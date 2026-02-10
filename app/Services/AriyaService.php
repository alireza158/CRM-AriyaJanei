<?php
namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AriyaService
{
    protected $baseUrl;
    protected $cacheKey = 'ariya_admin_token';
    protected $cacheTtl = 55 * 60; // 55 دقیقه به ثانیه (مثال)

    public function __construct()
    {
        $this->baseUrl = rtrim(env('ARIYA_BASE_URL', 'https://api.ariyajanebi.ir/v1'), '/');
    }

    /**
     * برگرداندن توکن (از کش یا لاگین جدید)
     *
     * @return string|null
     */
    public function getToken(): ?string
    {
        // 1. اگر توکن در کش هست برمی‌گردونیم
        if (Cache::has($this->cacheKey)) {
            return Cache::get($this->cacheKey);
        }

        // 2. در غیر این صورت لاگین می‌کنیم
        $username = env('ARIYA_ADMIN_USERNAME');
        $password = env('ARIYA_ADMIN_PASSWORD');

        if (!$username || !$password) {
            return null;
        }

        // وقتی API لاگین نیاز به POST داره (معمولاً) ما POST می‌کنیم
        $resp = Http::accept('application/json')
            ->post("{$this->baseUrl}/admin/login", [
                'username' => $username,
                'password' => $password,
            ]);

        if ($resp->failed()) {
            // اگر لازم باشه می‌تونی لاگ کنی: \Log::error('Ariya login failed: ' . $resp->body());
            return null;
        }

        $json = $resp->json();

        // ساختار پاسخ ممکنه فرق کنه؛ بررسی کن که توکن کجاست
        // نمونه: { "success": true, "data": { "token": "xxxxx" } }
        $token = $json['data']['token'] ?? $json['token'] ?? $json['access_token'] ?? null;

        if ($token) {
            // ذخیره در کش با TTL
            Cache::put($this->cacheKey, $token, $this->cacheTtl);
            return $token;
        }

        return null;
    }

    /**
     * پاک کردن توکن از کش (مثلاً وقتی می‌خوای فوراً refresh کنی)
     */
    public function clearToken(): void
    {
        Cache::forget($this->cacheKey);
    }
}
