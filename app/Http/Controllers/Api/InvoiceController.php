<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        return InvoiceResource::collection(Invoice::with('payments')->paginate(10));
    }

    public function store(InvoiceRequest $request)
    {
        $invoice = Invoice::create($request->validated());

        return (new InvoiceResource($invoice->load('payments')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice->load('payments'));
    }

    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());

        return new InvoiceResource($invoice->load('payments'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->noContent();
    }
}
