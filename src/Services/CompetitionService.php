<?php

namespace Partymeister\Competitions\Services;

use Motor\Core\Filter\Renderers\SelectRenderer;
use Motor\Media\Models\FileAssociation;
use Partymeister\Competitions\Models\Competition;
use Motor\Backend\Services\BaseService;

class CompetitionService extends BaseService
{

    protected $model = Competition::class;


    public function filters()
    {
        //$this->filter->addClientFilter();
        $this->filter->add(new SelectRenderer('has_prizegiving'))->setOptionPrefix(trans('partymeister-competitions::backend/competitions.has_prizegiving'))->setEmptyOption('-- ' . trans('partymeister-competitions::backend/competitions.has_prizegiving') . ' --')->setOptions([
            1 => trans('motor-backend::backend/global.yes'),
            0 => trans('motor-backend::backend/global.no')
        ]);
        $this->filter->add(new SelectRenderer('upload_enabled'))->setOptionPrefix(trans('partymeister-competitions::backend/competitions.upload_enabled'))->setEmptyOption('-- ' . trans('partymeister-competitions::backend/competitions.upload_enabled') . ' --')->setOptions([
            1 => trans('motor-backend::backend/global.yes'),
            0 => trans('motor-backend::backend/global.no')
        ]);
        $this->filter->add(new SelectRenderer('voting_enabled'))->setOptionPrefix(trans('partymeister-competitions::backend/competitions.voting_enabled'))->setEmptyOption('-- ' . trans('partymeister-competitions::backend/competitions.voting_enabled') . ' --')->setOptions([
            1 => trans('motor-backend::backend/global.yes'),
            0 => trans('motor-backend::backend/global.no')
        ]);
    }


    public function afterCreate()
    {
        foreach ($this->request->get('option_groups', []) as $id) {
            $this->record->option_groups()->attach($id);
        }
        foreach ($this->request->get('vote_categories', []) as $id) {
            $this->record->vote_categories()->attach($id);
        }
        $this->addFileAssociation('video_1');
        $this->addFileAssociation('video_2');
        $this->addFileAssociation('video_3');
    }


    public function afterUpdate()
    {
        $this->record->option_groups()->detach();
        $this->record->vote_categories()->detach();

        // Delete all playlist items for this playlist
        foreach ($this->record->file_associations()->get() as $fileAssociation) {
            $fileAssociation->delete();
        }

        $this->afterCreate();
    }


    protected function addFileAssociation($field)
    {
        if ($this->request->get($field) == '') {
            return;
        }

        $file = json_decode($this->request->get($field));

        // Create file association
        $fa             = new FileAssociation();
        $fa->file_id    = $file->id;
        $fa->model_type = get_class($this->record);
        $fa->model_id   = $this->record->id;
        $fa->identifier = $field;
        $fa->save();
    }
}
