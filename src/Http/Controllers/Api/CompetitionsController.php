<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Motor\Backend\Http\Controllers\Controller;
use Partymeister\Competitions\Http\Requests\Backend\CompetitionRequest;
use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Services\CompetitionService;
use Partymeister\Competitions\Transformers\CompetitionTransformer;

/**
 * Class CompetitionsController
 * @package Partymeister\Competitions\Http\Controllers\Api
 */
class CompetitionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = CompetitionService::collection()->getPaginator();
        $resource  = $this->transformPaginator($paginator, CompetitionTransformer::class);

        return $this->respondWithJson('Competition collection read', $resource);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CompetitionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CompetitionRequest $request)
    {
        $result   = CompetitionService::create($request)->getResult();
        $resource = $this->transformItem($result, CompetitionTransformer::class);

        return $this->respondWithJson('Competition created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param Competition $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Competition $record)
    {
        $result   = CompetitionService::show($record)->getResult();
        $resource = $this->transformItem($result, CompetitionTransformer::class);

        return $this->respondWithJson('Competition read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param CompetitionRequest $request
     * @param Competition        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CompetitionRequest $request, Competition $record)
    {
        $result   = CompetitionService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, CompetitionTransformer::class);

        return $this->respondWithJson('Competition updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Competition $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Competition $record)
    {
        $result = CompetitionService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('Competition deleted', [ 'success' => true ]);
        }

        return $this->respondWithJson('Competition NOT deleted', [ 'success' => false ]);
    }
}
