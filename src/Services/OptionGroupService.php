<?php

namespace Partymeister\Competitions\Services;

use Partymeister\Competitions\Models\Option;
use Partymeister\Competitions\Models\OptionGroup;
use Motor\Backend\Services\BaseService;

class OptionGroupService extends BaseService
{

    protected $model = OptionGroup::class;

    public function afterCreate()
    {
        $sortPosition = 0;
        foreach ($this->request->get('options', []) as $option) {
            if (trim($option['name']) != '') {
                $this->record->options()->create(['name' => $option['name'], 'sort_position' => $sortPosition++]);
            }
        }
    }

    public function afterUpdate()
    {
        $this->record->options()->delete();
        $this->afterCreate();
    }
}
