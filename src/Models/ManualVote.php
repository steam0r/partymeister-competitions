<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Searchable;
use Motor\Core\Traits\Filterable;

/**
 * Partymeister\Competitions\Models\ManualVote
 *
 * @property int $id
 * @property int $competition_id
 * @property int $entry_id
 * @property string $points
 * @property string $ip_address
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote filteredBy(\Motor\Core\Filter\Filter $filter, $column)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote filteredByMultiple(\Motor\Core\Filter\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote search($q, $full_text = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote whereEntryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\ManualVote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ManualVote extends Model
{

    use Searchable;
    use Filterable;

    /**
     * Searchable columns for the searchable trait
     *
     * @var array
     */
    protected $searchableColumns = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'competition_id',
        'entry_id',
        'points',
        'ip_address',
    ];
}
