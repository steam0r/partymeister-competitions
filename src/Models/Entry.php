<?php

namespace Partymeister\Competitions\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Motor\Core\Traits\Searchable;
use Motor\Core\Traits\Filterable;

use Partymeister\Core\Models\Visitor;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Partymeister\Competitions\Models\Entry
 *
 * @property int $id
 * @property int|null $competition_id
 * @property int|null $final_file_media_id
 * @property int|null $visitor_id
 * @property string $title
 * @property string $author
 * @property string $filesize
 * @property string $platform
 * @property int $sort_position
 * @property string $description
 * @property string $organizer_description
 * @property string $running_time
 * @property string $custom_option
 * @property string $ip_address
 * @property int $allow_release
 * @property int $is_remote
 * @property int $is_recorded
 * @property int $upload_enabled
 * @property int $is_prepared
 * @property int $status
 * @property string $author_name
 * @property string $author_email
 * @property string $author_phone
 * @property string $author_address
 * @property string $author_zip
 * @property string $author_city
 * @property string $author_country_iso_3166_1
 * @property string $composer_name
 * @property string $composer_email
 * @property string $composer_phone
 * @property string $composer_address
 * @property string $composer_zip
 * @property string $composer_city
 * @property string $composer_country_iso_3166_1
 * @property int $composer_not_member_of_copyright_collective
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Partymeister\Competitions\Models\Comment[] $comments
 * @property-read \Partymeister\Competitions\Models\Competition|null $competition
 * @property-read \Spatie\MediaLibrary\Models\Media $final_file
 * @property-read mixed $download
 * @property-read mixed $last_file_upload
 * @property-read mixed $name
 * @property-read mixed $new_comments
 * @property-read mixed $ordered_files
 * @property-read mixed $special_votes
 * @property-read mixed $vote_comments
 * @property-read mixed $votes
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\Partymeister\Competitions\Models\Option[] $options
 * @property-read \Partymeister\Core\Models\Visitor|null $visitor
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry filteredBy(\Motor\Core\Filter\Filter $filter, $column)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry filteredByMultiple(\Motor\Core\Filter\Filter $filter)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry search($q, $full_text = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereAllowRelease($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereAuthorAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereAuthorCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereAuthorCountryIso31661($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereAuthorEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereAuthorName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereAuthorPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereAuthorZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereCompetitionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereComposerAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereComposerCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereComposerCountryIso31661($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereComposerEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereComposerName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereComposerNotMemberOfCopyrightCollective($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereComposerPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereComposerZip($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereCustomOption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereFilesize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereFinalFileMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereIsPrepared($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereIsRecorded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereIsRemote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereOrganizerDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry wherePlatform($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereRunningTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereSortPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereUploadEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Partymeister\Competitions\Models\Entry whereVisitorId($value)
 * @mixin \Eloquent
 */
class Entry extends Model implements HasMedia
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
        'final_file_media_id',
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


    public function getSpecialVotesAttribute()
    {
        // Get visitor votes
        $query = DB::table('votes')
                   ->select(DB::raw('SUM(special_vote) as special_votes'))
                   ->where('entry_id', '=', $this->id)
                   ->first();

        if (is_null($query)) {
            return 0;
        }

        return $query->special_votes;
    }


    public function getVoteCommentsAttribute()
    {
        return DB::table('votes')->select('comment')->where('entry_id', $this->id)->where('comment', '!=', '')->get()->pluck('comment')->toArray();
    }


    public function getVotesAttribute()
    {
        // Get visitor votes
        $sub = DB::table('votes')
                 ->select(DB::raw('SUM(points)/count(id) as points_per_visitor'))
                 ->where('entry_id', '=', $this->id)
                 ->groupBy('visitor_id');

        $points = DB::table(DB::raw("({$sub->toSql()}) as sub"))
                    ->mergeBindings($sub)// you need to get underlying Query Builder
                    ->select(DB::raw('SUM(points_per_visitor) as points'))
                    ->pluck('points')
                    ->first();

        // Get manual votes
        $manualPoints = DB::table('manual_votes')
                          ->select(DB::raw('SUM(points) as points'))
                          ->where('entry_id', $this->id)
                          ->pluck('points')
                          ->first();

        return ( is_null($points) ? 0 : $points ) + ( is_null($manualPoints) ? 0 : $manualPoints );
    }


    public function getNewCommentsAttribute()
    {
        return $this->comments()->where('read_by_visitor', false)->count();
    }


    public function getOrderedFilesAttribute()
    {
        $media = $this->getMedia('file');

        $mediaArray = [];
        foreach ($media as $m) {
            $mediaArray[] = $m;
        }

        usort($mediaArray, function ($item1, $item2) {
            return strtotime($item2['created_at']) <=> strtotime($item1['created_at']);
        });

        return collect($mediaArray);
    }


    public function getDownloadAttribute()
    {
        $media = null;
        if ($this->final_file_media_id > 0) {
            $media = Media::find($this->final_file_media_id);
        }

        return $media;
    }


    public function final_file()
    {
        return $this->hasOne(Media::class, 'model_id');
    }


    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany('Partymeister\Competitions\Models\Comment', 'model');
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
