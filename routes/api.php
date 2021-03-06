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
    Route::get('competitions/{competition}/playlist', 'Competitions\PlaylistsController@index')->name('competitions.playlist.index');
    Route::resource('vote_categories', 'VoteCategoriesController');
    Route::resource('entries', 'EntriesController');
    Route::resource('access_keys', 'AccessKeysController');
    Route::resource('competition_prizes', 'CompetitionPrizesController');
    Route::resource('votes/results', 'Votes\ResultsController');
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

Route::post('api/sync/competition', 'Partymeister\Competitions\Http\Controllers\Api\SyncController@competition');
Route::post('api/sync/entry', 'Partymeister\Competitions\Http\Controllers\Api\SyncController@entry');
Route::post('api/sync/livevote', 'Partymeister\Competitions\Http\Controllers\Api\SyncController@livevote');

Route::group([
    'middleware' => [ 'web', 'auth:visitor', 'bindings' ],
    'namespace'  => 'Partymeister\Competitions\Http\Controllers\Api\Frontend',
    'prefix'     => 'ajax',
    'as'         => 'ajax.',
], function () {
    Route::post('votes/{api_token}/submit', 'VotesController@store')->name('votes.submit');
});
