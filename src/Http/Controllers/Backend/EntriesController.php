<?php

namespace Partymeister\Competitions\Http\Controllers\Backend;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Http\Requests\Backend\EntryRequest;
use Partymeister\Competitions\Services\EntryService;
use Partymeister\Competitions\Grids\EntryGrid;
use Partymeister\Competitions\Forms\Backend\EntryForm;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class EntriesController extends Controller
{

    use FormBuilderTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = new EntryGrid(Entry::class);

        $service      = EntryService::collection($grid);
        $grid->filter = $service->getFilter();
        $paginator    = $service->getPaginator();

        return view('partymeister-competitions::backend.entries.index', compact('paginator', 'grid'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(EntryRequest $request)
    {
        $form = $this->form(EntryForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.entries.store',
            'enctype' => 'multipart/form-data'
        ]);

        return view('partymeister-competitions::backend.entries.create', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EntryRequest $request)
    {
        $form = $this->form(EntryForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ((int) $request->get('reload_on_change') == 1) {
            return redirect()->back()->withInput();
        }
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        EntryService::createWithForm($request, $form);

        flash()->success(trans('partymeister-competitions::backend/entries.created'));

        return redirect('backend/entries');
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
    public function edit(Entry $record)
    {
        $form = $this->form(EntryForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.entries.update', [ $record->id ]),
            'enctype' => 'multipart/form-data',
            'model'   => $record
        ]);

        return view('partymeister-competitions::backend.entries.edit', compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(EntryRequest $request, Entry $record)
    {
        $form = $this->form(EntryForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ((int) $request->get('reload_on_change') == 1) {
            return redirect()->back()->withInput();
        }

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        EntryService::updateWithForm($record, $request, $form);

        flash()->success(trans('partymeister-competitions::backend/entries.updated'));

        return redirect('backend/entries');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entry $record)
    {
        EntryService::delete($record);

        flash()->success(trans('partymeister-competitions::backend/entries.deleted'));

        return redirect('backend/entries');
    }
}
