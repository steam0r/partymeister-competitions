<?php

namespace Partymeister\Competitions\Transformers\Entry;

use League\Fractal;
use League\Fractal\ParamBag;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Models\Vote;

class SimpleTransformer extends Fractal\TransformerAbstract {

	private $validParams = [
		'visitor_id',
		'vote_category_id'
	];

	protected $availableIncludes = [
		'vote'
	];

	public function includeVote(Entry $entry, ParamBag $params)
	{
		$votes = Vote::where('entry_id', $entry->id)
			->where('visitor_id', $params->get('visitor_id'))
			->get();

		return $this->collection($votes, new \Partymeister\Competitions\Transformers\Vote\SimpleTransformer());
	}

	public function transform(Entry $entry)
	{
		$deadline = FALSE;
		if (time() > strtotime(config('partymeister-competitions-voting.deadline')))
		{
			$deadline = TRUE;
		}

		$data = array(
			'id'               => (int)$entry->id,
			'entry_number'     => (int)$entry->sort_position,
			'title'            => $entry->title,
			'author'           => $entry->author,
			'description'      => $entry->description,
			'orga_description' => $entry->organizer_description,
			'running_time'     => $entry->running_time,
			'filesize'         => $entry->filesize,
			'platform'         => $entry->platform,
			'remote_entry'     => (bool)$entry->is_remote,
			'anonymous'        => (bool)$entry->competition->competition_type->is_anonymous,
			'status'           => (int)$entry->status,
			'screenshot'       => array(),
			'mp3'              => array(),
			'audio_preview'    => FALSE,
			'competition'      => $entry->competition->name,
			'competition_id'   => (int)$entry->competition->id,
			'deadline_reached' => $deadline
		);

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
			$data['audio_preview'] = true;
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
