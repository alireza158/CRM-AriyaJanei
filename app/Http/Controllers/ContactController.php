<?php



namespace App\Http\Controllers;

use App\Models\ShopContact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function edit(ShopContact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, ShopContact $contact)
    {
        // لاجیک update پایین‌تر توضیح داده می‌شود
    }
}
