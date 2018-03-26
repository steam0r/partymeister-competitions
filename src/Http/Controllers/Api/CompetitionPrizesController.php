<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\CompetitionPrize;
use Partymeister\Competitions\Http\Requests\Backend\CompetitionPrizeRequest;
use Partymeister\Competitions\Services\CompetitionPrizeService;
use Partymeister\Competitions\Transformers\CompetitionPrizeTransformer;

class CompetitionPrizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = CompetitionPrizeService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, CompetitionPrizeTransformer::class);

        return $this->respondWithJson('CompetitionPrize collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CompetitionPrizeRequest $request)
    {
        $result = CompetitionPrizeService::create($request)->getResult();
        $resource = $this->transformItem($result, CompetitionPrizeTransformer::class);

        return $this->respondWithJson('CompetitionPrize created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(CompetitionPrize $record)
    {
        $result = CompetitionPrizeService::show($record)->getResult();
        $resource = $this->transformItem($result, CompetitionPrizeTransformer::class);

        return $this->respondWithJson('CompetitionPrize read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CompetitionPrizeRequest $request, CompetitionPrize $record)
    {
        $result = CompetitionPrizeService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, CompetitionPrizeTransformer::class);

        return $this->respondWithJson('CompetitionPrize updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompetitionPrize $record)
    {
        $result = CompetitionPrizeService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('CompetitionPrize deleted', ['success' => true]);
        }
        return $this->respondWithJson('CompetitionPrize NOT deleted', ['success' => false]);
    }
}