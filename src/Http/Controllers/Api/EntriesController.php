<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Http\Requests\Backend\EntryRequest;
use Partymeister\Competitions\Services\EntryService;
use Partymeister\Competitions\Transformers\EntryTransformer;

class EntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = EntryService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, EntryTransformer::class);

        return $this->respondWithJson('Entry collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EntryRequest $request)
    {
        $result = EntryService::create($request)->getResult();
        $resource = $this->transformItem($result, EntryTransformer::class);

        return $this->respondWithJson('Entry created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $record)
    {
        $result = EntryService::show($record)->getResult();
        $resource = $this->transformItem($result, EntryTransformer::class);

        return $this->respondWithJson('Entry read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EntryRequest $request, Entry $record)
    {
        $result = EntryService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, EntryTransformer::class);

        return $this->respondWithJson('Entry updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $record)
    {
        $result = EntryService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Entry deleted', ['success' => true]);
        }
        return $this->respondWithJson('Entry NOT deleted', ['success' => false]);
    }
}