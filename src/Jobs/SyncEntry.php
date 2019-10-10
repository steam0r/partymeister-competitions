<?php

namespace Partymeister\Competitions\Jobs;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Transformers\Entry\SyncTransformer;

/**
 * Class SyncEntry
 * @package Partymeister\Competitions\Jobs
 */
class SyncEntry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Entry
     */
    public $entry;


    /**
     * Create a new job instance.
     *
     * SyncEntry constructor.
     * @param Entry $entry
     */
    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }


    /**
     * Execute the job.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $data = fractal()->item($this->entry)->transformWith(new SyncTransformer())->toJson();

        $client = new Client([
            'verify' => false
        ]);

        $request = new Request(
            'POST',
            config('partymeister-competitions-sync.server') . config('partymeister-competitions-sync.api.entry'),
            [ 'content-type' => 'application/json' ],
            $data
        );

        try {
            $response = $client->send($request);
        } catch (Exception $e) {
            Log::warning($e->getMessage());
        }
    }
}
