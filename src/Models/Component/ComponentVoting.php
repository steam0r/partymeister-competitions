<?php

namespace Partymeister\Competitions\Models\Component;

use Motor\CMS\Models\ComponentBaseModel;
use Motor\CMS\Models\Navigation;

/**
 * Partymeister\Competitions\Models\Component\ComponentVoting
 *
 * @property int $id
 * @property int|null $live_voting_page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Motor\CMS\Models\PageVersionComponent[] $component
 * @property-read \Motor\CMS\Models\Navigation|null $live_voting_page
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentVoting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentVoting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentVoting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentVoting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentVoting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentVoting whereLiveVotingPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentVoting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ComponentVoting extends ComponentBaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'live_voting_page_id'
    ];

	/**
	 * Preview function for the page editor
	 *
	 * @return mixed
	 */
	public function preview()
	{
		return [
			'name'    => trans('partymeister-competitions::component/votings.component'),
			'preview' => 'Preview for ComponentVoting component'
		];
	}

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function live_voting_page()
    {
        return $this->belongsTo(Navigation::class, 'live_voting_page_id');
    }
}
