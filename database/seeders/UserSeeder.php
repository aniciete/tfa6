<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the users table with TFA sample records.
     */
    public function run(): void
    {
        $users = [
            [
                'username'   => 'admin.reyes',
                'full_name'  => 'Carlos Reyes',
                'role'       => 'Store Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'mgr.castro',
                'full_name'  => 'Beatriz Castro',
                'role'       => 'Shift Supervisor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'cashier.valdez',
                'full_name'  => 'Daniel Valdez',
                'role'       => 'Cashier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'cashier.santos',
                'full_name'  => 'Camille Santos',
                'role'       => 'Cashier',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username'   => 'inv.navarro',
                'full_name'  => 'Leo Navarro',
                'role'       => 'Inventory Clerk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insertOrIgnore($users);
    }
}
