<?php

namespace Partymeister\Competitions\Console\Commands;

use Illuminate\Console\Command;
use Partymeister\Competitions\Services\VoteService;

/**
 * Class PartymeisterCompetitionsExportVotesToCSVCommand
 * @package Partymeister\Competitions\Console\Commands
 */
class PartymeisterCompetitionsExportVotesToCSVCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'partymeister:competitions:export-votes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all entries';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $results = VoteService::getAllVotesByRank();

        $csv = '';

        foreach ($results as $competition) {
            foreach ($competition['entries'] as $entry) {

                $csv .= "\"" . $competition['name'] . '";"' . $entry['rank'] . '";"' . $entry['title'] . ' - ' . $entry['author'] . '";"' . $entry['points'] . "\"\n";
            }
        }
        file_put_contents('votes.csv', $csv);
    }
}
