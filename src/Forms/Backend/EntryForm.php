<?php

namespace Partymeister\Competitions\Forms\Backend;

use Kris\LaravelFormBuilder\Form;
use Partymeister\Competitions\Models\Competition;

class EntryForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('competition_id', 'select2', ['label' => trans('partymeister-competitions::backend/competitions.competition'), 'choices' => Competition::orderBy('sort_position')->pluck('name', 'id')->toArray()])
            ->add('sort_position', 'text', ['label' => trans('partymeister-competitions::backend/entries.sort_position')])
            ->add('title', 'text', ['label' => trans('partymeister-competitions::backend/entries.title'), 'rules' => 'required'])
            ->add('author', 'text', ['label' => trans('partymeister-competitions::backend/entries.author'), 'rules' => 'required'])
            ->add('filesize', 'text', ['label' => trans('partymeister-competitions::backend/entries.filesize')])
            ->add('platform', 'text', ['label' => trans('partymeister-competitions::backend/entries.platform')])
            ->add('description', 'textarea', ['label' => trans('partymeister-competitions::backend/entries.description')])
            ->add('organizer_description', 'textarea', ['label' => trans('partymeister-competitions::backend/entries.organizer_description')])
            ->add('running_time', 'text', ['label' => trans('partymeister-competitions::backend/entries.running_time')])
            ->add('custom_option', 'text', ['label' => trans('partymeister-competitions::backend/entries.custom_option')])
            ->add('allow_release', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.allow_release'), 'default_value' => true])
            ->add('is_remote', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.is_remote')])
            ->add('is_recorded', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.is_recorded')])
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

            ->add('composer_name', 'text', ['label' => trans('partymeister-competitions::backend/entries.name')])
            ->add('composer_email', 'text', ['label' => trans('partymeister-competitions::backend/entries.email')])
            ->add('composer_phone', 'text', ['label' => trans('partymeister-competitions::backend/entries.phone')])
            ->add('composer_address', 'text', ['label' => trans('partymeister-competitions::backend/entries.address')])
            ->add('composer_zip', 'text', ['label' => trans('partymeister-competitions::backend/entries.zip')])
            ->add('composer_city', 'text', ['label' => trans('partymeister-competitions::backend/entries.city')])
            ->add('composer_country_iso_3166_1', 'select2', ['label' => trans('partymeister-competitions::backend/entries.country'), 'choices' => \Symfony\Component\Intl\Intl::getRegionBundle()->getCountryNames()])
            ->add('composer_not_member_of_copyright_collective', 'checkbox', ['label' => trans('partymeister-competitions::backend/entries.composer_not_member_of_copyright_collective')])

            ->add('submit', 'submit', ['attr' => ['class' => 'btn btn-primary'], 'label' => trans('partymeister-competitions::backend/entries.save')]);
    }
}
