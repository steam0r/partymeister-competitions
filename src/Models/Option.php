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
 * Partymeister\Competitions\Models\Option
 *
 * @property int $id
 * @property int $option_group_id
 * @property int $sort_position
 * @property string $name
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Motor\Backend\Models\User $creator
 * @property-read \Motor\Backend\Models\User|null $eraser
 * @property-read \Partymeister\Competitions\Models\OptionGroup $group
 * @property-read \Motor\Backend\Models\User $updater
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option filteredBy(\Motor\Core\Filter\Filter $filter, $column)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option filteredByMultiple(\Motor\Core\Filter\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option search($q, $full_text = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option whereOptionGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option whereSortPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Option whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Option extends Model
{
    use Searchable;
	use Filterable;
    use Blameable, CreatedBy, UpdatedBy, DeletedBy;

    /**
     * Columns for the Blameable trait
     *
     * @var array
     */
    protected $blameable = array('created', 'updated', 'deleted');

    /**
     * Searchable columns for the searchable trait
     *
     * @var array
     */
    protected $searchableColumns = [
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'option_group_id',
        'name',
        'sort_position',
    ];

    public function group()
    {
        return $this->belongsTo(OptionGroup::class);
    }
}
