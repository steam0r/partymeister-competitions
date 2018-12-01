<?php

namespace Partymeister\Competitions\Components;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Motor\CMS\Models\PageVersionComponent;
use Partymeister\Competitions\Models\Competition;

class ComponentCompetitionLists {

    protected $pageVersionComponent;

    public function __construct(PageVersionComponent $pageVersionComponent)
    {
        $this->pageVersionComponent = $pageVersionComponent;
    }

    public function index(Request $request)
    {
        return $this->render();
    }

    public function render()
    {
        $competitions = Competition::where('voting_enabled', true)->orderBy('updated_at', 'ASC')->get();
        return view(config('motor-cms-page-components.components.'.$this->pageVersionComponent->component_name.'.view'), ['competitions' => $competitions]);
    }

}
