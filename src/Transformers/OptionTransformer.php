<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use Partymeister\Competitions\Models\Option;

/**
 * Class OptionTransformer
 * @package Partymeister\Competitions\Transformers
 */
class OptionTransformer extends Fractal\TransformerAbstract
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
     * @param Option $record
     *
     * @return array
     */
    public function transform(Option $record)
    {
        return [
            'id'            => (int) $record->id,
            'name'          => $record->name,
            'sort_position' => (int) $record->sort_position
        ];
    }
}
