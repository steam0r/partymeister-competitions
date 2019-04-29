<?php

namespace Partymeister\Competitions\Models\Component;

use Motor\CMS\Models\ComponentBaseModel;
use Motor\CMS\Models\Navigation;

/**
 * Partymeister\Competitions\Models\Component\ComponentEntryScreenshot
 *
 * @property int $id
 * @property int|null $entries_page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Motor\CMS\Models\PageVersionComponent[] $component
 * @property-read \Motor\CMS\Models\Navigation|null $entries_page
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryScreenshot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryScreenshot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryScreenshot query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryScreenshot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryScreenshot whereEntriesPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryScreenshot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryScreenshot whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ComponentEntryScreenshot extends ComponentBaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entries_page_id',
    ];


    /**
     * Preview function for the page editor
     *
     * @return mixed
     */
    public function preview()
    {
        return [
            'name'    => trans('partymeister-competitions::component/entry-screenshots.component'),
            'preview' => 'Preview for ComponentEntryScreenshot component'
        ];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entries_page()
    {
        return $this->belongsTo(Navigation::class, 'entries_page_id');
    }
}
