<?php

namespace Partymeister\Competitions\Models\Component;

use Motor\CMS\Models\ComponentBaseModel;
use Motor\CMS\Models\Navigation;

class ComponentEntry extends ComponentBaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entry_comments_page_id',
        'entry_screenshots_page_id',
        'entry_edit_page_id',
        'entry_detail_page_id',
    ];


    /**
     * Preview function for the page editor
     *
     * @return mixed
     */
    public function preview()
    {
        return [
            'name'    => trans('partymeister-competitions::component/entries.component'),
            'preview' => 'Preview for ComponentEntry component'
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entry_comments_page()
    {
        return $this->belongsTo(Navigation::class, 'entry_comments_page_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entry_screenshots_page()
    {
        return $this->belongsTo(Navigation::class, 'entry_screenshots_page_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entry_edit_page()
    {
        return $this->belongsTo(Navigation::class, 'entry_edit_page_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entry_detail_page()
    {
        return $this->belongsTo(Navigation::class, 'entry_detail_page_id');
    }
}
