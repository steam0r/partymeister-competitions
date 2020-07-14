<?php

namespace Partymeister\Competitions\Transformers\Entry;

use Motor\Backend\Helpers\Filesize;
use Partymeister\Competitions\Models\Entry;
use Spatie\MediaLibrary\Models\Media;

class JsonTransformer extends \Partymeister\Competitions\Transformers\EntryTransformer
{

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
            'playable_file_name' => $record->playable_file_name,
        ];
    }
}
