<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrialBalanceRequest;
use Illuminate\Http\Request;
use App\Services\TrialBalanceService;
use Barryvdh\DomPDF\Facade\Pdf;

class TrialBalanceController extends Controller
{
    protected $service;

    public function __construct(TrialBalanceService $service)
    {
        $this->service = $service;
    }

    public function index(TrialBalanceRequest $request)
    {
        $request->validated();

        $data = $this->service->generateTrialBalance($request->start_date, $request->end_date);

        return response()->json([
            'period' => "{$request->start_date} to {$request->end_date}",
            'data' => $data
        ]);
    }

    public function pdf(TrialBalanceRequest $request)
    {
        $request->validated();

        $data = $this->service->generateTrialBalance($request->start_date, $request->end_date);

        $pdf = Pdf::loadView('trial_balance.pdf', [
            'data' => $data,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        return $pdf->stream('trial_balance_' . $request->start_date . '_' . $request->end_date . '.pdf');
    }
}
