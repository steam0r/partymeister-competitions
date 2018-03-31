<?php

namespace Partymeister\Competitions\Transformers\Entry;

use League\Fractal;
use League\Fractal\ParamBag;
use Motor\Backend\Helpers\Filesize;
use Motor\Backend\Helpers\MediaHelper;
use Motor\Backend\Transformers\MediaTransformer;
use Partymeister\Competitions\Models\Entry;
use Symfony\Component\Intl\Intl;

class SyncTransformer extends Fractal\TransformerAbstract
{

    /**
     * Transform record to array
     *
     * @param Entry $record
     *
     * @return array
     */
    public function transform(Entry $record)
    {
        return [
            'id' => (int)$record->id,
            'title' => $record->title,
            'author' => $record->author,
            'description' => $record->description,
            'organizer_description' => $record->organizer_description,
            'filesize_bytes' => (int)$record->filesize,
            'filesize_human' => Filesize::bytesToHuman((int)$record->filesize),
            'platform' => $record->platform,
            'running_time' => $record->running_time,
            'playlist_position' => $record->sort_position,
            'custom_option' => $record->custom_option,
            'ip_address' => $record->ip_address,
            'allow_release' => (bool)$record->allow_release,
            'is_remote' => (bool)$record->is_remote,
            'is_recorded' => (bool)$record->is_recorded,
            'upload_enabled' => (bool)$record->upload_enabled,
            'is_prepared' => (bool)$record->is_prepared,
            'sort_position' => (int)$record->sort_position,
            'sort_position_prefixed' => (strlen($record->sort_position) == 1 ? '0' . $record->sort_position : $record->sort_position),
            'competition_name' => $record->competition->name,
            'status' => trans('partymeister-competitions::backend/entries.stati.' . $record->status),
            'last_file_uploaded_at' => str_replace(' ', 'T', $record->last_file_uploaded_at),
            'author_name' => $record->author_name,
            'author_email' => $record->author_email,
            'author_phone' => $record->author_phone,
            'author_address' => $record->author_address,
            'author_zip' => $record->author_zip,
            'author_city' => $record->author_city,
            'author_country_iso_3166_1' => $record->author_country_iso_3166_1,
            'author_country' => Intl::getRegionBundle()->getCountryName($record->author_country_iso_3166_1),
            'composer_name' => $record->composer_name,
            'composer_email' => $record->composer_email,
            'composer_phone' => $record->composer_phone,
            'composer_address' => $record->composer_address,
            'composer_zip' => $record->composer_zip,
            'composer_city' => $record->composer_city,
            'composer_country_iso_3166_1' => $record->composer_country_iso_3166_1,
            'composer_country' => Intl::getRegionBundle()->getCountryName($record->composer_country_iso_3166_1),
            'composer_not_member_of_copyright_collective' => (bool)$record->composer_not_member_of_copyright_collective,
            'screenshot' => MediaHelper::getFileInformation($record, 'screenshot', true),
            'audio' => MediaHelper::getFileInformation($record, 'audio', true),
        ];
    }
}
