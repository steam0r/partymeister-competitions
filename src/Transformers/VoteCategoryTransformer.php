<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use Partymeister\Competitions\Models\VoteCategory;

class VoteCategoryTransformer extends Fractal\TransformerAbstract
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
     * @param VoteCategory $record
     *
     * @return array
     */
    public function transform(VoteCategory $record)
    {
        return [
            'id'        => (int) $record->id
        ];
    }
}
