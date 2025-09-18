<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'customers.view-all',
            'customers.view-own',
            'customers.create',
            'customers.edit',
            'customers.delete',

            'products.view',
            'products.create',
            'products.edit',
            'products.delete',

            'invoices.view-all',
            'invoices.view-own',
            'invoices.create',
            'invoices.edit',
            'invoices.delete',

            'reports.view-all',
            'reports.create-own',

            'categories.manage',
            'reference-types.manage',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $marketer = Role::firstOrCreate(['name' => 'Marketer']);
        $guest = Role::firstOrCreate(['name' => 'Guest']);

        $admin->syncPermissions($permissions);

        $marketer->syncPermissions([
            'customers.view-own',
            'customers.create',
            'customers.edit',

            'products.view',

            'invoices.view-own',
            'invoices.create',
            'invoices.edit',

            'reports.create-own',
        ]);

        $guest->syncPermissions([
            'reports.create-own',
        ]);
    }
}
