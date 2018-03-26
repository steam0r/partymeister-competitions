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
    Route::resource('access_keys', 'AccessKeysController');
    Route::resource('competition_prizes', 'CompetitionPrizesController');
    Route::resource('votes', 'VotesController');
});

Route::group([
    'middleware' => [ 'web', 'web_auth', 'bindings', 'permission' ],
    'namespace'  => 'Partymeister\Competitions\Http\Controllers\Api',
    'prefix'     => 'ajax',
    'as'         => 'ajax.',
], function () {
    Route::post('access_keys/generate', 'AccessKeys\GenerateController@index')->name('access_keys.generate');
});

