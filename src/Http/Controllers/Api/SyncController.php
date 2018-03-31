<?php

namespace Partymeister\Competitions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\AccessKey;
use Partymeister\Competitions\Http\Requests\Backend\AccessKeyRequest;
use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Models\LiveVote;
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

    public function livevote(Request $request)
    {
        $data = $request->get('data');

        if (!array_get($data, 'entry_id')) {
            return response()->json('Error', 403);
        }

        $liveVote = LiveVote::first();

        if (is_null($liveVote)) {
            $liveVote = new LiveVote();
        }
        $liveVote->competition_id = array_get($data, 'competition_id');
        $liveVote->entry_id = array_get($data, 'entry_id');
        $liveVote->sort_position = array_get($data, 'sort_position');
        $liveVote->save();
    }

    public function entry(Request $request)
    {
        $data = $request->get('data');

        if (!array_get($data, 'id')) {
            return response()->json('Error', 403);
        }

        $entry = Entry::find(array_get($data, 'id'));
        if (is_null($entry)) {
            $entry = new Entry();
        }
        $entry->competition_id = array_get($data, 'competition_id');
        $entry->title = array_get($data, 'title');
        $entry->description = array_get($data, 'description');
        $entry->author = array_get($data, 'author');
        $entry->sort_position = array_get($data, 'sort_position');
        $entry->status = array_get($data, 'status');
        $entry->is_remote = array_get($data, 'is_remote');
        $entry->save();


        $screenshot = array_get($data, 'screenshot.file_base64', null);
        if (!is_null($screenshot)) {
            file_put_contents(storage_path().'/'.array_get($data, 'screenshot.file_name'), base64_decode($screenshot));
            $entry->addMedia(storage_path().'/'.array_get($data, 'screenshot.file_name'))->toMediaCollection('screenshot', 'media');
        }

        $audio = array_get($data, 'audio.file_base64', null);
        if (!is_null($audio)) {
            file_put_contents(storage_path().'/'.array_get($data, 'audio.file_name'), base64_decode($audio));
            $entry->addMedia(storage_path().'/'.array_get($data, 'audio.file_name'))->toMediaCollection('audio', 'media');
        }

        if ($entry->id != array_get($data, 'id')) {
            $entry->id = array_get($data, 'id');
            $entry->save();
        }
    }

}
