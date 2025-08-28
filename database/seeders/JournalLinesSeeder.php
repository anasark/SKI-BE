<?php

namespace Database\Seeders;

use App\Models\ChartOfAccount;
use App\Models\Journal;
use App\Models\JournalLine;
use Illuminate\Database\Seeder;

class JournalLinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coa      = ChartOfAccount::pluck('id', 'code');
        $journals = Journal::pluck('id', 'ref_no');

        JournalLine::insert([
            // JV-2025-0001 Opening accrual
            ['journal_id' => $journals['JV-2025-0001'], 'account_id' => $coa['5101'], 'dept_id' => null, 'debit' => 100000.00,  'credit' => 0,          'created_at' => now(), 'updated_at' => now()],
            ['journal_id' => $journals['JV-2025-0001'], 'account_id' => $coa['6101'], 'dept_id' => null, 'debit' => 0,          'credit' => 100000.00,  'created_at' => now(), 'updated_at' => now()],

            // JV-2025-0002 Sales cash
            ['journal_id' => $journals['JV-2025-0002'], 'account_id' => $coa['1101'], 'dept_id' => null, 'debit' => 2800000.00, 'credit' => 0,          'created_at' => now(), 'updated_at' => now()],
            ['journal_id' => $journals['JV-2025-0002'], 'account_id' => $coa['4101'], 'dept_id' => null, 'debit' => 0,          'credit' => 2800000.00, 'created_at' => now(), 'updated_at' => now()],

            // JV-2025-0003 Utilities expense
            ['journal_id' => $journals['JV-2025-0003'], 'account_id' => $coa['5101'], 'dept_id' => null, 'debit' => 1200000.00, 'credit' => 0,          'created_at' => now(), 'updated_at' => now()],
            ['journal_id' => $journals['JV-2025-0003'], 'account_id' => $coa['1101'], 'dept_id' => null, 'debit' => 0,          'credit' => 1200000.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
