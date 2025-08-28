<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use Illuminate\Database\Seeder;

class ChartOfAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChartOfAccount::insert([
            [
                'code'           => '1101',
                'name'           => 'Cash',
                'normal_balance' => 'DR',
                'is_active'      => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'code'           => '1201',
                'name'           => 'Accounts Receivable',
                'normal_balance' => 'DR',
                'is_active'      => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'code'           => '2101',
                'name'           => 'Accounts Payable',
                'normal_balance' => 'CR',
                'is_active'      => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'code'           => '4101',
                'name'           => 'Revenue',
                'normal_balance' => 'CR',
                'is_active'      => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'code'           => '5101',
                'name'           => 'Expense',
                'normal_balance' => 'DR',
                'is_active'      => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'code'           => '6101',
                'name'           => 'Accrued Expense',
                'normal_balance' => 'CR',
                'is_active'      => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
