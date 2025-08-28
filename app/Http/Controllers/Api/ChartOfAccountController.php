<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChartOfAccountRequest;
use App\Http\Resources\ChartOfAccountResource;
use App\Models\ChartOfAccount;

class ChartOfAccountController extends Controller
{
    public function index()
    {
        return ChartOfAccountResource::collection(ChartOfAccount::paginate(10));
    }

    public function store(ChartOfAccountRequest $request)
    {
        $coa = ChartOfAccount::create($request->validated());

        return (new ChartOfAccountResource($coa))
            ->response()
            ->setStatusCode(201);
    }

    public function show(ChartOfAccount $chartOfAccount)
    {
        return new ChartOfAccountResource($chartOfAccount);
    }

    public function update(ChartOfAccountRequest $request, ChartOfAccount $chartOfAccount)
    {
        $chartOfAccount->update($request->validated());

        return new ChartOfAccountResource($chartOfAccount);
    }

    public function destroy(ChartOfAccount $chartOfAccount)
    {
        $chartOfAccount->delete();

        return response()->noContent();
    }
}
