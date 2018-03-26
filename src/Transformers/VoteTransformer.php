<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use Partymeister\Competitions\Models\Vote;

class VoteTransformer extends Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];


    /**
     * Transform record to array
     *
     * @param Vote $record
     *
     * @return array
     */
    public function transform(Vote $record)
    {
        return [
            'id'        => (int) $record->id
        ];
    }
}
