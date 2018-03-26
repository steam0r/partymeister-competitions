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
        Route::get('competitions/{competition}/playlist', 'Competitions\PlaylistsController@index')->name('competitions.playlist.index');
        Route::post('competitions/{competition}/playlist', 'Competitions\PlaylistsController@store')->name('competitions.playlist.store');
        Route::resource('competitions', 'CompetitionsController');
        Route::resource('vote_categories', 'VoteCategoriesController');
        Route::resource('entries', 'EntriesController');
        Route::get('access_keys/export_csv', 'AccessKeys\ExportController@csv')->name('access_keys.export.csv');
        Route::get('access_keys/export_pdf', 'AccessKeys\ExportController@pdf')->name('access_keys.export.pdf');
        Route::resource('access_keys', 'AccessKeysController');
        Route::get('competition_prizes/export_receipt', 'CompetitionPrizes\ExportController@receipt')->name('competition_prizes.export.receipt');
        Route::get('competition_prizes/export_prizesheet', 'CompetitionPrizes\ExportController@prizesheet')->name('competition_prizes.export.prizesheet');
        Route::resource('competition_prizes', 'CompetitionPrizesController');
        Route::resource('votes', 'VotesController');
    });
});
