<?php

namespace Partymeister\Competitions\Forms\Backend;

use Kris\LaravelFormBuilder\Form;
use Partymeister\Competitions\Models\CompetitionType;
use Partymeister\Competitions\Models\OptionGroup;
use Partymeister\Competitions\Models\VoteCategory;

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
            ->add('option_groups', 'select', [
                'attr' => ['multiple' => true, 'id' => 'option_groups'],
                'choices' => OptionGroup::pluck('name', 'id')->toArray(),
            ])
            ->add('vote_categories', 'select', [
                'attr' => ['multiple' => true, 'id' => 'vote_categories'],
                'choices' => VoteCategory::pluck('name', 'id')->toArray(),
                'default_value' => 1
            ])
            ->add('submit', 'submit', ['attr' => ['class' => 'btn btn-primary'], 'label' => trans('partymeister-competitions::backend/competitions.save')]);
    }
}
