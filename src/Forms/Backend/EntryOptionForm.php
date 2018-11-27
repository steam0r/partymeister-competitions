<?php

namespace Partymeister\Competitions\Forms\Backend;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use Kris\LaravelFormBuilder\Form;
use Partymeister\Competitions\Models\Competition;

class EntryOptionForm extends Form
{

    public function buildForm()
    {
        $selected = [];

        if (isset($this->model['options'])) {
            foreach ($this->model['options'] as $option) {
                $selected[] = $option->id;
            }
        }

        if (isset($this->data['competition']) && ! is_null($this->data['competition'])) {
            foreach ($this->data['competition']->option_groups as $optionGroup) {
                $options = [];
                foreach ($optionGroup->options as $option) {
                    $options[$option->id] = $option->name;
                }
                switch ($optionGroup->type) {
                    case 'multiple':
                        $this->add(Str::slug($optionGroup->name, '_'), 'choice', [
                            'choices'        => $options,
                            'selected'       => $selected,
                            'wrapper'        => [ 'class' => 'row' ],
                            'choice_options' => [
                                'wrapper'    => [ 'class' => 'col-md-3' ],
                                'label_attr' => [ 'class' => 'form-label' ],
                            ],
                            'expanded'       => true,
                            'multiple'       => true,
                            'label'          => false,
                        ]);
                        break;
                    case 'single':
                        $this->add(Str::slug($optionGroup->name, '_'), 'choice', [
                            'choices'        => $options,
                            'selected'       => $selected,
                            'wrapper'        => [ 'class' => 'row' ],
                            'choice_options' => [
                                'wrapper'    => [ 'class' => 'col-md-3' ],
                                'label_attr' => [ 'class' => 'form-label' ],
                            ],
                            'expanded'       => true,
                            'label'          => false,
                        ]);
                        break;
                }
            }
        }
    }
}
