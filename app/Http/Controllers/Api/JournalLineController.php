<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JournalLineRequest;
use App\Http\Resources\JournalLineResource;
use App\Models\JournalLine;

class JournalLineController extends Controller
{
    public function index()
    {
        return JournalLineResource::collection(JournalLine::with(['journal', 'account'])->paginate(10));
    }

    public function store(JournalLineRequest $request)
    {
        $line = JournalLine::create($request->validated());

        return (new JournalLineResource($line->load(['journal', 'account'])))
            ->response()
            ->setStatusCode(201);
    }

    public function show(JournalLine $journalLine)
    {
        return new JournalLineResource($journalLine->load(['journal', 'account']));
    }

    public function update(JournalLineRequest $request, JournalLine $journalLine)
    {
        $journalLine->update($request->validated());

        return new JournalLineResource($journalLine->load(['journal', 'account']));
    }

    public function destroy(JournalLine $journalLine)
    {
        $journalLine->delete();

        return response()->noContent();
    }
}
