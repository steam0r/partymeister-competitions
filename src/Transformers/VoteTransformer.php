<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use Partymeister\Competitions\Models\Vote;

/**
 * Class VoteTransformer
 * @package Partymeister\Competitions\Transformers
 */
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
            'id' => (int) $record->id
        ];
    }
}
