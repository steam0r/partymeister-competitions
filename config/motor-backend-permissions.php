<?php

return [
    'option_groups'     => [
        'name'   => 'partymeister-competitions::backend/option_groups.option_groups',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
    'competition_types' => [
        'name'   => 'partymeister-competitions::backend/competition_types.competition_types',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
    'competitions'      => [
        'name'   => 'partymeister-competitions::backend/competitions.competitions',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
    'vote_categories'   => [
        'name'   => 'partymeister-competitions::backend/vote_categories.vote_categories',
        'values' => [
            'read',
            'write',
            'delete'
        ]
    ],
];