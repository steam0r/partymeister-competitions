<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\AccessKey;
use Partymeister\Competitions\Http\Requests\Backend\AccessKeyRequest;
use Partymeister\Competitions\Services\AccessKeyService;
use Partymeister\Competitions\Transformers\AccessKeyTransformer;

class AccessKeysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = AccessKeyService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, AccessKeyTransformer::class);

        return $this->respondWithJson('AccessKey collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccessKeyRequest $request)
    {
        $result = AccessKeyService::create($request)->getResult();
        $resource = $this->transformItem($result, AccessKeyTransformer::class);

        return $this->respondWithJson('AccessKey created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(AccessKey $record)
    {
        $result = AccessKeyService::show($record)->getResult();
        $resource = $this->transformItem($result, AccessKeyTransformer::class);

        return $this->respondWithJson('AccessKey read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccessKeyRequest $request, AccessKey $record)
    {
        $result = AccessKeyService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, AccessKeyTransformer::class);

        return $this->respondWithJson('AccessKey updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessKey $record)
    {
        $result = AccessKeyService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('AccessKey deleted', ['success' => true]);
        }
        return $this->respondWithJson('AccessKey NOT deleted', ['success' => false]);
    }
}