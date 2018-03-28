<?php

namespace Partymeister\Competitions\Services;

use Illuminate\Support\Facades\Auth;
use Motor\Core\Filter\Renderers\SelectRenderer;
use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Models\Entry;
use Motor\Backend\Services\BaseService;

class EntryService extends BaseService
{

    protected $model = Entry::class;


    public function filters()
    {
        //$this->filter->addClientFilter();
        $this->filter->add(new SelectRenderer('competition_id'))->setOptionPrefix(trans('partymeister-competitions::backend/competitions.competition'))->setEmptyOption('-- ' . trans('partymeister-competitions::backend/competitions.competition') . ' --')->setOptions(Competition::orderBy('sort_position',
            'ASC')->pluck('name', 'id'));

        $this->filter->add(new SelectRenderer('status'))->setOptionPrefix(trans('partymeister-competitions::backend/entries.status'))->setEmptyOption('-- ' . trans('partymeister-competitions::backend/entries.status') . ' --')->setOptions(trans('partymeister-competitions::backend/entries.stati'));
    }

    public function beforeCreate()
    {
        if (Auth::guard('visitor')->user() != null) {
            $this->data['visitor_id'] = Auth::guard('visitor')->user()->id;
        }
    }


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
        if (count($this->request->get('options', [])) > 0) {
            $this->record->options()->detach();
            $this->afterCreate();
        }
        $this->addImages();
    }


    protected function addImages()
    {
        $numberOfWorkStages = $this->record->competition->competition_type->number_of_work_stages;
        if ($numberOfWorkStages > 0) {
            for ($i = 1; $i <= $numberOfWorkStages; $i++) {
                $this->uploadFile($this->request->file('work_stage_' . $i), 'work_stage_' . $i, 'work_stage_' . $i,
                    $this->record);
            }
        }

        $this->uploadFile($this->request->file('screenshot'), 'screenshot', null, $this->record);
        $this->uploadFile($this->request->file('video'), 'video', null, $this->record);
        $this->uploadFile($this->request->file('audio'), 'audio', null, $this->record);
        $this->uploadFile($this->request->file('file'), 'file', 'file', $this->record, true);
    }
}
