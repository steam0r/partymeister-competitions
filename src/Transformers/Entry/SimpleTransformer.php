<?php

namespace Partymeister\Competitions\Transformers\Entry;

use Illuminate\Support\Collection;
use League\Fractal;
use League\Fractal\ParamBag;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Models\Vote;

class SimpleTransformer extends Fractal\TransformerAbstract
{

    private $validParams = [
        'visitor_id',
        'vote_category_id'
    ];

    protected $availableIncludes = [
        'vote'
    ];


    public function includeVote(Entry $entry, ParamBag $params)
    {
        $voteCategory = null;
        if ($entry->competition->vote_categories->count() > 0) {
            $voteCategory = $entry->competition->vote_categories[0];
        }

        if (is_null($voteCategory)) {
            $votes = new Collection();
        } else {
            $votes = Vote::where('entry_id', $entry->id)
                ->where('vote_category_id', $voteCategory->id)
                ->where('visitor_id', $params->get('visitor_id'))
                ->get();
        }

        return $this->collection($votes, new \Partymeister\Competitions\Transformers\Vote\SimpleTransformer());
    }


    public function transform(Entry $entry)
    {
        $deadline = false;
        if (time() > strtotime(config('partymeister-competitions-voting.deadline'))) {
            $deadline = true;
        }

        $voteCategory = null;
        if ($entry->competition->vote_categories->count() > 0) {
            $voteCategory = $entry->competition->vote_categories[0];
        }

        $data = [
            'id'                             => (int) $entry->id,
            'entry_number'                   => (int) $entry->sort_position,
            'title'                          => $entry->title,
            'author'                         => $entry->author,
            'description'                    => $entry->description,
            'orga_description'               => $entry->organizer_description,
            'running_time'                   => $entry->running_time,
            'filesize'                       => $entry->filesize,
            'platform'                       => $entry->platform,
            'remote_entry'                   => (bool) $entry->is_remote,
            'anonymous'                      => (bool) $entry->competition->competition_type->is_anonymous,
            'status'                         => (int) $entry->status,
            'screenshot'                     => [],
            'mp3'                            => [],
            'audio_preview'                  => false,
            'competition'                    => $entry->competition->name,
            'competition_id'                 => (int) $entry->competition->id,
            'deadline_reached'               => $deadline,
            'vote_category_has_comment'      => (bool) ( ! is_null($voteCategory) ? $voteCategory->has_comment : false ),
            'vote_category_has_special_vote' => (bool) ( ! is_null($voteCategory) ? $voteCategory->has_special_vote : false ),
            'vote_category_has_negative'     => (bool) ( ! is_null($voteCategory) ? $voteCategory->has_negative : false ),
            'vote_category_points'           => (int) ( ! is_null($voteCategory) ? $voteCategory->points : 0 ),
            'vote_category_id'               => (int) ( ! is_null($voteCategory) ? $voteCategory->id : 1 ),
        ];

        if ($entry->getFirstMedia('screenshot')) {
            $media              = $entry->getFirstMedia('screenshot');
            $data['screenshot'] = [
                'name'      => $media->file_name,
                'mime_type' => $media->mime_type,
                'size'      => $media->file_size,
                'url'       => asset($media->getUrl())
            ];
        }

        if ($entry->getFirstMedia('audio')) {
            $data['audio_preview'] = true;
            $media                 = $entry->getFirstMedia('audio');
            $data['mp3']           = [
                'name'      => $media->file_name,
                'mime_type' => $media->mime_type,
                'size'      => $media->file_size,
                'url'       => asset($media->getUrl())
            ];
        }

        return $data;
    }
}
