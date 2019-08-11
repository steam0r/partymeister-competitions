<?php

namespace Partymeister\Competitions\Transformers;

use League\Fractal;
use Partymeister\Competitions\Models\AccessKey;

/**
 * Class AccessKeyTransformer
 * @package Partymeister\Competitions\Transformers
 */
class AccessKeyTransformer extends Fractal\TransformerAbstract
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
     * @param AccessKey $record
     *
     * @return array
     */
    public function transform(AccessKey $record)
    {
        return [
            'id' => (int) $record->id
        ];
    }
}
