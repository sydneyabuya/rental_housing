<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'vendor_create',
            ],
            [
                'id'    => 18,
                'title' => 'vendor_edit',
            ],
            [
                'id'    => 19,
                'title' => 'vendor_show',
            ],
            [
                'id'    => 20,
                'title' => 'vendor_delete',
            ],
            [
                'id'    => 21,
                'title' => 'vendor_access',
            ],
            [
                'id'    => 22,
                'title' => 'property_create',
            ],
            [
                'id'    => 23,
                'title' => 'property_edit',
            ],
            [
                'id'    => 24,
                'title' => 'property_show',
            ],
            [
                'id'    => 25,
                'title' => 'property_delete',
            ],
            [
                'id'    => 26,
                'title' => 'property_access',
            ],
            [
                'id'    => 27,
                'title' => 'unit_create',
            ],
            [
                'id'    => 28,
                'title' => 'unit_edit',
            ],
            [
                'id'    => 29,
                'title' => 'unit_show',
            ],
            [
                'id'    => 30,
                'title' => 'unit_delete',
            ],
            [
                'id'    => 31,
                'title' => 'unit_access',
            ],
            [
                'id'    => 32,
                'title' => 'application_create',
            ],
            [
                'id'    => 33,
                'title' => 'application_edit',
            ],
            [
                'id'    => 34,
                'title' => 'application_show',
            ],
            [
                'id'    => 35,
                'title' => 'application_delete',
            ],
            [
                'id'    => 36,
                'title' => 'application_access',
            ],
            [
                'id'    => 37,
                'title' => 'invoice_create',
            ],
            [
                'id'    => 38,
                'title' => 'invoice_edit',
            ],
            [
                'id'    => 39,
                'title' => 'invoice_show',
            ],
            [
                'id'    => 40,
                'title' => 'invoice_delete',
            ],
            [
                'id'    => 41,
                'title' => 'invoice_access',
            ],
            [
                'id'    => 42,
                'title' => 'lease_create',
            ],
            [
                'id'    => 43,
                'title' => 'lease_edit',
            ],
            [
                'id'    => 44,
                'title' => 'lease_show',
            ],
            [
                'id'    => 45,
                'title' => 'lease_delete',
            ],
            [
                'id'    => 46,
                'title' => 'lease_access',
            ],
            [
                'id'    => 47,
                'title' => 'maintenance_create',
            ],
            [
                'id'    => 48,
                'title' => 'maintenance_edit',
            ],
            [
                'id'    => 49,
                'title' => 'maintenance_show',
            ],
            [
                'id'    => 50,
                'title' => 'maintenance_delete',
            ],
            [
                'id'    => 51,
                'title' => 'maintenance_access',
            ],
            [
                'id'    => 52,
                'title' => 'workorder_create',
            ],
            [
                'id'    => 53,
                'title' => 'workorder_edit',
            ],
            [
                'id'    => 54,
                'title' => 'workorder_show',
            ],
            [
                'id'    => 55,
                'title' => 'workorder_delete',
            ],
            [
                'id'    => 56,
                'title' => 'workorder_access',
            ],
            [
                'id'    => 57,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
