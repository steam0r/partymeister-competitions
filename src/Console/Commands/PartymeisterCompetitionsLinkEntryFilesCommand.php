<?php

namespace Partymeister\Competitions\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Partymeister\Competitions\Models\Competition;

/**
 * Class PartymeisterCompetitionsLinkEntryFilesCommand
 * @package Partymeister\Competitions\Console\Commands
 */
class PartymeisterCompetitionsLinkEntryFilesCommand extends Command
{

    protected $archiveExtensions = [
      "tar", "tgz", "gz", "zip", "cpio", "rpm", "deb", "gem", "7z", "cab", "rar", "lzh", "gzip"
    ];

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'partymeister:competitions:link-entry-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make symlinks to all uploaded files';


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $canUnzip = shell_exec('which dtrx');
        foreach (Competition::all() as $competition) {
            $directory = base_path('entries/' . Str::slug($competition->name));
            if (! is_dir($directory)) {
                mkdir($directory);
            }
            foreach ($competition->entries()->get() as $entry) {
                $entryDir = $entry->id;
                while (strlen($entryDir) < 4) {
                    $entryDir = '0' . $entryDir;
                }

                $this->mkdir($directory . '/' . $entryDir);

                // Link files
                if ($entry->getMedia('file')->count() > 0) {
                    $this->mkdir($directory . '/' . $entryDir . '/files');
                    foreach ($entry->getMedia('file') as $media) {
                        if (file_exists($media->getPath()) && ! file_exists($directory . '/' . $entryDir . '/files/' . $media->file_name)) {
                          $filePath = $directory . '/' . $entryDir . '/files/';
                            copy($media->getPath(), $filePath . $media->file_name);
                            if ($canUnzip) {
                              print "can unzip";
                              $pathinfo = pathinfo($media->file_name);
                              print_r($pathinfo);
                              if(in_array($pathinfo['extension'], $this->archiveExtensions)) {
                                print "is archive: " . $filePath . " : " . $media->file_name;
                                chdir($filePath);
                                shell_exec('dtrx ' . $media->file_name);
                              }
                            }
                        }

                    }
                }

                // Link screenshot
                if ($entry->getMedia('screenshot')->count() > 0) {
                    $this->mkdir($directory . '/' . $entryDir . '/screenshot');
                    foreach ($entry->getMedia('screenshot') as $media) {
                        if (file_exists($media->getPath()) && ! file_exists($directory . '/' . $entryDir . '/screenshot/' . $media->file_name)) {
                            copy($media->getPath(), $directory . '/' . $entryDir . '/screenshot/' . $media->file_name);
                        }
                    }
                }

                // Link work stages
                if ($entry->competition->competition_type->number_of_work_stages > 0) {
                    $this->mkdir($directory . '/' . $entryDir . '/work_stages');
                    for ($i = 1; $i <= $entry->competition->competition_type->number_of_work_stages; $i++) {
                        $media = $entry->getFirstMedia('work_stage_' . $i);
                        if (! is_null($media)) {
                            if (file_exists($media->getPath()) && ! file_exists($directory . '/' . $entryDir . '/work_stages/' . $i . '_' . $media->file_name)) {
                                copy(
                                    $media->getPath(),
                                    $directory . '/' . $entryDir . '/work_stages/' . $i . '_' . $media->file_name
                                );
                            }
                        }
                    }
                }

                // Link audio
                if ($entry->getMedia('audio')->count() > 0) {
                    $this->mkdir($directory . '/' . $entryDir . '/audio');
                    foreach ($entry->getMedia('audio') as $media) {
                        if (file_exists($media->getPath()) && ! file_exists($directory . '/' . $entryDir . '/audio/' . $media->file_name)) {
                            copy($media->getPath(), $directory . '/' . $entryDir . '/audio/' . $media->file_name);
                        }
                    }
                }

                // Link video
                if ($entry->getMedia('video')->count() > 0) {
                    $this->mkdir($directory . '/' . $entryDir . '/video');
                    foreach ($entry->getMedia('video') as $media) {
                        if (file_exists($media->getPath()) && ! file_exists($directory . '/' . $entryDir . '/video/' . $media->file_name)) {
                            copy($media->getPath(), $directory . '/' . $entryDir . '/video/' . $media->file_name);
                        }
                    }
                }
            }
        }

        //$callbacks = Callback::where('is_timed', true)->where('has_fired', false)->where('embargo_until', '<', date('Y-m-d H:i:s'))->get();
        //
        //foreach ($callbacks as $callback) {
        //    Log::info('Firing callback '.$callback->name);
        //
        //    if ($callback->action == 'notification') {
        //        $status = StuhlService::send($callback->body, $callback->title, '', EVENT_LEVEL_BORING, $callback->destination);
        //    }
        //
        //    $callback->has_fired = true;
        //    $callback->save();
        //}
    }


    /**
     * @param $directory
     */
    protected function mkdir($directory)
    {
        if (! is_dir($directory)) {
            mkdir($directory);
        }
    }
}
