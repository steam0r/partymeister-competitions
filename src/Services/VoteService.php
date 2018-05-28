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


    public static function getAllVotesByRank($direction = 'DESC')
    {
        $results   = [];
        $maxPoints = [];
        foreach (Competition::where('has_prizegiving', true)
                            ->orderBy('prizegiving_sort_position', $direction)
                            ->get() as $competition) {
            $results[$competition->id]   = [
                'id'          => $competition->id,
                'name'        => $competition->name,
                'has_comment' => (bool)$competition->vote_categories[0]->has_comment,
                'entries'     => []
            ];
            $maxPoints[$competition->id] = 0;
            foreach ($competition->entries()->where('status', 1)->get() as $entry) {
                $maxPoints[$competition->id]                      = max($entry->votes, $maxPoints[$competition->id]);
                $results[$competition->id]['entries'][$entry->id] = [
                    'id'       => $entry->id,
                    'title'    => $entry->title,
                    'author'   => $entry->author,
                    'points'   => $entry->votes,
                    'comments' => $entry->vote_comments
                ];
            }

            // Sort by points
            usort($results[$competition->id]['entries'], function ($item1, $item2) {
                return $item2['points'] <=> $item1['points'];
            });
            foreach ($results[$competition->id]['entries'] as $key => $entry) {
                $results[$competition->id]['entries'][$key]['max_points'] = $maxPoints[$competition->id];
                $results[$competition->id]['entries'][$key]['rank']       = ( $key + 1 );
            }
        }

        return $results;
    }


    public static function getAllSpecialVotesByRank()
    {
        $results   = [];
        $maxPoints = 0;
        foreach (Competition::where('has_prizegiving', true)
                            ->orderBy('prizegiving_sort_position', 'DESC')
                            ->get() as $competition) {

            if ($competition->vote_categories[0]->has_special_vote) {
                foreach ($competition->entries()->where('status', 1)->get() as $entry) {
                    $specialVotes = (int) $entry->special_votes;
                    $maxPoints    = max($specialVotes, $maxPoints);
                    if ($specialVotes > 0) {
                        $results[$entry->id] = [
                            'id'            => $entry->id,
                            'title'         => $entry->title,
                            'author'        => $entry->author,
                            'competition'   => $competition->name,
                            'special_votes' => (int) $specialVotes,
                            'points'        => (int) $specialVotes,
                        ];
                    }
                }

                // Sort by points
                usort($results, function ($item1, $item2) {
                    return $item2['special_votes'] <=> $item1['special_votes'];
                });

                foreach ($results as $key => $entry) {
                    $results[$key]['max_points'] = $maxPoints;
                    $results[$key]['rank']       = ( $key + 1 );
                }
            }
        }

        return $results;
    }
}
