<?php

namespace Partymeister\Competitions\Http\Controllers\Backend\Competitions;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use League\Fractal\Resource\ResourceAbstract;
use Motor\Backend\Helpers\MediaHelper;
use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\Competition;

use Kris\LaravelFormBuilder\FormBuilderTrait;
use Partymeister\Competitions\Transformers\Competition\EntryTransformer;
use Partymeister\Slides\Models\SlideTemplate;
use Partymeister\Slides\Services\PlaylistService;

class PlaylistsController extends Controller
{

    use FormBuilderTrait;


    public function store(Competition $competition, Request $request)
    {
        PlaylistService::generateCompetitionPlaylist($competition, $request->all());

        return redirect(route('backend.playlists.index'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Competition $competition, Request $request)
    {
        $filename = Str::slug($competition->name . '_' . date('Y-m-d_H-i-s'));
        switch ($request->get('format', 'json')) {
            case 'json':
                $resource = $this->transformCollection($competition->sorted_entries, EntryTransformer::class);

                $data = $this->fractal->createData($resource)->toArray();
                $data = Arr::get($data, 'data');

                $data = [
                    'message' => 'Competition playlist for \'' . $competition->name . '\', generated ' . date('Y-m-d H:i:s'),
                    'data'    => [
                        'competition' => [
                            'name'         => $competition->name,
                            'is_anonymous' => (bool) $competition->competition_type->is_anonymous
                        ],
                        'entries'     => [ 'data' => $data ]
                    ]
                ];

                if ($request->get('download')) {
                    return response()->attachment(json_encode($data), $filename . '.json', 'application/json');
                }

                return response()->json($data);
            case 'm3u':
                $m3u = $this->generateM3u($competition->sorted_entries);

                if ($request->get('download')) {
                    return response()->attachment($m3u, $filename . '.m3u', 'audio/x-mpegurl');
                }

                return $m3u;
                break;
            case 'slides':
                $resource = $this->transformCollection($competition->sorted_entries,
                    \Partymeister\Competitions\Transformers\EntryTransformer::class);

                $data    = $this->fractal->createData($resource)->toArray();
                $entries = Arr::get($data, 'data');

                foreach ($entries as $key => $entry) {
                	$entries[$key]['competition_name'] = strtoupper($entries[$key]['competition_name']);
                	if ($entries[$key]['filesize_bytes'] == 0) {
						$entries[$key]['filesize_human'] = ' ';
					}
					if ($entries[$key]['description'] == '') {
						$entries[$key]['description'] = ' ';
					}
                    if ($key > 0) {
                        $entries[$key]['previous_sort_position'] = ( strlen($key) == 1 ? '0' . $key : $key );
                        $entries[$key]['previous_author']        = $entries[$key - 1]['author'];
                        $entries[$key]['previous_title']         = $entries[$key - 1]['title'];
                    } else {
                        $entries[$key]['previous_sort_position'] = ' ';
                        $entries[$key]['previous_author']        = ' ';
                        $entries[$key]['previous_title']         = ' ';
                    }
                }

                $participants = [];
                if ($competition->competition_type->is_anonymous) {
                    foreach ($entries as $key => $entry) {
                        $participants[]                   = $entry['author'];
                        $entries[$key]['author']          = ' '; // yes it has to be a space because slidemeister does not substitute empty placeholders yet
                        $entries[$key]['previous_author'] = ' '; // yes it has to be a space because slidemeister does not substitute empty placeholders yet
                    }
                }

                shuffle($participants);

                $entryTemplate        = SlideTemplate::where('template_for', 'competition')->first();
                $comingupTemplate     = SlideTemplate::where('template_for', 'coming_up')->first();
                $endTemplate          = SlideTemplate::where('template_for', 'end')->first();
                $participantsTemplate = SlideTemplate::where('template_for', 'participants')->first();

                $videos = [];
                foreach ($competition->file_associations as $fileAssociation) {
                    $videos[] = [
                        'file_id' => $fileAssociation->file->id,
                        'data'    => MediaHelper::getFileInformation($fileAssociation->file, 'file', false,
                            [ 'preview', 'thumb' ])
                    ];
                }

                return view('partymeister-competitions::backend.competitions.playlists.show',
                    compact('competition', 'entries', 'entryTemplate', 'comingupTemplate', 'endTemplate',
                        'participantsTemplate', 'videos', 'participants'));
                break;
        }
    }


    protected function generateM3u($entries)
    {
        $output = '';

        foreach ($entries as $entry) {
            if ($entry->competition->competition_type->is_anonymous) {
                $output .= "#EXTINF:-1," . str_replace(' - ', '-', $entry->title) . "\r\n";
            } else {
                $output .= "#EXTINF:-1," . str_replace(' - ', '-', $entry->author) . " - " . str_replace(' - ', '-',
                        $entry->title) . "\r\n";
            }
        }

        return $output;
    }
}
