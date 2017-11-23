<?php

Route::group([
    'as'         => 'backend.',
    'prefix'     => 'backend',
    'namespace'  => 'Partymeister\Competitions\Http\Controllers\Backend',
    'middleware' => [
        'web',
        'web_auth',
        'navigation'
    ]
], function () {

    Route::group([ 'middleware' => [ 'permission' ] ], function () {
        Route::resource('option_groups', 'OptionGroupsController');
        Route::resource('competition_types', 'CompetitionTypesController');
        Route::resource('competitions', 'CompetitionsController');
        Route::resource('vote_categories', 'VoteCategoriesController');
        Route::resource('entries', 'EntriesController');
    });
});
