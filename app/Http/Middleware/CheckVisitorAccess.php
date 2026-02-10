<?php

// app/Http/Middleware/CheckVisitorAccess.php

namespace App\Http\Middleware;

use Closure;
use App\Models\ShopContact;

class CheckVisitorAccess
{
   public function handle($request, Closure $next)
{
    $contact = $request->route('contact'); // باید همین باشد چون route {contact} است

    if (!$contact instanceof \App\Models\ShopContact) {
        $contact = \App\Models\ShopContact::find($contact);
    }

    if (!$contact) abort(404);

    if (!session()->has('allowed_visitor')) {
        abort(403, 'ابتدا کد دسترسی را وارد کنید');
    }

    if ((string) $contact->visitor_name !== (string) session('allowed_visitor')) {
        abort(403, 'دسترسی غیرمجاز');
    }

    return $next($request);
}

}
