<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $invoices = Invoice::pluck('id','invoice_no');

        Payment::insert([
            [
                'invoice_id'  => $invoices['INV-2025-0005'],
                'payment_ref' => 'PAY-2025-001',
                'paid_at'     => '2025-07-12',
                'amount_paid' => 1000000.00,
                'method'      => 'Bank Transfer',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'invoice_id'  => $invoices['INV-2025-0005'],
                'payment_ref' => 'PAY-2025-002',
                'paid_at'     => '2025-07-22',
                'amount_paid' => 800000.00,
                'method'      => 'Cash',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'invoice_id'  => $invoices['INV-2025-0007'],
                'payment_ref' => 'PAY-2025-003',
                'paid_at'     => '2025-07-28',
                'amount_paid' => 555000.00,
                'method'      => 'Bank Transfer',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
