<?php

namespace Partymeister\Competitions\Transformers\Vote;

use League\Fractal;
use Partymeister\Competitions\Models\Vote;

class ResultsTransformer extends Fractal\TransformerAbstract
{
    /**
     * Transform record to array
     *
     * @param Vote $record
     *
     * @return array
     */
    public function transform($data)
    {
        return $data;
    }
}
