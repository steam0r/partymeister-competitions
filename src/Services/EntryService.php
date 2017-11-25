<?php

namespace Partymeister\Competitions\Services;

use Partymeister\Competitions\Models\Entry;
use Motor\Backend\Services\BaseService;

class EntryService extends BaseService
{

    protected $model = Entry::class;

    public function afterCreate()
    {
        foreach ($this->request->get('options', []) as $group) {
            if (is_array($group)) {
                foreach ($group as $option => $id) {
                    $this->record->options()->attach($id);
                }
            } else {
                $this->record->options()->attach($group);
            }
        }
    }

    public function afterUpdate()
    {
        $this->record->options()->detach();
        $this->afterCreate();
    }
}
