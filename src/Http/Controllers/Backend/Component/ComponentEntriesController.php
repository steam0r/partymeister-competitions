<?php

namespace Partymeister\Competitions\Http\Controllers\Backend\Component;

use Motor\CMS\Http\Controllers\Component\ComponentController;
use Illuminate\Http\Request;

use Partymeister\Competitions\Models\Component\ComponentEntry;
use Partymeister\Competitions\Services\Component\ComponentEntryService;
use Partymeister\Competitions\Forms\Backend\Component\ComponentEntryForm;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class ComponentEntriesController extends ComponentController
{
    use FormBuilderTrait;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->form = $this->form(ComponentEntryForm::class);

        return response()->json($this->getFormData('component.entries.store', ['mediapool' => false]));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->form = $this->form(ComponentEntryForm::class);

        if ( ! $this->isValid()) {
            return $this->respondWithValidationError();
        }

        ComponentEntryService::createWithForm($request, $this->form);

        return response()->json(['message' => trans('partymeister-competitions::component/entries.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ComponentEntry $record)
    {
        $this->form = $this->form(ComponentEntryForm::class, [
            'model' => $record
        ]);

        return response()->json($this->getFormData('component.entries.update', ['mediapool' => false]));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComponentEntry $record)
    {
        $form = $this->form(ComponentEntryForm::class);

        if ( ! $this->isValid()) {
            return $this->respondWithValidationError();
        }

        ComponentEntryService::updateWithForm($record, $request, $form);

        return response()->json(['message' => trans('partymeister-competitions::component/entries.updated')]);
    }
}
