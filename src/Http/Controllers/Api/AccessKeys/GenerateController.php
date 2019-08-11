<?php

namespace Partymeister\Competitions\Http\Controllers\Api\AccessKeys;

use Illuminate\Http\Response;
use Motor\Backend\Http\Controllers\Controller;
use Partymeister\Competitions\Http\Requests\Backend\AccessKeyRequest;
use Partymeister\Competitions\Services\AccessKeyService;

/**
 * Class GenerateController
 * @package Partymeister\Competitions\Http\Controllers\Api\AccessKeys
 */
class GenerateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param AccessKeyRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(AccessKeyRequest $request)
    {
        AccessKeyService::generate($request);

        return response()->json([ 'message' => 'Generated ' . $request->get('quantity') . ' access keys' ]);
    }
}
