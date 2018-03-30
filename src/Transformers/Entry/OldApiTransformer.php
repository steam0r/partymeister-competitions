<?php

namespace Partymeister\Competitions\Transformers\Entry;

use League\Fractal;
use Partymeister\Competitions\Models\Entry;

class OldApiTransformer extends Fractal\TransformerAbstract {

	public function transform(Entry $entry)
	{
		$deadline = FALSE;
		if (time() > strtotime(config('partymeister-competitions-voting.deadline')))
		{
			$deadline = TRUE;
		}

		$data = [
			'id'               => (int)$entry->id,
			'entry_number'     => (int)$entry->sort_position,
			'title'            => $entry->title,
			'author'           => $entry->author,
			'description'      => $entry->description,
			'orga_description' => $entry->organizer_description,
			'remote_entry'     => (bool)$entry->is_remote,
			'anonymous'        => (bool)$entry->competition->is_anonymous,
			'status'           => (int)$entry->status,
			'files'            => [],
			'options'          => [],
			'screenshot'       => [],
			'mp3'              => [],
			'preview'          => [],
			'competition'      => $entry->competition->name,
			'competition_id'   => (int)$entry->competition->id,
			'deadline_reached' => $deadline,
			'uploader_data'                                   => [
				'name'    => $entry->author_name,
				'street'  => $entry->author_address,
				'zip'     => $entry->author_zip,
				'city'    => $entry->author_city,
				'country' => $entry->author_country_iso_3166_1,
				'email'   => $entry->author_email,
				'phone'   => $entry->author_phone,
			],
			'composer_required'                               => (bool) $entry->competition->composer_required,
			'composer_data'                                   => [
				'name'    => $entry->composer_name,
				'street'  => $entry->composer_street,
				'zip'     => $entry->composer_zip,
				'city'    => $entry->composer_city,
				'country' => $entry->composer_country,
				'email'   => $entry->composer_email,
			],
		];

		if ($entry->getFirstMedia('screenshot'))
		{
			$media = $entry->getFirstMedia('screenshot');
			$data['screenshot'] = [
				'name'      => $media->file_name,
				'mime_type' => $media->mime_type,
				'size'      => $media->file_size,
				'url'       => asset($media->getUrl())
			];
		}

		if ($entry->getFirstMedia('audio'))
		{
			$media = $entry->getFirstMedia('audio');
			$data['mp3'] = [
				'name'      => $media->file_name,
				'mime_type' => $media->mime_type,
				'size'      => $media->file_size,
				'url'       => asset($media->getUrl())
			];
		}

		return $data;
	}
}