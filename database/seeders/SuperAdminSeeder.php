<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            [
                'email' => 'admin@restaurant.com'
            ],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('12345678')
            ]
        );

        $admin->assignRole('super_admin');
    }
}