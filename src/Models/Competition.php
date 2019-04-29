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

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Partymeister\Competitions\Models\Competition
 *
 * @property int $id
 * @property int|null $competition_type_id
 * @property int $sort_position
 * @property int $prizegiving_sort_position
 * @property string $name
 * @property int $has_prizegiving
 * @property int $upload_enabled
 * @property int $voting_enabled
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Partymeister\Competitions\Models\CompetitionType|null $competition_type
 * @property-read \Motor\Backend\Models\User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection|\Partymeister\Competitions\Models\Entry[] $entries
 * @property-read \Motor\Backend\Models\User|null $eraser
 * @property-read \Illuminate\Database\Eloquent\Collection|\Motor\Media\Models\FileAssociation[] $file_associations
 * @property-read mixed $entry_count
 * @property-read mixed $sorted_entries
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\Partymeister\Competitions\Models\OptionGroup[] $option_groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\Partymeister\Competitions\Models\CompetitionPrize[] $prizes
 * @property-read \Motor\Backend\Models\User $updater
 * @property-read \Illuminate\Database\Eloquent\Collection|\Partymeister\Competitions\Models\VoteCategory[] $vote_categories
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition filteredBy(\Motor\Core\Filter\Filter $filter, $column)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition filteredByMultiple(\Motor\Core\Filter\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition search($q, $full_text = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereCompetitionTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereHasPrizegiving($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition wherePrizegivingSortPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereSortPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereUploadEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Competition whereVotingEnabled($value)
 * @mixin \Eloquent
 */
class Competition extends Model implements HasMedia
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
            ->height(240)->nonQueued();

        $this->addMediaConversion('preview')
            ->width(1280)
            ->height(1024)->nonQueued();
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
