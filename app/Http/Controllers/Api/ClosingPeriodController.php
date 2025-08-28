<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClosingPeriodRequest;
use App\Http\Resources\ClosingPeriodResource;
use App\Models\ClosingPeriod;

class ClosingPeriodController extends Controller
{
    public function index()
    {
        return ClosingPeriodResource::collection(ClosingPeriod::paginate(10));
    }

    public function store(ClosingPeriodRequest $request)
    {
        $period = ClosingPeriod::create($request->validated());

        return (new ClosingPeriodResource($period))
            ->response()
            ->setStatusCode(201);
    }

    public function show(ClosingPeriod $closingPeriod)
    {
        return new ClosingPeriodResource($closingPeriod);
    }

    public function update(ClosingPeriodRequest $request, ClosingPeriod $closingPeriod)
    {
        $data = $request->validated();

        $isLocked = $data['is_locked'] == '1';
        $data['locked_at'] = $isLocked ? now() : null;

        $closingPeriod->update($data);

        return new ClosingPeriodResource($closingPeriod);
    }

    public function destroy(ClosingPeriod $closingPeriod)
    {
        $closingPeriod->delete();

        return response()->noContent();
    }
}
