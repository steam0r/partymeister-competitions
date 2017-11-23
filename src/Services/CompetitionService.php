<?php

namespace Partymeister\Competitions\Services;

use Partymeister\Competitions\Models\Competition;
use Motor\Backend\Services\BaseService;

class CompetitionService extends BaseService
{

    protected $model = Competition::class;

    public function afterCreate()
    {
        foreach ($this->request->get('option_groups', []) as $group) {
            $this->record->option_groups()->attach($group);
        }
    }

    public function afterUpdate()
    {
        $this->record->option_groups()->detach();
        $this->afterCreate();
    }
}
