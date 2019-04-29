<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Searchable;
use Motor\Core\Traits\Filterable;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;

/**
 * Partymeister\Competitions\Models\CompetitionPrize
 *
 * @property int $id
 * @property int $competition_id
 * @property string $amount
 * @property string $additional
 * @property string $rank
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $deleted_by
 * @property-read \Partymeister\Competitions\Models\Competition $competition
 * @property-read \Motor\Backend\Models\User $creator
 * @property-read \Motor\Backend\Models\User|null $eraser
 * @property-read \Motor\Backend\Models\User $updater
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize filteredBy(\Motor\Core\Filter\Filter $filter, $column)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize filteredByMultiple(\Motor\Core\Filter\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize search($q, $full_text = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereAdditional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionPrize whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class CompetitionPrize extends Model
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
        'amount',
        'competition.name',
        'additional'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'competition_id',
        'amount',
        'additional',
        'rank'
    ];


    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
