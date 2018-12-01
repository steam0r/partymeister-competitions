<?php

namespace Partymeister\Competitions\Components;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Motor\CMS\Models\PageVersionComponent;
use Partymeister\Competitions\Forms\Component\EntryScreenshotForm;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\Services\EntryService;

class ComponentEntryScreenshots
{

    use FormBuilderTrait;

    protected $pageVersionComponent;

    protected $component;

    protected $entryScreenshotForm;

    protected $record;

    protected $request;


    public function __construct(PageVersionComponent $pageVersionComponent, \Partymeister\Competitions\Models\Component\ComponentEntryScreenshot $component)
    {
        $this->pageVersionComponent = $pageVersionComponent;
        $this->component = $component;
    }


    public function index(Request $request)
    {
        $visitor = Auth::guard('visitor')->user();

        if (is_null($visitor)) {
            return redirect()->back();
        }

        if (is_null($request->get('entry_id'))) {
            return redirect()->back();
        }

        $this->record = Entry::find($request->get('entry_id'));
        if (is_null($this->record)) {
            return redirect()->back();
        }

        if ($visitor->id != $this->record->visitor_id) {
            return redirect()->back();
        }

        $this->request = $request;

        $this->entryScreenshotForm = $this->form(EntryScreenshotForm::class, [
            'name'    => 'entry-screenshot',
            'url'     => $this->request->url() . '?entry_id=' . $this->record->id,
            'method'  => 'PATCH',
            'enctype' => 'multipart/form-data',
            'model'   => $this->record
        ]);

        switch ($request->method()) {
            case 'PATCH':
                $result = $this->patch();
                if ($result instanceOf RedirectResponse) {
                    return $result;
                }
                break;
        }

        return $this->render();
    }


    protected function patch()
    {
        // It will automatically use current request, get the rules, and do the validation
        if ( ! $this->entryScreenshotForm->isValid()) {
            return redirect()->back()->withErrors($this->entryScreenshotForm->getErrors())->withInput();
        }

        EntryService::updateWithForm($this->record, $this->request, $this->entryScreenshotForm);

        return redirect(route('frontend.pages.index', ['slug' => $this->component->entries_page->full_slug]));
    }


    public function render()
    {
        return view(config('motor-cms-page-components.components.' . $this->pageVersionComponent->component_name . '.view'),
            ['entryScreenshotForm' => $this->entryScreenshotForm, 'record' => $this->record, 'component' => $this->component]);
    }

}
