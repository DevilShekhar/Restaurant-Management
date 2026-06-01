<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [

            'super_admin',
            'owner',
            'branch_manager',
            'waiter_head',
            'waiter',
            'chef',
            'cashier',
            'customer'

        ];

        foreach ($roles as $role) {

            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'api'
            ]);

        }
    }
}