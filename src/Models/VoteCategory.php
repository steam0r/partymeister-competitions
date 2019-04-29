<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Searchable;
use Motor\Core\Traits\Filterable;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;

/**
 * Partymeister\Competitions\Models\VoteCategory
 *
 * @property int $id
 * @property string $name
 * @property int $points
 * @property int $has_negative
 * @property int $has_comment
 * @property int $has_special_vote
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Partymeister\Competitions\Models\Competition[] $competitions
 * @property-read \Motor\Backend\Models\User $creator
 * @property-read \Motor\Backend\Models\User|null $eraser
 * @property-read \Motor\Backend\Models\User $updater
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory filteredBy(\Motor\Core\Filter\Filter $filter, $column)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory filteredByMultiple(\Motor\Core\Filter\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory search($q, $full_text = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereHasComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereHasNegative($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereHasSpecialVote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\VoteCategory whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class VoteCategory extends Model
{
    use Searchable;
	use Filterable;
    use Blameable, CreatedBy, UpdatedBy, DeletedBy;

    /**
     * Columns for the Blameable trait
     *
     * @var array
     */
    protected $blameable = array('created', 'updated', 'deleted');

    /**
     * Searchable columns for the searchable trait
     *
     * @var array
     */
    protected $searchableColumns = [
        'name'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'points',
        'has_negative',
        'has_comment',
        'has_special_vote',
    ];

    public function competitions()
    {
        return $this->belongsToMany(Competition::class);
    }
}
