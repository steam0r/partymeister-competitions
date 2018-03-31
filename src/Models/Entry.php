<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Motor\Core\Traits\Searchable;
use Motor\Core\Traits\Filterable;

use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class Entry extends Model implements HasMediaConversions
{

    use HasMediaTrait;
    use Searchable;
    use Filterable;

    /**
     * Searchable columns for the searchable trait
     *
     * @var array
     */
    protected $searchableColumns = [
        'id',
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
        'visitor_id',
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
        $this->addMediaConversion('thumb')->width(320)->height(240)->nonQueued();

        $this->addMediaConversion('preview')->width(1280)->height(1024)->nonQueued();
    }


    public function getLastFileUploadAttribute()
    {
        $media = $this->getMedia('file')->reverse()->first();
        if ( ! is_null($media)) {
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

    public function getVotesAttribute()
    {
        // Get visitor votes
        $sub = DB::table('votes')->select(DB::raw('SUM(points)/count(id) as points_per_visitor'))->where('entry_id', '=', $this->id)->groupBy('visitor_id');

        $points = DB::table( DB::raw("({$sub->toSql()}) as sub") )
                   ->mergeBindings($sub) // you need to get underlying Query Builder
                   ->select(DB::raw('SUM(points_per_visitor) as points'))->pluck('points')->first();

        // Get manual votes
        $manualPoints = DB::table('manual_votes')->select(DB::raw('SUM(points) as points'))->where('entry_id', $this->id)->pluck('points')->first();

        return (is_null($points) ? 0 : $points) + (is_null($manualPoints) ? 0 : $manualPoints);
    }

    public function getNewCommentsAttribute()
    {
        return $this->comments()->where('read_by_visitor', false)->count();
    }

    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany('Partymeister\Competitions\Models\Comment', 'model');
    }
}
