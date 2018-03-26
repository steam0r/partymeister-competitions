<?php

namespace Partymeister\Competitions\Services;

use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Models\CompetitionPrize;
use Motor\Backend\Services\BaseService;

class CompetitionPrizeService extends BaseService
{

    protected $model = CompetitionPrize::class;

    public static function createOrUpdatePrizes($request)
    {
        $competitions = Competition::where('has_prizegiving', true)->orderBy('prizegiving_sort_position', 'ASC')->get();

        foreach (CompetitionPrize::get() as $prize) {
            $prize->delete();
        }

        foreach ($competitions as $competition) {
            for ($i=1; $i<=3; $i++) {
                $p = new CompetitionPrize();
                $p->competition_id = $competition->id;
                $p->rank = $i;
                $p->amount = array_get($request->all(), 'amount.'.$competition->id.'.'.$i);
                $p->additional = array_get($request->all(), 'additional.'.$competition->id.'.'.$i);
                $p->save();
            }
        }
    }
}
