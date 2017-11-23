<?php

function create_test_option_group($count = 1)
{
    return factory(Partymeister\Competitions\Models\OptionGroup::class, $count)->create();
}

function create_test_competition_type($count = 1)
{
    return factory(Partymeister\Competitions\Models\CompetitionType::class, $count)->create();
}

function create_test_competition($count = 1)
{
    return factory(Partymeister\Competitions\Models\Competition::class, $count)->create();
}

function create_test_vote_category($count = 1)
{
    return factory(Partymeister\Competitions\Models\VoteCategory::class, $count)->create();
}

function create_test_entry($count = 1)
{
    return factory(Partymeister\Competitions\Models\Entry::class, $count)->create();
}
