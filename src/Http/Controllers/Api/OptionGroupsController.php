<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Motor\Backend\Http\Controllers\Controller;
use Partymeister\Competitions\Http\Requests\Backend\OptionGroupRequest;
use Partymeister\Competitions\Models\OptionGroup;
use Partymeister\Competitions\Services\OptionGroupService;
use Partymeister\Competitions\Transformers\OptionGroupTransformer;

/**
 * Class OptionGroupsController
 * @package Partymeister\Competitions\Http\Controllers\Api
 */
class OptionGroupsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = OptionGroupService::collection()->getPaginator();
        $resource  = $this->transformPaginator($paginator, OptionGroupTransformer::class);

        return $this->respondWithJson('OptionGroup collection read', $resource);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param OptionGroupRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OptionGroupRequest $request)
    {
        $result   = OptionGroupService::create($request)->getResult();
        $resource = $this->transformItem($result, OptionGroupTransformer::class);

        return $this->respondWithJson('OptionGroup created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param OptionGroup $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(OptionGroup $record)
    {
        $result   = OptionGroupService::show($record)->getResult();
        $resource = $this->transformItem($result, OptionGroupTransformer::class);

        return $this->respondWithJson('OptionGroup read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param OptionGroupRequest $request
     * @param OptionGroup        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OptionGroupRequest $request, OptionGroup $record)
    {
        $result   = OptionGroupService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, OptionGroupTransformer::class);

        return $this->respondWithJson('OptionGroup updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param OptionGroup $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(OptionGroup $record)
    {
        $result = OptionGroupService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('OptionGroup deleted', [ 'success' => true ]);
        }

        return $this->respondWithJson('OptionGroup NOT deleted', [ 'success' => false ]);
    }
}