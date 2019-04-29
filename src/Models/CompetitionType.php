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
 * Partymeister\Competitions\Models\CompetitionType
 *
 * @property int $id
 * @property string $name
 * @property int $has_platform
 * @property int $has_filesize
 * @property int $has_screenshot
 * @property int $has_audio
 * @property int $has_video
 * @property int $has_recordings
 * @property int $has_composer
 * @property int $has_running_time
 * @property int $is_anonymous
 * @property int $number_of_work_stages
 * @property int $has_remote_entries
 * @property int $file_is_optional
 * @property int $has_config_file
 * @property int $created_by
 * @property int $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Partymeister\Competitions\Models\Competition[] $competitions
 * @property-read \Motor\Backend\Models\User $creator
 * @property-read \Motor\Backend\Models\User|null $eraser
 * @property-read mixed $properties
 * @property-read mixed $translated_properties
 * @property-read \Motor\Backend\Models\User $updater
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType filteredBy(\Motor\Core\Filter\Filter $filter, $column)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType filteredByMultiple(\Motor\Core\Filter\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType search($q, $full_text = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereFileIsOptional($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasAudio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasComposer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasConfigFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasFilesize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasPlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasRecordings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasRemoteEntries($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasRunningTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasScreenshot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereHasVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereIsAnonymous($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereNumberOfWorkStages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\CompetitionType whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class CompetitionType extends Model
{

    use Searchable;
    use Filterable;
    use Blameable, CreatedBy, UpdatedBy, DeletedBy;

    /**
     * Columns for the Blameable trait
     *
     * @var array
     */
    protected $blameable = ['created', 'updated', 'deleted'];

    /**
     * Searchable columns for the searchable trait
     *
     * @var array
     */
    protected $searchableColumns = [
        'name'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'has_platform',
        'has_filesize',
        'has_screenshot',
        'has_video',
        'has_audio',
        'has_recordings',
        'has_composer',
        'has_running_time',
        'is_anonymous',
        'number_of_work_stages',
        'has_remote_entries',
        'file_is_optional',
        'has_config_file',
    ];


    public function competitions()
    {
        return $this->hasMany(Competition::class);
    }


    public function getPropertiesAttribute()
    {
        $properties = [];
        if ($this->has_platform) {
            $properties[] = 'has_platform';
        }
        if ($this->has_filesize) {
            $properties[] = 'has_filesize';
        }
        if ($this->has_screenshot) {
            $properties[] = 'has_screenshot';
        }
        if ($this->has_audio) {
            $properties[] = 'has_audio';
        }
        if ($this->has_video) {
            $properties[] = 'has_video';
        }
        if ($this->has_recordings) {
            $properties[] = 'has_recordings';
        }
        if ($this->has_running_time) {
            $properties[] = 'has_running_time';
        }
        if ($this->number_of_work_stages > 0) {
            $properties[] = 'number_of_work_stages';
        }
        if ($this->has_composer) {
            $properties[] = 'has_composer';
        }
        if ($this->is_anonymous) {
            $properties[] = 'is_anonymous';
        }
        if ($this->has_remote_entries) {
            $properties[] = 'has_remote_entries';
        }
        if ($this->file_is_optional) {
            $properties[] = 'file_is_optional';
        }
        if ($this->has_config_file) {
            $properties[] = 'has_config_file';
        }

        return $properties;
    }


    public function getTranslatedPropertiesAttribute()
    {
        $properties = $this->getPropertiesAttribute();
        foreach ($properties as $index => $property) {
            if ($property == 'number_of_work_stages') {
                $properties[$index] = trans('partymeister-competitions::backend/competition_types.n_number_of_work_stages', ['number' => $this->number_of_work_stages]);
            } else {
                $properties[$index] = trans('partymeister-competitions::backend/competition_types.' . $property);
            }
        }

        return $properties;
    }
}
