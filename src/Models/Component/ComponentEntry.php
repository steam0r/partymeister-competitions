<?php

namespace Partymeister\Competitions\Models\Component;

use Motor\CMS\Models\ComponentBaseModel;
use Motor\CMS\Models\Navigation;

/**
 * Partymeister\Competitions\Models\Component\ComponentEntry
 *
 * @property int $id
 * @property int|null $entry_comments_page_id
 * @property int|null $entry_screenshots_page_id
 * @property int|null $entry_edit_page_id
 * @property int|null $entry_detail_page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Motor\CMS\Models\PageVersionComponent[] $component
 * @property-read \Motor\CMS\Models\Navigation|null $entry_comments_page
 * @property-read \Motor\CMS\Models\Navigation|null $entry_detail_page
 * @property-read \Motor\CMS\Models\Navigation|null $entry_edit_page
 * @property-read \Motor\CMS\Models\Navigation|null $entry_screenshots_page
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry whereEntryCommentsPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry whereEntryDetailPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry whereEntryEditPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry whereEntryScreenshotsPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
