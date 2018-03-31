<?php

namespace Partymeister\Competitions\Jobs;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Transformers\Entry\SyncTransformer;
use Partymeister\Competitions\Transformers\EntryTransformer;
use Partymeister\Slides\Helpers\Browsershot;
use Partymeister\Slides\Models\Slide;

class SyncEntry implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $entry;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = fractal()
            ->item($this->entry)
            ->transformWith(new SyncTransformer())
            ->toJson();

        $client = new Client();

        $request = new Request('POST', config('partymeister-competitions-sync.server').config('partymeister-competitions-sync.api.entry'), [ 'content-type' => 'application/json' ], $data);

        try {
            $response = $client->send($request);
        } catch (\Exception $e) {
            Log::warning($e->getMessage());
        }
    }
}
