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
        Route::get('entries/comments/{entry}', 'Entries\CommentsController@index')->name('entries.comments.index');
        Route::post('entries/comments/{entry}', 'Entries\CommentsController@store')->name('entries.comments.store');
        Route::get('access_keys/export_csv', 'AccessKeys\ExportController@csv')->name('access_keys.export.csv');
        Route::get('access_keys/export_pdf', 'AccessKeys\ExportController@pdf')->name('access_keys.export.pdf');
        Route::resource('access_keys', 'AccessKeysController');
        Route::get('competition_prizes/export_receipt', 'CompetitionPrizes\ExportController@receipt')->name('competition_prizes.export.receipt');
        Route::get('competition_prizes/export_prizesheet', 'CompetitionPrizes\ExportController@prizesheet')->name('competition_prizes.export.prizesheet');
        Route::resource('competition_prizes', 'CompetitionPrizesController');
        Route::get('votes/playlist', 'Votes\PlaylistsController@index')->name('votes.playlist.index');
        Route::post('votes/playlist', 'Votes\PlaylistsController@store')->name('votes.playlist.store');
        Route::resource('votes', 'VotesController');
    });
});

Route::get('results', function(){
    $results = \Partymeister\Competitions\Services\VoteService::getAllVotesByRank();

    foreach ($results as $competition) {
        echo $competition['name']."\r\n";
        foreach ($competition['entries'] as $entry) {
            echo $entry['points']."\t".$entry['title']."\t".$entry['author']."\r\n";
        }
        echo "\r\n";
    }
});