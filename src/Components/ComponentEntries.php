<?php

namespace Partymeister\Competitions\Components;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Motor\CMS\Models\PageVersionComponent;

class ComponentEntries {

    protected $component;
    protected $pageVersionComponent;
    protected $visitor;

    public function __construct(PageVersionComponent $pageVersionComponent, \Partymeister\Competitions\Models\Component\ComponentEntry $component)
    {
        $this->component = $component;
        $this->pageVersionComponent = $pageVersionComponent;
    }

    public function index(Request $request)
    {
        $this->visitor = Auth::guard('visitor')->user();

        return $this->render();
    }


    public function render()
    {
        return view(config('motor-cms-page-components.components.'.$this->pageVersionComponent->component_name.'.view'), ['component' => $this->component, 'entries' => $this->visitor->entries]);
    }

}
