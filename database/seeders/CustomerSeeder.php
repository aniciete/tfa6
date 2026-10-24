<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Seed the customers table with TFA sample records.
     */
    public function run(): void
    {
        $customers = [
            [
                'full_name'  => 'Elena Rostova',
                'email'      => 'elena.rostova@example.com',
                'phone'      => '+1 (555) 234-5678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name'  => 'Marcus Vance',
                'email'      => 'marcus.vance@example.com',
                'phone'      => '+1 (555) 345-6789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name'  => 'Aria Thorne',
                'email'      => 'aria.thorne@example.com',
                'phone'      => '+1 (555) 456-7890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name'  => 'Julian Mercer',
                'email'      => 'julian.mercer@example.com',
                'phone'      => '+1 (555) 567-8901',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name'  => 'Sophia Lin',
                'email'      => 'sophia.lin@example.com',
                'phone'      => '+1 (555) 678-9012',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('customers')->insertOrIgnore($customers);
    }
}
