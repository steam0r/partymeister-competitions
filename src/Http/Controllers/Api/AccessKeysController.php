<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Motor\Backend\Http\Controllers\Controller;
use Partymeister\Competitions\Http\Requests\Backend\AccessKeyRequest;
use Partymeister\Competitions\Models\AccessKey;
use Partymeister\Competitions\Services\AccessKeyService;
use Partymeister\Competitions\Transformers\AccessKeyTransformer;

/**
 * Class AccessKeysController
 * @package Partymeister\Competitions\Http\Controllers\Api
 */
class AccessKeysController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $paginator = AccessKeyService::collection()->getPaginator();
        $resource  = $this->transformPaginator($paginator, AccessKeyTransformer::class);

        return $this->respondWithJson('AccessKey collection read', $resource);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param AccessKeyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AccessKeyRequest $request)
    {
        $result   = AccessKeyService::create($request)->getResult();
        $resource = $this->transformItem($result, AccessKeyTransformer::class);

        return $this->respondWithJson('AccessKey created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param AccessKey $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(AccessKey $record)
    {
        $result   = AccessKeyService::show($record)->getResult();
        $resource = $this->transformItem($result, AccessKeyTransformer::class);

        return $this->respondWithJson('AccessKey read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param AccessKeyRequest $request
     * @param AccessKey        $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AccessKeyRequest $request, AccessKey $record)
    {
        $result   = AccessKeyService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, AccessKeyTransformer::class);

        return $this->respondWithJson('AccessKey updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param AccessKey $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AccessKey $record)
    {
        $result = AccessKeyService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('AccessKey deleted', [ 'success' => true ]);
        }

        return $this->respondWithJson('AccessKey NOT deleted', [ 'success' => false ]);
    }
}