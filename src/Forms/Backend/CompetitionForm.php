<?php

namespace Partymeister\Competitions\Forms\Backend;

use Kris\LaravelFormBuilder\Form;
use Partymeister\Competitions\Models\CompetitionType;

class CompetitionForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', ['label' => trans('motor-backend::backend/global.name'), 'rules' => 'required'])
            ->add('competition_type_id', 'select2', ['label' => trans('partymeister-competitions::backend/competition_types.competition_type'), 'choices' => CompetitionType::orderBy('name')->pluck('name', 'id')->toArray()])
            ->add('sort_position', 'text', ['label' => trans('partymeister-competitions::backend/competitions.sort_position'), 'rules' => 'required'])
            ->add('has_prizegiving', 'checkbox', ['label' => trans('partymeister-competitions::backend/competitions.has_prizegiving')])
            ->add('prizegiving_sort_position', 'text', ['label' => trans('partymeister-competitions::backend/competitions.prizegiving_sort_position')])
            ->add('upload_enabled', 'checkbox', ['label' => trans('partymeister-competitions::backend/competitions.upload_enabled')])
            ->add('voting_enabled', 'checkbox', ['label' => trans('partymeister-competitions::backend/competitions.voting_enabled')])

            ->add('submit', 'submit', ['attr' => ['class' => 'btn btn-primary'], 'label' => trans('partymeister-competitions::backend/competitions.save')]);
    }
}
