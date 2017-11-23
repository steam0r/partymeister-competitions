<?php

namespace Partymeister\Competitions\Services;

use Partymeister\Competitions\Models\Competition;
use Motor\Backend\Services\BaseService;

class CompetitionService extends BaseService
{

    protected $model = Competition::class;

    public function afterCreate()
    {
        foreach ($this->request->get('option_groups', []) as $id) {
            $this->record->option_groups()->attach($id);
        }
        foreach ($this->request->get('vote_categories', []) as $id) {
            $this->record->vote_categories()->attach($id);
        }
    }

    public function afterUpdate()
    {
        $this->record->option_groups()->detach();
        $this->record->vote_categories()->detach();
        $this->afterCreate();
    }
}
