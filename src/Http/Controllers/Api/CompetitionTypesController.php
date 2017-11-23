<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\CompetitionType;
use Partymeister\Competitions\Http\Requests\Backend\CompetitionTypeRequest;
use Partymeister\Competitions\Services\CompetitionTypeService;
use Partymeister\Competitions\Transformers\CompetitionTypeTransformer;

class CompetitionTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = CompetitionTypeService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, CompetitionTypeTransformer::class);

        return $this->respondWithJson('CompetitionType collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CompetitionTypeRequest $request)
    {
        $result = CompetitionTypeService::create($request)->getResult();
        $resource = $this->transformItem($result, CompetitionTypeTransformer::class);

        return $this->respondWithJson('CompetitionType created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(CompetitionType $record)
    {
        $result = CompetitionTypeService::show($record)->getResult();
        $resource = $this->transformItem($result, CompetitionTypeTransformer::class);

        return $this->respondWithJson('CompetitionType read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CompetitionTypeRequest $request, CompetitionType $record)
    {
        $result = CompetitionTypeService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, CompetitionTypeTransformer::class);

        return $this->respondWithJson('CompetitionType updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompetitionType $record)
    {
        $result = CompetitionTypeService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('CompetitionType deleted', ['success' => true]);
        }
        return $this->respondWithJson('CompetitionType NOT deleted', ['success' => false]);
    }
}