<?php

namespace Partymeister\Competitions\Transformers\Vote;

use League\Fractal;
use Partymeister\Competitions\Models\Vote;

/**
 * Class ResultsTransformer
 * @package Partymeister\Competitions\Transformers\Vote
 */
class ResultsTransformer extends Fractal\TransformerAbstract
{

    /**
     * Transform record to array
     *
     * @param $data
     * @return mixed
     */
    public function transform($data)
    {
        return $data;
    }
}
