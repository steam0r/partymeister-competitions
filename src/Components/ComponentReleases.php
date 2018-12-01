<?php

namespace Partymeister\Competitions\Components;

use Illuminate\Http\Request;
use Motor\CMS\Models\PageVersionComponent;
use Partymeister\Competitions\Models\Competition;

class ComponentReleases {

    protected $pageVersionComponent;
    protected $competition;

    public function __construct(PageVersionComponent $pageVersionComponent)
    {
        $this->pageVersionComponent = $pageVersionComponent;
    }

    public function index(Request $request)
    {
        if ($request->get('competition_id') > 0) {
            $this->competition = Competition::where('voting_enabled', TRUE)
                ->where('id', $request->get('competition_id'))
                ->orderBy('updated_at', 'ASC')
                ->first();
        } else {
            $this->competition = Competition::where('voting_enabled', TRUE)->orderBy('updated_at', 'ASC')->first();
        }

        \View::share('activeCompetitionId', $this->competition->id);


        return $this->render();
    }

    public function render()
    {
        return view(config('motor-cms-page-components.components.'.$this->pageVersionComponent->component_name.'.view'), ['competition' => $this->competition]);
    }

}
