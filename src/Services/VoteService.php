<?php

namespace Partymeister\Competitions\Services;

use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Models\ManualVote;
use Partymeister\Competitions\Models\Vote;
use Motor\Backend\Services\BaseService;

class VoteService extends BaseService
{

    protected $model = Vote::class;


    public static function addVotes($request)
    {
        foreach ($request->get('entry') as $competitionId => $entries) {
            foreach ($entries as $entryId => $points) {
                if ((int) $points > 0) {
                    $mv                 = new ManualVote();
                    $mv->competition_id = $competitionId;
                    $mv->entry_id       = $entryId;
                    $mv->points         = $points;
                    $mv->ip_address     = \Request::ip();
                    $mv->save();
                }
            }
        }
    }


    public static function getAllVotesByRank()
    {
        $results = [];
        foreach (Competition::where('has_prizegiving', true)
                            ->orderBy('prizegiving_sort_position', 'DESC')
                            ->get() as $competition) {
            $results[$competition->id] = [
                'id'      => $competition->id,
                'name'    => $competition->name,
                'entries' => []
            ];
            foreach ($competition->entries()->where('status', 1)->get() as $entry) {
                $results[$competition->id]['entries'][$entry->id] = [
                    'id'     => $entry->id,
                    'title'  => $entry->title,
                    'author' => $entry->author,
                    'points' => $entry->votes
                ];
            }

            // Sort by points
            usort($results[$competition->id]['entries'], function ($item1, $item2) {
                return $item2['points'] <=> $item1['points'];
            });
        }

        return $results;
    }
}
