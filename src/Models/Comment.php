<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Partymeister\Core\Models\Visitor;

class Comment extends Model
{
    /**
     * Get all of the owning commentable models.
     */
    public function model()
    {
        return $this->morphTo();
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

}