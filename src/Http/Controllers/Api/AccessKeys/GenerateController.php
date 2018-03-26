<?php

namespace Partymeister\Competitions\Http\Controllers\Api\AccessKeys;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Http\Requests\Backend\AccessKeyRequest;
use Partymeister\Competitions\Services\AccessKeyService;

class GenerateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AccessKeyRequest $request)
    {
        AccessKeyService::generate($request);

        return response()->json(['message' => 'Generated '.$request->get('quantity').' access keys']);
    }
}
