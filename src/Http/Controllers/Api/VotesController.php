<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\Vote;
use Partymeister\Competitions\Http\Requests\Backend\VoteRequest;
use Partymeister\Competitions\Services\VoteService;
use Partymeister\Competitions\Transformers\VoteTransformer;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = VoteService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, VoteTransformer::class);

        return $this->respondWithJson('Vote collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VoteRequest $request)
    {
        $result = VoteService::create($request)->getResult();
        $resource = $this->transformItem($result, VoteTransformer::class);

        return $this->respondWithJson('Vote created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $record)
    {
        $result = VoteService::show($record)->getResult();
        $resource = $this->transformItem($result, VoteTransformer::class);

        return $this->respondWithJson('Vote read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VoteRequest $request, Vote $record)
    {
        $result = VoteService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, VoteTransformer::class);

        return $this->respondWithJson('Vote updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $record)
    {
        $result = VoteService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Vote deleted', ['success' => true]);
        }
        return $this->respondWithJson('Vote NOT deleted', ['success' => false]);
    }
}