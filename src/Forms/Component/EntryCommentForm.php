<?php

namespace Partymeister\Competitions\Forms\Component;

use Kris\LaravelFormBuilder\Form;

class EntryCommentForm extends Form
{

    public function buildForm()
    {
        $this
            ->add('message', 'textarea', ['label' => 'Message'])
            ->add('mark_as_read', 'hidden', ['attr' => ['id' => 'mark_as_read']])
            ->add('submit', 'submit', ['attr' => ['class' => 'button success expanded'], 'label' => 'Send']);
    }
}

