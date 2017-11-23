<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\VoteCategory;
use Partymeister\Competitions\Http\Requests\Backend\VoteCategoryRequest;
use Partymeister\Competitions\Services\VoteCategoryService;
use Partymeister\Competitions\Transformers\VoteCategoryTransformer;

class VoteCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = VoteCategoryService::collection()->getPaginator();
        $resource = $this->transformPaginator($paginator, VoteCategoryTransformer::class);

        return $this->respondWithJson('VoteCategory collection read', $resource);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VoteCategoryRequest $request)
    {
        $result = VoteCategoryService::create($request)->getResult();
        $resource = $this->transformItem($result, VoteCategoryTransformer::class);

        return $this->respondWithJson('VoteCategory created', $resource);
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(VoteCategory $record)
    {
        $result = VoteCategoryService::show($record)->getResult();
        $resource = $this->transformItem($result, VoteCategoryTransformer::class);

        return $this->respondWithJson('VoteCategory read', $resource);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VoteCategoryRequest $request, VoteCategory $record)
    {
        $result = VoteCategoryService::update($record, $request)->getResult();
        $resource = $this->transformItem($result, VoteCategoryTransformer::class);

        return $this->respondWithJson('VoteCategory updated', $resource);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoteCategory $record)
    {
        $result = VoteCategoryService::delete($record)->getResult();

        if ($result) {
            return $this->respondWithJson('VoteCategory deleted', ['success' => true]);
        }
        return $this->respondWithJson('VoteCategory NOT deleted', ['success' => false]);
    }
}