<?php

namespace Partymeister\Competitions\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Transformers\CompetitionTransformer;

class SyncCompetition implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $competition;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = fractal($this->competition, new CompetitionTransformer())->toJson();

        $client = new Client([
            'verify' => false
        ]);

        $request = new Request('POST', config('partymeister-competitions-sync.server').config('partymeister-competitions-sync.api.competition'), [ 'content-type' => 'application/json' ], $data);

        try {
            $response = $client->send($request);
        } catch (\Exception $e) {
            Log::warning($e->getMessage());
        }
    }
}
