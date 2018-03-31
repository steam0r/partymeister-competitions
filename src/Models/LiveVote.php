<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;

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
