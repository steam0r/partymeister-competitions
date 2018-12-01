<?php

namespace Partymeister\Competitions\Http\Controllers\Backend\Component;

use Motor\CMS\Http\Controllers\Component\ComponentController;
use Illuminate\Http\Request;

use Partymeister\Competitions\Models\Component\ComponentEntryScreenshot;
use Partymeister\Competitions\Services\Component\ComponentEntryScreenshotService;
use Partymeister\Competitions\Forms\Backend\Component\ComponentEntryScreenshotForm;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class ComponentEntryScreenshotsController extends ComponentController
{
    use FormBuilderTrait;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->form = $this->form(ComponentEntryScreenshotForm::class);

        return response()->json($this->getFormData('component.entry-screenshots.store', ['mediapool' => false]));
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
        $this->form = $this->form(ComponentEntryScreenshotForm::class);

        if ( ! $this->isValid()) {
            return $this->respondWithValidationError();
        }

        ComponentEntryScreenshotService::createWithForm($request, $this->form);

        return response()->json(['message' => trans('partymeister-competitions::component/entry-screenshots.created')]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(ComponentEntryScreenshot $record)
    {
        $this->form = $this->form(ComponentEntryScreenshotForm::class, [
            'model' => $record
        ]);

        return response()->json($this->getFormData('component.entry-screenshots.update', ['mediapool' => false]));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComponentEntryScreenshot $record)
    {
        $form = $this->form(ComponentEntryScreenshotForm::class);

        if ( ! $this->isValid()) {
            return $this->respondWithValidationError();
        }

        ComponentEntryScreenshotService::updateWithForm($record, $request, $form);

        return response()->json(['message' => trans('partymeister-competitions::component/entry-screenshots.updated')]);
    }
}
