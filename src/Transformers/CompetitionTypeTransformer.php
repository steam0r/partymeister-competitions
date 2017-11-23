<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use Partymeister\Competitions\Models\CompetitionType;

class CompetitionTypeTransformer extends Fractal\TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [ 'competitions' ];


    /**
     * Transform record to array
     *
     * @param CompetitionType $record
     *
     * @return array
     */
    public function transform(CompetitionType $record)
    {
        return [
            'id'                 => (int) $record->id,
            'name'               => $record->name,
            'has_platform'       => (bool) $record->has_platform,
            'has_filesize'       => (bool) $record->has_filesize,
            'has_screenshot'     => (bool) $record->has_screenshot,
            'has_video'          => (bool) $record->has_video,
            'has_audio'          => (bool) $record->has_audio,
            'has_recordings'     => (bool) $record->has_recordings,
            'has_composer'       => (bool) $record->has_composer,
            'has_running_time'   => (bool) $record->has_running_time,
            'is_anonymous'       => (bool) $record->is_anonymous,
            'has_remote_entries' => (bool) $record->has_remote_entries,
            'file_is_optional'   => (bool) $record->file_is_optional
        ];
    }


    /**
     * Include competitions
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeOptions(CompetitionType $record)
    {
        $competitions = $record->competitions;
        if ( ! is_null($competitions)) {
            return $this->collection($competitions, new CompetitionTransformer());
        }
    }
}
