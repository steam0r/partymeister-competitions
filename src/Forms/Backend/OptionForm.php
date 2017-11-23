<?php

namespace Partymeister\Competitions\Forms\Backend;

use Kris\LaravelFormBuilder\Form;

class OptionForm extends Form
{

    public function buildForm()
    {
        $this->add('name', 'text', [
            'label'   => false,
            'wrapper' => [ 'class' => 'form-group col-md-11' ],
            'attr'    => [ 'class' => 'form-control options-name', 'tabindex' => 10 ]
        ])
            ->add('delete', 'static', [
                'label' => false,
                'tag'   => 'div',
                'attr'  => [ 'class' => 'col-md-1' ],
                'value' => '<button class="btn btn-danger btn-sm remove-options">X</button>',
            ]);
    }
}
