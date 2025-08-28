<?php

namespace Database\Seeders;

use App\Models\Journal;
use Illuminate\Database\Seeder;

class JournalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Journal::insert([
            [
                'ref_no'       => 'JV-2025-0001',
                'posting_date' => '2025-07-01',
                'memo'         => 'Opening accrual',
                'status'       => 'posted',
                'created_by'   => null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'ref_no'       => 'JV-2025-0002',
                'posting_date' => '2025-07-15',
                'memo'         => 'Sales cash',
                'status'       => 'posted',
                'created_by'   => null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'ref_no'       => 'JV-2025-0003',
                'posting_date' => '2025-07-20',
                'memo'         => 'Utilities expense',
                'status'       => 'posted',
                'created_by'   => null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
