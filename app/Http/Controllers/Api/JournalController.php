<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JournalRequest;
use App\Http\Resources\JournalResource;
use App\Models\Journal;

class JournalController extends Controller
{
    public function index()
    {
        return JournalResource::collection(Journal::with('lines.account')->paginate(10));
    }

    public function store(JournalRequest $request)
    {
        $journal = Journal::create($request->validated());

        if ($request->has('lines')) {
            foreach ($request->lines as $line) {
                $journal->lines()->create($line);
            }
        }

        return (new JournalResource($journal->load('lines.account')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Journal $journal)
    {
        return new JournalResource($journal->load('lines.account'));
    }

    public function update(JournalRequest $request, Journal $journal)
    {
        $journal->update($request->validated());

        return new JournalResource($journal->load('lines.account'));
    }

    public function destroy(Journal $journal)
    {
        $journal->delete();

        return response()->noContent();
    }
}
