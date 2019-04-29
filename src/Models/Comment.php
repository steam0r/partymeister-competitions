<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Partymeister\Core\Models\Visitor;

/**
 * Partymeister\Competitions\Models\Comment
 *
 * @property int $id
 * @property int|null $visitor_id
 * @property int $read_by_visitor
 * @property int $read_by_organizer
 * @property string $model_type
 * @property int $model_id
 * @property string $message
 * @property string $author
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read \Partymeister\Core\Models\Visitor|null $visitor
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereReadByOrganizer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereReadByVisitor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Comment whereVisitorId($value)
 * @mixin \Eloquent
 */
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