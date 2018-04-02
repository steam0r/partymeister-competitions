<?php

namespace Partymeister\Competitions\Console\Commands;

use Illuminate\Console\Command;
use Partymeister\Competitions\Events\CompetitionSaved;
use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Services\CompetitionService;

class PartymeisterCompetitionsPublishReleaseFilesCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'partymeister:competitions:publish-release-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make symlinks to all uploaded files';


    protected function mkdir($directory)
    {
        if ( ! is_dir($directory)) {
            mkdir($directory);
        }
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        foreach (Competition::all() as $competition) {
            CompetitionService::hardLinkReleases($competition);
        }
    }
}