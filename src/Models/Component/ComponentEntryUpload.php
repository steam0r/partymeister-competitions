<?php

namespace Partymeister\Competitions\Models\Component;

use Motor\CMS\Models\ComponentBaseModel;
use Motor\CMS\Models\Navigation;

/**
 * Partymeister\Competitions\Models\Component\ComponentEntryUpload
 *
 * @property int $id
 * @property int|null $entries_page_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Motor\CMS\Models\PageVersionComponent[] $component
 * @property-read \Motor\CMS\Models\Navigation|null $entries_page
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryUpload newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryUpload newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryUpload query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryUpload whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryUpload whereEntriesPageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryUpload whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Component\ComponentEntryUpload whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ComponentEntryUpload extends ComponentBaseModel
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
            'name'    => trans('partymeister-competitions::component/entry-uploads.component'),
            'preview' => 'Preview for ComponentEntryUpload component'
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
