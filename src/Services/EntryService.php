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
        $this->addImages();
    }

    public function afterUpdate()
    {
        $this->record->options()->detach();
        $this->afterCreate();
    }

    protected function addImages()
    {
        $numberOfWorkStages = $this->record->competition->competition_type->number_of_work_stages;
        if ($numberOfWorkStages > 0) {
            for ($i=1; $i<=$numberOfWorkStages; $i++) {
                $this->uploadFile($this->request->file('work_stage_'.$i), 'work_stage_'.$i, 'work_stage_'.$i, $this->record);
            }
        }

        $this->uploadFile($this->request->file('screenshot'), 'screenshot', null, $this->record);
        $this->uploadFile($this->request->file('video'), 'video', null, $this->record);
        $this->uploadFile($this->request->file('audio'), 'audio', null, $this->record);
        $this->uploadFile($this->request->file('file'), 'file', 'file', $this->record, true);
    }
}
