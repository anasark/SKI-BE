<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClosingPeriodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('closing_periods')->insert([
            [
                'period'     => '2025-07',
                'is_locked'  => false,
                'locked_by'  => null,
                'locked_at'  => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
