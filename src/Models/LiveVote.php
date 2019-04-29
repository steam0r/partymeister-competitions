<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Partymeister\Competitions\Models\LiveVote
 *
 * @property int $id
 * @property int $competition_id
 * @property int $entry_id
 * @property int $sort_position
 * @property string $title
 * @property string $author
 * @property int $is_current
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Partymeister\Competitions\Models\Competition $competition
 * @property-read \Partymeister\Competitions\Models\Entry $entry
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote whereIsCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote whereSortPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\LiveVote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LiveVote extends Model {

	/**
	 * Searchable columns for the searchable trait
	 *
	 * @var array
	 */
	protected $searchableColumns = [
	];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'competition_id',
		'entry_id',
		'sort_position',
		'title',
		'author',
	];

	public function competition()
	{
		return $this->belongsTo(Competition::class);
	}

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }

}
