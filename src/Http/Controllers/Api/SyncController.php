<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\AccessKey;
use Partymeister\Competitions\Http\Requests\Backend\AccessKeyRequest;
use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Services\AccessKeyService;
use Partymeister\Competitions\Transformers\AccessKeyTransformer;

class SyncController extends Controller
{
    public function competition(Request $request)
    {
        $data = $request->get('data');

        if (!array_get($data, 'id')) {
            return response()->json('Error', 403);
        }

        $competition = Competition::find(array_get($data, 'id'));
        if (is_null($competition)) {
            $competition = new Competition();
        }
        $competition->competition_type_id = array_get($data, 'competition_type_id');
        $competition->name = array_get($data, 'name');
        $competition->sort_position = array_get($data, 'sort_position');
        $competition->prizegiving_sort_position = array_get($data, 'prizegiving_sort_position');
        $competition->has_prizegiving = array_get($data, 'has_prizegiving');
        $competition->upload_enabled = array_get($data, 'upload_enabled');
        $competition->voting_enabled = array_get($data, 'voting_enabled');
        $competition->save();

        if ($competition->id != array_get($data, 'id')) {
            $competition->id = array_get($data, 'id');
            $competition->save();
        }
    }

    public function entry(Request $request)
    {
        var_dump($request->all());
    }

}
