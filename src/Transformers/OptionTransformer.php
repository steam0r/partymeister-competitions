<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use Partymeister\Competitions\Models\OptionGroup;

class OptionTransformer extends Fractal\TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [ ];


    /**
     * Transform record to array
     *
     * @param OptionGroup $record
     *
     * @return array
     */
    public function transform(OptionGroup $record)
    {
        return [
            'id'            => (int) $record->id,
            'name'          => $record->name,
            'sort_position' => (int) $record->sort_position
        ];
    }
}
