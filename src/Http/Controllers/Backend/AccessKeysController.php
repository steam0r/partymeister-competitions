<?php

namespace Partymeister\Competitions\Http\Controllers\Backend;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Models\AccessKey;
use Partymeister\Competitions\Http\Requests\Backend\AccessKeyRequest;
use Partymeister\Competitions\Services\AccessKeyService;
use Partymeister\Competitions\Grids\AccessKeyGrid;
use Partymeister\Competitions\Forms\Backend\AccessKeyForm;

use Kris\LaravelFormBuilder\FormBuilderTrait;

class AccessKeysController extends Controller
{

    use FormBuilderTrait;


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grid = new AccessKeyGrid(AccessKey::class);

        $service = AccessKeyService::collection($grid);
        $grid->setFilter($service->getFilter());
        $paginator = $service->getPaginator();

        return view('partymeister-competitions::backend.access_keys.index', compact('paginator', 'grid'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->form(AccessKeyForm::class, [
            'method'  => 'POST',
            'route'   => 'backend.access_keys.store',
            'enctype' => 'multipart/form-data'
        ]);

        return view('partymeister-competitions::backend.access_keys.create', compact('form'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AccessKeyRequest $request)
    {
        $form = $this->form(AccessKeyForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        AccessKeyService::createWithForm($request, $form);

        flash()->success(trans('partymeister-competitions::backend/access_keys.created'));

        return redirect('backend/access_keys');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(AccessKey $record)
    {
        $form = $this->form(AccessKeyForm::class, [
            'method'  => 'PATCH',
            'url'     => route('backend.access_keys.update', [ $record->id ]),
            'enctype' => 'multipart/form-data',
            'model'   => $record
        ]);

        return view('partymeister-competitions::backend.access_keys.edit', compact('form'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AccessKeyRequest $request, AccessKey $record)
    {
        $form = $this->form(AccessKeyForm::class);

        // It will automatically use current request, get the rules, and do the validation
        if ( ! $form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        AccessKeyService::updateWithForm($record, $request, $form);

        flash()->success(trans('partymeister-competitions::backend/access_keys.updated'));

        return redirect('backend/access_keys');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccessKey $record)
    {
        AccessKeyService::delete($record);

        flash()->success(trans('partymeister-competitions::backend/access_keys.deleted'));

        return redirect('backend/access_keys');
    }
}
