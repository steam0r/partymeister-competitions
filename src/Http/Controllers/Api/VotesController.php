<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Motor\Backend\Http\Controllers\Controller;
use Partymeister\Competitions\Http\Requests\Backend\VoteRequest;
use Partymeister\Competitions\Models\Vote;
use Partymeister\Competitions\Services\VoteService;
use Partymeister\Competitions\Transformers\VoteTransformer;

/**
 * Class VotesController
 * @package Partymeister\Competitions\Http\Controllers\Api
 */
class VotesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = VoteService::collection()->getPaginator();
        $resource  = $this->transformPaginator($paginator, VoteTransformer::class);

        return $this->respondWithJson('Vote collection read', $resource);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param VoteRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VoteRequest $request)
    {
        $result   = VoteService::create($request)->getResult();
        $resource = $this->transformItem($result, VoteTransformer::class);

        return $this->respondWithJson('Vote created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Vote $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Vote $record)
    {
        $result   = VoteService::show($record)->getResult();
        $resource = $this->transformItem($result, VoteTransformer::class);

        return $this->respondWithJson('Vote read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param VoteRequest $request
     * @param Vote        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(VoteRequest $request, Vote $record)
    {
        $result   = VoteService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, VoteTransformer::class);

        return $this->respondWithJson('Vote updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Vote $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Vote $record)
    {
        $result = VoteService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Vote deleted', [ 'success' => true ]);
        }

        return $this->respondWithJson('Vote NOT deleted', [ 'success' => false ]);
    }
}
