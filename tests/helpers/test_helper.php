<?php

function create_test_option_group($count = 1)
{
    return factory(Partymeister\Competitions\Models\OptionGroup::class, $count)->create();
}
