<?php

namespace Partymeister\Competitions\Http\Controllers\Backend;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\VoteCategory;
use Partymeister\Competitions\Http\Requests\Backend\VoteCategoryRequest;
use Partymeister\Competitions\Services\VoteCategoryService;
use Partymeister\Competitions\Grids\VoteCategoryGrid;
use Partymeister\Competitions\Forms\Backend\VoteCategoryForm;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class VoteCategoriesController extends Controller
{
    use FormBuilderTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = new VoteCategoryGrid(VoteCategory::class);

        $service = VoteCategoryService::collection($grid);
        $grid->filter = $service->getFilter();
        $paginator    = $service->getPaginator();

        return view('partymeister-competitions::backend.vote_categories.index', compact('paginator', 'grid'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(VoteCategoryForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.vote_categories.store',
            'enctype' => 'multipart/form-data'
        ]);

        return view('partymeister-competitions::backend.vote_categories.create', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VoteCategoryRequest $request)
    {
        $form = $this->form(VoteCategoryForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        VoteCategoryService::createWithForm($request, $form);

        flash()->success(trans('partymeister-competitions::backend/vote_categories.created'));

        return redirect('backend/vote_categories');
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
    public function edit(VoteCategory $record)
    {
        $form = $this->form(VoteCategoryForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.vote_categories.update', [ $record->id ]),
            'enctype' => 'multipart/form-data',
            'model'   => $record
        ]);

        return view('partymeister-competitions::backend.vote_categories.edit', compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VoteCategoryRequest $request, VoteCategory $record)
    {
        $form = $this->form(VoteCategoryForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        VoteCategoryService::updateWithForm($record, $request, $form);

        flash()->success(trans('partymeister-competitions::backend/vote_categories.updated'));

        return redirect('backend/vote_categories');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoteCategory $record)
    {
        VoteCategoryService::delete($record);

        flash()->success(trans('partymeister-competitions::backend/vote_categories.deleted'));

        return redirect('backend/vote_categories');
    }
}