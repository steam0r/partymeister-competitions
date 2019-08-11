<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use Partymeister\Competitions\Models\CompetitionPrize;

/**
 * Class CompetitionPrizeTransformer
 * @package Partymeister\Competitions\Transformers
 */
class CompetitionPrizeTransformer extends Fractal\TransformerAbstract
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
     * @param CompetitionPrize $record
     *
     * @return array
     */
    public function transform(CompetitionPrize $record)
    {
        return [
            'id' => (int) $record->id
        ];
    }
}
