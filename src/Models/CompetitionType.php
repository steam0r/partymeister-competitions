<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Searchable;
use Motor\Core\Traits\Filterable;
use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;

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
    protected $blameable = [ 'created', 'updated', 'deleted' ];

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
        'is_anonymous',
        'has_remote_entries',
        'file_is_optional'
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
        return $properties;
    }
}
