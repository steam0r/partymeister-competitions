<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use Partymeister\Competitions\Models\OptionGroup;

class OptionGroupTransformer extends Fractal\TransformerAbstract
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [ 'options' ];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [ 'options' ];


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
            'id'   => (int) $record->id,
            'type' => $record->type,
            'name' => $record->name
        ];
    }


    /**
     * Include Options
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeOptions(OptionGroup $record)
    {
        $options = $record->options;
        if ( ! is_null($options)) {
            return $this->collection($options, new OptionTransformer());
        }
    }

}
