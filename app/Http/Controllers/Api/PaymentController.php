<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        return PaymentResource::collection(Payment::with('invoice')->paginate(10));
    }

    public function store(PaymentRequest $request)
    {
        $payment = Payment::create($request->validated());

        return (new PaymentResource($payment->load('invoice')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Payment $payment)
    {
        return new PaymentResource($payment->load('invoice'));
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());

        return new PaymentResource($payment->load('invoice'));
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->noContent();
    }
}
