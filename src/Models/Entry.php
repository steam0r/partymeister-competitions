<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Motor\Core\Traits\Searchable;
use Motor\Core\Traits\Filterable;

use Culpa\Traits\Blameable;
use Culpa\Traits\CreatedBy;
use Culpa\Traits\DeletedBy;
use Culpa\Traits\UpdatedBy;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class Entry extends Model implements HasMediaConversions
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
        'title',
        'author',
        'platform',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'competition_id',
        'ip_address',
        'sort_position',
        'title',
        'author',
        'filesize',
        'platform',
        'description',
        'organizer_description',
        'running_time',
        'custom_option',
        'allow_release',
        'is_remote',
        'is_recorded',
        'is_prepared',
        'upload_enabled',
        'composer_not_member_of_copyright_collective',
        'author_name',
        'author_email',
        'author_phone',
        'author_address',
        'author_zip',
        'author_city',
        'author_country_iso_3166_1',
        'composer_name',
        'composer_email',
        'composer_phone',
        'composer_address',
        'composer_zip',
        'composer_city',
        'composer_country_iso_3166_1',
        'status',
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

    public function getLastFileUploadAttribute()
    {
        $media = $this->getMedia('file')->reverse()->first();
        if (!is_null($media)) {
            return $media->created_at;
        }
        return '';
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }


    public function getNameAttribute()
    {
        return $this->title . ' by ' . $this->author;
    }

    public function options()
    {
        return $this->belongsToMany(Option::class);
    }
}
