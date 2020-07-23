<?php

namespace Partymeister\Competitions\Transformers\Entry;

use Illuminate\Support\Str;
use Motor\Backend\Helpers\Filesize;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Transformers\EntryTransformer;
use Spatie\MediaLibrary\Models\Media;

class JsonTransformer extends EntryTransformer
{

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'files',
        'screenshot',
        'video',
        'audio',
        'work_stages',
        'config_file',
        'options',
    ];

    /**
     * Transform record to array
     *
     * @param  Entry  $record
     *
     * @return array
     */
    public function transform(Entry $record)
    {
        return [
            'id' => (int)$record->id,
            'title' => $record->title,
            'author' => $record->author,
            'description' => $record->description,
            'filesize_bytes' => (int)$record->filesize,
            'filesize_human' => Filesize::bytesToHuman((int)$record->filesize),
            'platform' => $record->platform,
            'running_time' => $record->running_time,
            'playlist_position' => $record->sort_position,
            'custom_option' => $record->custom_option,
            'is_remote' => (bool)$record->is_remote,
            'sort_position' => (int)$record->sort_position,
            'sort_position_prefixed' => (strlen($record->sort_position) == 1 ? '0'.$record->sort_position : $record->sort_position),
            'competition_name' => $record->competition->name,
            'final_file' => Media::find($record->final_file_media_id),
            'playable_file_name'                          => $record->playable_file_name,
            'playable_file' => JsonTransformer::getPlayableFileInfo($record),
        ];
    }

    public static function getPlayableFileInfo(Entry $entry) {
        $name = $entry->playable_file_name;
        $data = new \stdClass();
        if($name) {
            $path = base_path('entries/' . Str::slug($entry->competition->name));
            $directory = '/entries/' . Str::slug($entry->competition->name);
            $entryDir = $entry->id;
            while (strlen($entryDir) < 4) {
                $entryDir = '0' . $entryDir;
            }

            $entryDir .= '/files';

            $location = $path . "/" . $entryDir . "/" . $name;
            $data->name = basename($name);
            $data->path = $location;
            $data->url = "/download/" . $directory . "/" . $entryDir . "/" . $name;

            if(file_exists($location)) {
                $data->size = \filesize($location);
                $data->created = date('Y-m-d H:i:s', filectime($location));
                $data->mime_type = mime_content_type($location);
            }
        }

        return $data;
    }

}
