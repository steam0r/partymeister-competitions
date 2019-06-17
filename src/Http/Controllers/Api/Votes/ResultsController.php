<?php

namespace Partymeister\Competitions\Http\Controllers\Api\Votes;

use Illuminate\Support\Collection;
use Motor\Backend\Http\Controllers\Controller;
use Partymeister\Competitions\Services\VoteService;
use Partymeister\Competitions\Transformers\Vote\ResultsTransformer;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = VoteService::getAllVotesByRank();
        $special = VoteService::getAllSpecialVotesByRank();

        $transformedResults = $this->transformCollection($results, ResultsTransformer::class);
        $resultsData = $this->fractal->createData($transformedResults)->toArray();

        $transformedSpecialResults = $this->transformCollection($special, ResultsTransformer::class);
        $specialData = $this->fractal->createData($transformedSpecialResults)->toArray();

        return $this->respondWithJson('Results read', ['results' => $resultsData['data'], 'special' => $specialData['data']]);
    }
}