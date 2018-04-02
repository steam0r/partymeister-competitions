<?php

namespace Partymeister\Competitions\Http\Controllers\Backend;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\Vote;
use Partymeister\Competitions\Http\Requests\Backend\VoteRequest;
use Partymeister\Competitions\Services\VoteService;
use Partymeister\Competitions\Grids\VoteGrid;
use Partymeister\Competitions\Forms\Backend\VoteForm;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class VotesController extends Controller
{

    use FormBuilderTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = VoteService::getAllVotesByRank();
        $special = VoteService::getAllSpecialVotesByRank();

        return view('partymeister-competitions::backend.votes.index', compact('results', 'special'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(VoteForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.votes.store',
            'enctype' => 'multipart/form-data'
        ]);

        $results = VoteService::getAllVotesByRank();

        return view('partymeister-competitions::backend.votes.create', compact('form', 'results'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VoteRequest $request)
    {
        $form = $this->form(VoteForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        VoteService::addVotes($request);

        flash()->success(trans('partymeister-competitions::backend/votes.created'));

        return redirect('backend/votes');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $record)
    {
        $form = $this->form(VoteForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.votes.update', [ $record->id ]),
            'enctype' => 'multipart/form-data',
            'model'   => $record
        ]);

        return view('partymeister-competitions::backend.votes.edit', compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VoteRequest $request, Vote $record)
    {
        $form = $this->form(VoteForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        VoteService::updateWithForm($record, $request, $form);

        flash()->success(trans('partymeister-competitions::backend/votes.updated'));

        return redirect('backend/votes');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $record)
    {
        VoteService::delete($record);

        flash()->success(trans('partymeister-competitions::backend/votes.deleted'));

        return redirect('backend/votes');
    }
}
