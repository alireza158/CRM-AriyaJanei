<?php

namespace Database\Seeders;

use App\Models\ReferenceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReferenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['اینستاگرام', 'وب‌سایت', 'معرفی دوستان', 'تلگرام', 'تبلیغات'];
        foreach ($types as $type) {
            ReferenceType::firstOrCreate(['name' => $type]);
        }
    }
}
