<?php

namespace Partymeister\Competitions\Http\Controllers\Backend\Entries;

use Illuminate\Http\Request;
use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Forms\Backend\CommentForm;
use Partymeister\Competitions\Models\AccessKey;
use Partymeister\Competitions\Http\Requests\Backend\AccessKeyRequest;
use Partymeister\Competitions\Models\Comment;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Services\AccessKeyService;
use Partymeister\Competitions\Grids\AccessKeyGrid;
use Partymeister\Competitions\Forms\Backend\AccessKeyForm;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class CommentsController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Entry $record)
    {
        $form    = $this->form(CommentForm::class, [
            'method'  => 'POST',
            'url'     => route('backend.entries.comments.store', [ $record->id ]),
            'enctype' => 'multipart/form-data',
            'model'   => $record
        ]);

        $comments = $record->comments;

        return view('partymeister-competitions::backend.entries.comments.index', compact('form', 'record', 'comments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Entry $record)
    {
        if ($request->get('mark_as_read') == 1) {
            foreach ($record->comments()->get() as $comment) {
                $comment->read_by_organizer = true;
                $comment->save();
            }
            return redirect('backend/entries/comments/'.$record->id);
        }

        $form = $this->form(CommentForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        foreach ($record->comments()->get() as $comment) {
            $comment->read_by_organizer = true;
            $comment->save();
        }

        $c = new Comment();
        $c->visitor_id = $record->visitor_id;
        $c->read_by_organizer = true;
        $c->model_type = get_class($record);
        $c->model_id = $record->id;
        $c->author = 'Revision Organizing';
        $c->message = $request->get('message');
        $c->save();

        flash()->success(trans('partymeister-competitions::backend/access_keys.created'));

        return redirect('backend/entries/comments/'.$record->id);
    }
}
