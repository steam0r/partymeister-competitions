<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use League\Fractal\Resource\Collection;
use Partymeister\Competitions\Models\OptionGroup;

/**
 * Class OptionGroupTransformer
 * @package Partymeister\Competitions\Transformers
 */
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
     * Include options
     *
     * @param OptionGroup $record
     * @return Collection
     */
    public function includeOptions(OptionGroup $record)
    {
        $options = $record->options;
        if ( ! is_null($options)) {
            return $this->collection($options, new OptionTransformer());
        }
    }

}
