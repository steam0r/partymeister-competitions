<?php

namespace Partymeister\Competitions\Models\Component;

use Motor\CMS\Models\ComponentBaseModel;
use Motor\CMS\Models\Navigation;

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
