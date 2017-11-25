<?php

namespace Partymeister\Competitions\Forms\Backend;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use Kris\LaravelFormBuilder\Form;
use Partymeister\Competitions\Models\Competition;

class EntryForm extends Form
{
    public function buildForm()
    {
        $data = [];
        if (Input::old('competition_id')) {
            $data['competition'] = Competition::find(Input::old('competition_id'));
        } elseif (is_object($this->getModel()) && $this->getModel()->competition_id > 0) {
            $data['competition'] = Competition::find($this->getModel()->competition_id);
        }

        $this
            ->add('competition_id', 'select2', ['attr' => ['class' => 'form-control reload-on-change'], 'label' => trans('partymeister-competitions::backend/competitions.competition'), 'empty_value' => trans('motor-backend::backend/global.please_choose'), 'choices' => Competition::orderBy('sort_position')->pluck('name', 'id')->toArray()])
            ->add('reload_on_change', 'hidden', ['attr' => ['id' => 'reload_on_change']])
            ->add('sort_position', 'text', ['label' => trans('partymeister-competitions::backend/entries.sort_position')])
            ->add('title', 'text', ['label' => trans('partymeister-competitions::backend/entries.title'), 'rules' => 'required'])
            ->add('author', 'text', ['label' => trans('partymeister-competitions::backend/entries.author'), 'rules' => 'required'])
            ->add('description', 'textarea', ['label' => trans('partymeister-competitions::backend/entries.description')])
            ->add('organizer_description', 'textarea', ['label' => trans('partymeister-competitions::backend/entries.organizer_description')])
            ->add('custom_option', 'text', ['label' => trans('partymeister-competitions::backend/entries.custom_option')])
            ->add('allow_release', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.allow_release'), 'default_value' => true])
            ->add('is_prepared', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.is_prepared')])
            ->add('status', 'select', ['label' => trans('partymeister-competitions::backend/entries.status'), 'choices' => trans('partymeister-competitions::backend/entries.stati')])
            ->add('upload_enabled', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.upload_enabled')])

            ->add('author_name', 'text', ['label' => trans('partymeister-competitions::backend/entries.name')])
            ->add('author_email', 'text', ['label' => trans('partymeister-competitions::backend/entries.email')])
            ->add('author_phone', 'text', ['label' => trans('partymeister-competitions::backend/entries.phone')])
            ->add('author_address', 'text', ['label' => trans('partymeister-competitions::backend/entries.address')])
            ->add('author_zip', 'text', ['label' => trans('partymeister-competitions::backend/entries.zip')])
            ->add('author_city', 'text', ['label' => trans('partymeister-competitions::backend/entries.city')])
            ->add('author_country_iso_3166_1', 'select2', ['label' => trans('partymeister-competitions::backend/entries.country'), 'choices' => \Symfony\Component\Intl\Intl::getRegionBundle()->getCountryNames()])
            ->add('options', 'form', ['wrapper' => [], 'class' => '\Partymeister\Competitions\Forms\Backend\EntryOptionForm', 'label' => false, 'data' => $data])
            ->add('submit', 'submit', ['attr' => ['class' => 'btn btn-primary'], 'label' => trans('partymeister-competitions::backend/entries.save')]);

        if (isset($data['competition'])) {
            if ($data['competition']->competition_type->has_filesize) {
                $this->add('filesize', 'text', ['label' => trans('partymeister-competitions::backend/entries.filesize')]);
            }
            if ($data['competition']->competition_type->has_platform) {
                $this->add('platform', 'text', ['label' => trans('partymeister-competitions::backend/entries.platform')]);
            }
            if ($data['competition']->competition_type->has_running_time) {
                $this->add('running_time', 'text', ['label' => trans('partymeister-competitions::backend/entries.running_time')]);
            }
            if ($data['competition']->competition_type->has_remote_entries) {
                $this->add('is_remote', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.is_remote')]);
            }
            if ($data['competition']->competition_type->has_recordings) {
                $this->add('is_recorded', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.is_recorded')]);
            }

            if ($data['competition']->competition_type->has_composer) {
                $this->add('composer_name', 'text', ['label' => trans('partymeister-competitions::backend/entries.name')])
                    ->add('composer_email', 'text', ['label' => trans('partymeister-competitions::backend/entries.email')])
                    ->add('composer_phone', 'text', ['label' => trans('partymeister-competitions::backend/entries.phone')])
                    ->add('composer_address', 'text', ['label' => trans('partymeister-competitions::backend/entries.address')])
                    ->add('composer_zip', 'text', ['label' => trans('partymeister-competitions::backend/entries.zip')])
                    ->add('composer_city', 'text', ['label' => trans('partymeister-competitions::backend/entries.city')])
                    ->add('composer_country_iso_3166_1', 'select2', ['label' => trans('partymeister-competitions::backend/entries.country'), 'choices' => \Symfony\Component\Intl\Intl::getRegionBundle()->getCountryNames()])
                    ->add('composer_not_member_of_copyright_collective', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.composer_not_member_of_copyright_collective')]);
            }
        }
    }
}
