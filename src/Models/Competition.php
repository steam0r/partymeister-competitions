<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Searchable;
use Motor\Core\Traits\Filterable;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;

class Competition extends Model
{

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
        'name',
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
}
