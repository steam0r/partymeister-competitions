<?php

namespace Partymeister\Competitions\Http\Controllers\Api\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Motor\Backend\Http\Controllers\Controller;
use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Models\Vote;
use Partymeister\Competitions\Models\VoteCategory;

class VotesController extends Controller {

	public function store(Request $request, $api_token)
	{
		$visitor = Auth::guard('visitor')->user();
		if ($visitor->api_token != $api_token)
		{
			return response()->json([
				'error'   => TRUE,
				'message' => 'Oops, somebody tried to be naughty!'
			]);
		}

		$entry = Entry::find($request->get('entry_id'));
		$competition = Competition::find($request->get('competition_id'));
		$voteCategory = VoteCategory::find($request->get('vote_category_id'));

		if (is_null($entry) || is_null($competition) || is_null($voteCategory))
		{
			return response()->json([
				'error'   => TRUE,
				'message' => 'Oops, something went wrong!'
			]);
		}

		if ($competition->voting_enabled == FALSE && !$request->get('live', false))
		{
			return response()->json([
				'error'   => TRUE,
				'message' => 'Voting for this competition is not available yet!'
			]);
		}

		if ($entry->competition_id != $competition->id)
		{
			return response()->json([
				'error'   => TRUE,
				'message' => 'Oops, something went wrong!'
			]);
		}

		if (strtotime(config('partymeister-competitions-voting.deadline')) < time())
		{
			return response()->json([
				'error'   => TRUE,
				'message' => 'Voting deadline is over, sorry :/'
			]);
		}
		$points = $request->get('points');
		if ($points > $voteCategory->points)
		{
			$points = $voteCategory->points;
		}

		if ($request->get('special_vote'))
		{
			foreach ($visitor->votes()->where('special_vote', TRUE)->get() as $vote)
			{
				$vote->special_vote = FALSE;
				$vote->save();
			}
		}

		// Create new vote item if this one doesn't exist yet
		$vote = $visitor->votes()->where('vote_category_id', $request->get('vote_category_id'))->where('entry_id', $request->get('entry_id'))->first();

		if (is_null($vote))
		{
			$vote = new Vote();
			$vote->visitor_id = $visitor->id;
			$vote->competition_id = $request->get('competition_id');
			$vote->entry_id = $request->get('entry_id');
			$vote->ip_address = $request->ip();
		}
		$vote->points = $points;
		$vote->vote_category_id = $request->get('vote_category_id');
		$vote->comment = $request->get('comment', '');

		if ($request->get('special_vote', null) !== null)
		{
			$vote->special_vote = $request->get('special_vote');
		}

        $vote->save();

		return response()->json([
			'success' => TRUE,
			'message' => 'You voted for ' . $entry->title . ' in the ' . $competition->name . ' competition!'
		]);
	}
}