<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [

            'view-dashboard',

            'create-user',
            'view-user',
            'edit-user',
            'delete-user',

            'create-role',
            'view-role',
            'edit-role',
            'delete-role',

            'create-permission',
            'view-permission',
            'edit-permission',
            'delete-permission',

            'create-brand',
            'view-brand',
            'edit-brand',
            'delete-brand',

            'create-branch',
            'view-branch',
            'edit-branch',
            'delete-branch',

            'create-staff',
            'view-staff',
            'edit-staff',
            'delete-staff',

            'create-customer',
            'view-customer',
            'edit-customer',
            'delete-customer',

            'manage-vip-customer',
            'view-vip-customer',

            'create-table',
            'view-table',
            'edit-table',
            'delete-table',

            'create-order',
            'view-order',
            'edit-order',
            'delete-order',

            'prepare-order',
            'ready-order',
            'deliver-order',
            'complete-order',

            'create-token',
            'view-token',
            // 'update-token',

            'view-kitchen',
            'manage-kitchen',

            'create-inventory',   
            'view-inventory',    
            'edit-inventory',  
            'delete-inventory', 

            'request-stock',
            'approve-stock-request',           
            'generate-bill',
            'view-bill',
            'edit-bill',
            'delete-bill',

            'process-payment',
            'view-payment',

            'view-sales-report',
            'view-profit-report',
            'view-inventory-report',
            'view-staff-report',
            'view-subscription-report',

            'view-notification',
            'send-notification',

            'create-subscription-plan',
            'view-subscription-plan',
            'edit-subscription-plan',
            'delete-subscription-plan',

            'purchase-subscription',
            'renew-subscription',
            'cancel-subscription',
            'view-subscription',

            'view-platform-revenue',
            'view-branch-analytics',
            'view-owner-dashboard',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'api'
            ]);
        }
    }
}
