<?php

return [
    'items' => [
        120 => [
            'slug'        => 'partymeister-competitions',
            'name'        => 'partymeister-competitions::backend/global.competitions',
            'icon'        => 'fa fa-home',
            'route'       => null,
            'roles'       => [ 'SuperAdmin' ],
            'permissions' => [ 'partymeister-competitions.read' ],
            'items'       => [
                100 => [ // <-- !!! replace 893 with your own sort position !!!
                    'slug' => 'option_groups',
                    'name'  => 'partymeister-competitions::backend/option_groups.option_groups',
                    'icon'  => 'fa fa-plus',
                    'route' => 'backend.option_groups.index',
                    'roles'       => [ 'SuperAdmin' ],
                    'permissions' => [ 'option_groups.read' ],
                ],

            ]
        ],
    ]
];