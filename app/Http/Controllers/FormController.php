<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopContact;

class FormController extends Controller
{
    public function show($visitor)
    {
        return view('contact', [
            'visitor' => (string) $visitor,
        ]);
    }

    public function submit(Request $request, $visitor)
    {
        $visitorNameFromUrl = (string) $visitor;

        $baseRules = [
            'city'          => ['required', 'string', 'max:60'],
            'relation_type' => ['required', 'in:مرتبط,غیر مرتبط'],

            'address'       => ['required', 'string', 'max:200'],
            'shop_name'     => ['required', 'string', 'max:120'],
            'owner_name'    => ['required', 'string', 'max:120'],
            'owner_phone'   => ['required', 'string', 'max:30'],

            'lat'           => ['nullable', 'numeric', 'between:-90,90'],
            'lng'           => ['nullable', 'numeric', 'between:-180,180'],

            'cooperation_interest'  => ['required', 'in:دارد,ندارد,نیاز به مذاکره دارد'],

            // ✅ توضیحات اختیاری
            'description' => ['nullable', 'string', 'max:2000'],
        ];

        $relatedRules = [
            'activity_field' => ['required', 'in:موبایل + جانبی,فقط جانبی,تعمیرات + جانبی,ترکیبی'],
            'shop_size'      => ['required', 'in:کمتر از 15 متر,بین 15 تا 30 متر,بیشتر از 30 متر'],
            'shop_location'  => ['required', 'in:مسیر خیابان اصلی,همکف پاساژ,طبقات پاساژ,کوچه فرعی'],
            'shop_grade'     => ['required', 'in:A - خرید عمده/فروشگاه بزرگ/فروش پرچمدار,B - ویترین متوسط / فروش میان رده,C - حجم خرید کم/ تعمیرکار/ فروش پایین رده'],

            'main_goods'     => ['nullable', 'array'],
            'main_goods.*'   => ['string', 'max:50'],

            'arya_customer'  => ['required', 'in:است,نیست'],
            'payment_terms'  => ['required', 'in:نقدی,چکی'],
        ];

        $nonRelatedRules = [
            'nr_activity'       => ['required', 'in:لوازم رایانه (کامپیوتر),سوپرمارکت,تزیینات خودرو,لوازم برقی,غیره'],
            'nr_activity_other' => ['nullable', 'string', 'max:120', 'required_if:nr_activity,غیره'],

            'nr_goods'          => ['required', 'array', 'min:1'],
            'nr_goods.*'        => ['string', 'max:50'],

            'nr_goods_other'    => ['nullable', 'string', 'max:200'],
        ];

        $rules = $baseRules;

        if ($request->input('relation_type') === 'مرتبط') {
            $rules = array_merge($rules, $relatedRules);
        } else {
            $rules = array_merge($rules, $nonRelatedRules);
        }

        $messages = [
            'required' => 'فیلد :attribute را پر کنید.',
            'required_if' => 'فیلد :attribute را پر کنید.',
            'min' => 'حداقل یک گزینه برای :attribute انتخاب کنید.',
            'in' => 'گزینه انتخابی برای :attribute معتبر نیست.',
            'max' => ':attribute نباید بیشتر از :max کاراکتر باشد.',
            'array' => ':attribute باید به صورت لیست ارسال شود.',
            'numeric' => ':attribute باید عددی باشد.',
            'between' => ':attribute خارج از محدوده مجاز است.',
        ];

        $attributes = [
            'city' => 'شهر',
            'relation_type' => 'نوع ارتباط',
            'address' => 'آدرس',
            'shop_name' => 'نام فروشگاه',
            'owner_name' => 'نام مالک',
            'owner_phone' => 'شماره تماس مالک فروشگاه',
            'lat' => 'مختصات (عرض)',
            'lng' => 'مختصات (طول)',

            'activity_field' => 'زمینه فعالیت',
            'shop_size' => 'اندازه فروشگاه',
            'shop_location' => 'موقعیت فروشگاه',
            'shop_grade' => 'گرید فروشگاه',
            'main_goods' => 'اجناس اصلی',
            'arya_customer' => 'مشتری آریا',
            'payment_terms' => 'شرایط پرداخت',

            'nr_activity' => 'زمینه فعالیت - غیر مرتبط',
            'nr_activity_other' => 'نام شغل (غیره)',
            'nr_goods' => 'اجناس - غیر مرتبط',
            'nr_goods_other' => 'نام اجناس (غیره)',

            'cooperation_interest' => 'تمایل به همکاری',

            // ✅ توضیحات
            'description' => 'توضیحات',
        ];

        $validated = $request->validate($rules, $messages, $attributes);

        // چک اضافه برای غیر مرتبط: اگر "غیره" در اجناس بود، باید nr_goods_other پر شود
        if (($validated['relation_type'] ?? '') === 'غیر مرتبط') {
            $nrGoods = $validated['nr_goods'] ?? [];
            $hasOther = is_array($nrGoods) && in_array('غیره', $nrGoods, true);

            if ($hasOther && empty(trim((string)($validated['nr_goods_other'] ?? '')))) {
                return back()
                    ->withErrors(['nr_goods_other' => 'فیلد نام اجناس (غیره) را پر کنید.'])
                    ->withInput();
            }
        }

        ShopContact::create([
            'visitor_name' => $visitorNameFromUrl,

            'city' => $validated['city'],
            'relation_type' => $validated['relation_type'],

            'address' => $validated['address'],
            'lat' => $validated['lat'] ?? null,
            'lng' => $validated['lng'] ?? null,

            'shop_name' => $validated['shop_name'],
            'owner_name' => $validated['owner_name'],
            'owner_phone' => $validated['owner_phone'],

            'cooperation_interest' => $validated['cooperation_interest'],

            'activity_field' => $validated['activity_field'] ?? null,
            'shop_size' => $validated['shop_size'] ?? null,
            'shop_location' => $validated['shop_location'] ?? null,
            'shop_grade' => $validated['shop_grade'] ?? null,
            'main_goods' => $validated['main_goods'] ?? [],
            'arya_customer' => $validated['arya_customer'] ?? null,
            'payment_terms' => $validated['payment_terms'] ?? null,

            'nr_activity' => $validated['nr_activity'] ?? null,
            'nr_activity_other' => $validated['nr_activity_other'] ?? null,
            'nr_goods' => $validated['nr_goods'] ?? [],
            'nr_goods_other' => $validated['nr_goods_other'] ?? null,

            // ✅ توضیحات اختیاری
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('contact.success');
    }

    public function exportCsv()
    {
        $contacts = ShopContact::latest()->get();

        $filename = 'contacts_' . date('Ymd_His') . '.csv';
        $headers = [
            "Content-Type" => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=$filename",
        ];

        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');

            // BOM برای نمایش درست فارسی در Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

           fputcsv($file, [
    'ID','نام بازدیدکننده','شهر','آدرس','نام فروشگاه','مالک','تلفن',
    'نوع ارتباط','تمایل همکاری','تاریخ ثبت',

    'زمینه فعالیت','اندازه فروشگاه','موقعیت فروشگاه','گرید','مشتری آریا','پرداخت','اجناس اصلی',

    'فعالیت غیرمرتبط','اجناس غیرمرتبط','توضیح غیرمرتبط',

    'توضیحات',

    // ✅ جایگزین عرض و طول
    'lat','long'
]);

            foreach ($contacts as $c) {
                fputcsv($file, [
                    $c->id,
                    $c->visitor_name,
                    $c->city,
                      $c->address,
                         
                    $c->shop_name,
                      $c->owner_name,
                    $c->owner_phone,
                    $c->relation_type,
                    $c->cooperation_interest,
                    optional($c->created_at)->format('Y/m/d H:i'),

                    $c->activity_field,
                    $c->shop_size,
                    $c->shop_location,
                    $c->shop_grade,
                    $c->arya_customer,
                    $c->payment_terms,
                    is_array($c->main_goods) ? implode(' , ', $c->main_goods) : '',

                    $c->nr_activity,
                    is_array($c->nr_goods) ? implode(' , ', $c->nr_goods) : '',
                    $c->nr_goods_other,

                    // ✅ مقدار جدید
                    $c->description,

                    $c->lat,
                    $c->lng,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function list()
    {
        $contacts = ShopContact::latest()->paginate(30);
        return view('admin.contacts', compact('contacts'));
    }
public function list2()
    {
        $contacts = ShopContact::latest()->paginate(30);
        return view('c', compact('contacts'));
    }
    public function delete($id)
    {
        $contact = ShopContact::findOrFail($id);
        $contact->delete();

        return redirect()
            ->back()
            ->with('success', 'رکورد با موفقیت حذف شد.');
    }

    public function edit(ShopContact $contact)
{
    return view('admin.contacts.edit', compact('contact'));
}

public function update(Request $request, ShopContact $contact)
{
    
    // اگر می‌خوای مثل submit ولیدیشن کامل داشته باشه، بعداً اضافه می‌کنیم
    $data = $request->all();

    // چک‌باکس‌ها اگر هیچ چیز انتخاب نشه، کلاً نمیان
    $data['main_goods'] = $request->input('main_goods', []);
    $data['nr_goods']   = $request->input('nr_goods', []);

    // اگر غیرمرتبط نیست، فیلدهای غیرمرتبط رو خالی کن
    if ($request->input('relation_type') === 'مرتبط') {
        $data['nr_activity'] = null;
        $data['nr_activity_other'] = null;
        $data['nr_goods'] = [];
        $data['nr_goods_other'] = null;
    } else {
        // اگر مرتبط نیست، فیلدهای مرتبط رو خالی کن
        $data['activity_field'] = null;
        $data['shop_size'] = null;
        $data['shop_location'] = null;
        $data['shop_grade'] = null;
        $data['main_goods'] = [];
        $data['arya_customer'] = null;
        $data['payment_terms'] = null;
    }

    $contact->update($data);

    return back()->with('ok', true);
}


}
