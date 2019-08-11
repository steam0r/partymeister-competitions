<?php

namespace Partymeister\Competitions\Transformers\Vote;

use League\Fractal;
use Partymeister\Competitions\Models\Vote;

/**
 * Class SimpleTransformer
 * @package Partymeister\Competitions\Transformers\Vote
 */
class SimpleTransformer extends Fractal\TransformerAbstract
{

    /**
     * @param Vote $vote
     * @return array
     */
    public function transform(Vote $vote)
    {
        return [
            'points'           => (int) $vote->points,
            'comment'          => $vote->comment,
            'special_vote'     => $vote->special_vote,
            'vote_category_id' => (int) $vote->vote_category_id,
            'vote_category'    => $vote->vote_category->name,
        ];
    }
}