<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Searchable;
use Motor\Core\Traits\Filterable;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Motor\Media\Models\FileAssociation;
use Partymeister\Competitions\Forms\Backend\CompetitionPrizeForm;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class Competition extends Model implements HasMediaConversions
{

    use HasMediaTrait;
    use Searchable;
    use Filterable;
    use Blameable, CreatedBy, UpdatedBy, DeletedBy;

    /**
     * Columns for the Blameable trait
     *
     * @var array
     */
    protected $blameable = [ 'created', 'updated', 'deleted' ];

    /**
     * Searchable columns for the searchable trait
     *
     * @var array
     */
    protected $searchableColumns = [
        'competitions.name',
        'competition_type.name'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'competition_type_id',
        'has_prizegiving',
        'sort_position',
        'prizegiving_sort_position',
        'upload_enabled',
        'voting_enabled'
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(320)
            ->height(240);

        $this->addMediaConversion('preview')
            ->width(1280)
            ->height(1024);
    }

    public function getSortedEntriesAttribute()
    {
        return $this->entries()->where('status', 1)->orderBy('sort_position', 'ASC')->get();
    }

    public function getEntryCountAttribute()
    {
        return $this->entries()->count();
    }


    public function competition_type()
    {
        return $this->belongsTo(CompetitionType::class);
    }

    public function option_groups()
    {
        return $this->belongsToMany(OptionGroup::class);
    }

    public function vote_categories()
    {
        return $this->belongsToMany(VoteCategory::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    function file_associations() {
        return $this->morphMany(FileAssociation::class, 'model');
    }

    function prizes()
    {
        return $this->hasMany(CompetitionPrize::class);
    }
}
