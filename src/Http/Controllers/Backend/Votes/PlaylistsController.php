<?php

namespace Partymeister\Competitions\Http\Controllers\Backend\Votes;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use League\Fractal\Resource\ResourceAbstract;
use Motor\Backend\Helpers\MediaHelper;
use Motor\Backend\Http\Controllers\Controller;

use Motor\Backend\Models\Category;
use Partymeister\Competitions\Helpers\CallbackHelper;
use Partymeister\Competitions\Models\Competition;

use Kris\LaravelFormBuilder\FormBuilderTrait;
use Partymeister\Competitions\Services\CompetitionService;
use Partymeister\Competitions\Services\VoteService;
use Partymeister\Competitions\Transformers\Competition\EntryTransformer;
use Partymeister\Core\Models\Callback;
use Partymeister\Slides\Models\Playlist;
use Partymeister\Slides\Models\Slide;
use Partymeister\Slides\Models\SlideTemplate;
use Partymeister\Slides\Models\Transition;
use Partymeister\Slides\Services\PlaylistService;

class PlaylistsController extends Controller
{

    public function store(Request $request)
    {
        PlaylistService::generatePrizegivingPlaylist($request->all());
        dd("...");
        $category = Category::where('scope', 'slides')->where('name', 'Prizegiving (actual)')->first();

        foreach (Slide::where('category_id', $category->id)->get() as $slide) {
            $slide->delete();
        }

        //// 4. create playlist
        //$playlist = Playlist::where('name', 'Prizegiving: Actual prizegiving with winners')->first();
        //if (is_null($playlist)) {
        //    $playlist = new Playlist();
        //}

        //$playlist->name = 'Prizegiving: Actual prizegiving with winners';
        //$playlist->type = 'video';
        //$playlist->save();

        // 2. create a slide category for this competition in case it does not exist yet
        $category = Category::where('scope', 'slides')->where('name', 'Prizegiving (actual)')->first();
        if (is_null($category)) {
            $rootNode = Category::where('scope', 'slides')->where('_lft', 1)->first();
            if (is_null($rootNode)) {
                die("Root node for slide category tree does not exist");
            }
            $c        = new Category();
            $c->scope = 'slides';
            $c->name  = 'Prizegiving (actual)';
            $rootNode->appendNode($c);
        }

        // 3. save slides
        $count    = 0;
        $slideIds = [];
        $data = $request->all();
        foreach (array_get($data, 'slide', []) as $slideName => $definitions) {

            $count++;
            $type                 = array_get($data, 'type.' . $slideName);
            $name                 = array_get($data, 'name.' . $slideName);
            $slideType            = config('partymeister-competitions-slides.' . $type . '.slide_type', 'default');
            $midiNote             = config('partymeister-competitions-slides.' . $type . '.midi_note', 0);
            $transitionIdentifier = config('partymeister-competitions-slides.' . $type . '.transition', 0);
            $transitionDuration   = config('partymeister-competitions-slides.' . $type . '.transition_duration', 2000);
            $duration             = config('partymeister-competitions-slides.' . $type . '.duration', 20);
            $isAdvancedManually   = config('partymeister-competitions-slides.' . $type . '.is_advanced_manually', true);

            $transition = Transition::where('identifier', $transitionIdentifier)->first();

            $callback = null;

            switch ($type) {
                case 'comingup':
                    $callback = CallbackHelper::prizegivingStarts();
                    break;
            }

            $s              = new Slide();
            $s->category_id = $category->id;
            $s->name        = $name;
            $s->slide_type  = $slideType;
            $s->definitions = $definitions;

            $s->save();

            $s->addMedia(public_path() . '/images/generating-preview.png')
              ->preservingOriginal()
              ->withCustomProperties([ 'generating' => true ])
              ->toMediaCollection('preview', 'media');

            // 7. generate slides
            // Convert PNG to actual file
            $pngData = array_get($data, 'final.' . $slideName);
            $pngData = substr($pngData, 22);
            file_put_contents(storage_path() . '/final_' . $slideName . '.png', base64_decode($pngData));

            $pngData = array_get($data, 'preview.' . $slideName);
            $pngData = substr($pngData, 22);
            file_put_contents(storage_path() . '/preview_' . $slideName . '.png', base64_decode($pngData));

            $s->clearMediaCollection('preview');
            $s->clearMediaCollection('final');
            $s->addMedia(storage_path() . '/preview_' . $slideName . '.png')->toMediaCollection('preview', 'media');
            $s->addMedia(storage_path() . '/final_' . $slideName . '.png')->toMediaCollection('final', 'media');

            $slideIds[] = $s->id;

            //event(new SlideSaved($s, 'slides'));
        }

        return redirect(route('backend.votes.index'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $results      = VoteService::getAllVotesByRank('ASC');
        $specialVotes = VoteService::getAllSpecialVotesByRank();

        foreach ($specialVotes as $entryKey => $entry) {
            if ($entryKey > 6) {
                unset($specialVotes[$entryKey]);
            }
        }
        shuffle($specialVotes);

        $comments = [];
        foreach ($results as $competition) {
            $comments[$competition['id']] = [];
            foreach ($competition['entries'] as $entry) {
                foreach ($entry['comments'] as $comment) {
                    if (strlen($comment) < 30) {
                        $comments[$competition['id']][] = $comment;
                        $comments[$competition['id']]   = array_unique($comments[$competition['id']]);
                    }
                }
            }
            shuffle($comments[$competition['id']]);
            $chunks = array_chunk($comments[$competition['id']], 10);
            if (count($chunks) > 0) {
                $comments[$competition['id']] = $chunks[0];
            } else {
                $comments[$competition['id']] = [];
            }
            $comments[$competition['id']] = implode('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',
                $comments[$competition['id']]);

        }

        $prizegivingTemplate = SlideTemplate::where('template_for', 'prizegiving')->first();
        $comingupTemplate    = SlideTemplate::where('template_for', 'coming_up')->first();
        $endTemplate         = SlideTemplate::where('template_for', 'end')->first();
        $commentsTemplate    = SlideTemplate::where('template_for', 'comments')->first();

        foreach ($results as $key => $competition) {
            foreach ($competition['entries'] as $entryKey => $entry) {
                if ($entryKey > 6) {
                    unset($results[$key]['entries'][$entryKey]);
                }
            }
            shuffle($results[$key]['entries']);
        }

        $renderSupport = false;
        if ($request->get('support')) {
            $renderSupport = true;
        }
        $renderNow = false;
        if ($request->get('now')) {
            $renderNow = true;
        }
        $renderCompetitions = false;
        if ($request->get('competitions')) {
            $renderCompetitions = true;

        }
        $renderComments = false;
        if ($request->get('comments')) {
            $renderComments = true;

        }
        $renderBars = false;
        if ($request->get('bars')) {
            $renderBars = true;
        }
        $renderWinners = false;
        if ($request->get('winners')) {
            $renderWinners = true;
        }

        return view('partymeister-competitions::backend.votes.playlists.show',
            compact('results', 'comments', 'commentsTemplate', 'specialVotes', 'prizegivingTemplate',
                'comingupTemplate', 'endTemplate', 'renderSupport', 'renderCompetitions', 'renderBars', 'renderWinners', 'renderComments', 'renderNow'));

    }
}
