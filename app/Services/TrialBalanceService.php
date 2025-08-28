<?php

namespace App\Services;

use App\Models\ChartOfAccount;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class TrialBalanceService
{
    public function generateTrialBalance(string $startDate, string $endDate): Collection
    {
        $start = Carbon::parse($startDate);
        $end   = Carbon::parse($endDate);

        $accounts = ChartOfAccount::where('is_active', true)
            ->orderBy('code')
            ->get();

        $trialBalanceData    = collect();
        $totalOpeningBalance = 0;
        $totalDebit          = 0;
        $totalCredit         = 0;
        $totalClosingBalance = 0;

        foreach ($accounts as $account) {
            $accountData = $this->calculateAccountBalance($account, $start, $end);
            $trialBalanceData->push($accountData);

            $totalOpeningBalance += $accountData['opening_balance'];
            $totalDebit          += $accountData['debit'];
            $totalCredit         += $accountData['credit'];
            $totalClosingBalance += $accountData['closing_balance'];
        }

        $trialBalanceData->push([
            'account_code'    => 'TOTAL',
            'account_name'    => '',
            'opening_balance' => $totalOpeningBalance,
            'debit'           => $totalDebit,
            'credit'          => $totalCredit,
            'closing_balance' => $totalClosingBalance,
            'is_total'        => true,
        ]);

        return $trialBalanceData;
    }

    private function calculateAccountBalance(ChartOfAccount $account, Carbon $startDate, Carbon $endDate): array
    {
        $openingBalance     = $this->getOpeningBalance($account, $startDate);
        $periodTransactions = $this->getPeriodTransactions($account, $startDate, $endDate);

        $periodDebit  = $periodTransactions['debit'];
        $periodCredit = $periodTransactions['credit'];

        $closingBalance = $this->calculateClosingBalance(
            $account->normal_balance,
            $openingBalance,
            $periodDebit,
            $periodCredit
        );

        return [
            'account_id'      => $account->id,
            'account_code'    => $account->code,
            'account_name'    => $account->name,
            'normal_balance'  => $account->normal_balance,
            'opening_balance' => $openingBalance,
            'debit'           => $periodDebit,
            'credit'          => $periodCredit,
            'closing_balance' => $closingBalance,
            'is_total'        => false,
        ];
    }

    private function getOpeningBalance(ChartOfAccount $account, Carbon $startDate): float
    {
        $journalLines = $account->journalLines()
            ->whereHas('journal', function ($query) use ($startDate) {
                $query->where('posting_date', '<', $startDate->format('Y-m-d'))
                    ->where('status', 'posted');
            })
            ->get();

        $totalDebit  = $journalLines->sum('debit');
        $totalCredit = $journalLines->sum('credit');

        return $account->normal_balance === 'DR'
            ? $totalDebit - $totalCredit
            : $totalCredit - $totalDebit;
    }

    private function getPeriodTransactions(ChartOfAccount $account, Carbon $startDate, Carbon $endDate): array
    {
        $journalLines = $account->journalLines()
            ->whereHas('journal', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('posting_date', [
                    $startDate->format('Y-m-d'),
                    $endDate->format('Y-m-d')
                ])->where('status', 'posted');
            })
            ->get();

        return [
            'debit'  => $journalLines->sum('debit'),
            'credit' => $journalLines->sum('credit'),
        ];
    }

    private function calculateClosingBalance(
        string $normalBalance,
        float $openingBalance,
        float $periodDebit,
        float $periodCredit
    ): float {
        return $normalBalance === 'DR'
            ? $openingBalance + $periodDebit - $periodCredit
            : $openingBalance + $periodCredit - $periodDebit;
    }
}
