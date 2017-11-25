<?php

return [
    'items' => [
        120 => [
            'slug'        => 'partymeister-competitions',
            'name'        => 'partymeister-competitions::backend/global.competitions',
            'icon'        => 'fa fa-trophy',
            'route'       => null,
            'roles'       => [ 'SuperAdmin' ],
            'permissions' => [ 'partymeister-competitions.read' ],
            'items'       => [
                100 => [ // <-- !!! replace 170 with your own sort position !!!
                    'slug' => 'competitions',
                    'name'  => 'partymeister-competitions::backend/competitions.competitions',
                    'icon'  => 'fa fa-angle-right',
                    'route' => 'backend.competitions.index',
                    'roles'       => [ 'SuperAdmin' ],
                    'permissions' => [ 'competitions.read' ],
                ],
                110 => [ // <-- !!! replace 867 with your own sort position !!!
                    'slug' => 'entries',
                    'name'  => 'partymeister-competitions::backend/entries.entries',
                    'icon'  => 'fa fa-angle-right',
                    'route' => 'backend.entries.index',
                    'roles'       => [ 'SuperAdmin' ],
                    'permissions' => [ 'entries.read' ],
                ],
                120 => [ // <-- !!! replace 893 with your own sort position !!!
                    'slug' => 'option_groups',
                    'name'  => 'partymeister-competitions::backend/option_groups.option_groups',
                    'icon'  => 'fa fa-angle-right',
                    'route' => 'backend.option_groups.index',
                    'roles'       => [ 'SuperAdmin' ],
                    'permissions' => [ 'option_groups.read' ],
                ],
                130 => [ // <-- !!! replace 318 with your own sort position !!!
                    'slug' => 'competition_types',
                    'name'  => 'partymeister-competitions::backend/competition_types.competition_types',
                    'icon'  => 'fa fa-angle-right',
                    'route' => 'backend.competition_types.index',
                    'roles'       => [ 'SuperAdmin' ],
                    'permissions' => [ 'competition_types.read' ],
                ],
                140 => [ // <-- !!! replace 929 with your own sort position !!!
                    'slug' => 'vote_categories',
                    'name'  => 'partymeister-competitions::backend/vote_categories.vote_categories',
                    'icon'  => 'fa fa-angle-right',
                    'route' => 'backend.vote_categories.index',
                    'roles'       => [ 'SuperAdmin' ],
                    'permissions' => [ 'vote_categories.read' ],
                ],
            ]
        ],
    ]
];