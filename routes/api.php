<?php
Route::group([
    'middleware' => [ 'auth:api', 'bindings', 'permission' ],
    'namespace'  => 'Partymeister\Competitions\Http\Controllers\Api',
    'prefix'     => 'api',
    'as'         => 'api.',
], function () {
    Route::resource('option_groups', 'OptionGroupsController');
    Route::resource('competition_types', 'CompetitionTypesController');
    Route::resource('competitions', 'CompetitionsController');
    Route::resource('vote_categories', 'VoteCategoriesController');
    Route::resource('entries', 'EntriesController');
});
