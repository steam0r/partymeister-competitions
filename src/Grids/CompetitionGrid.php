<?php

namespace Partymeister\Competitions\Grids;

use Motor\Backend\Grid\Grid;
use Motor\Backend\Grid\Renderers\BooleanRenderer;

class CompetitionGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('name', trans('motor-backend::backend/global.name'), true);
        $this->addColumn('competition_type.name', trans('partymeister-competitions::backend/competition_types.competition_type'), true);
        $this->addColumn('sort_position', trans('partymeister-competitions::backend/competitions.sort_position'), true);
        $this->addColumn('has_prizegiving', trans('partymeister-competitions::backend/competitions.has_prizegiving'), true)->renderer(BooleanRenderer::class);
        $this->addColumn('prizegiving_sort_position', trans('partymeister-competitions::backend/competitions.prizegiving_sort_position'), true);
        $this->addColumn('upload_enabled', trans('partymeister-competitions::backend/competitions.upload_enabled'), true)->renderer(BooleanRenderer::class);
        $this->addColumn('voting_enabled', trans('partymeister-competitions::backend/competitions.voting_enabled'), true)->renderer(BooleanRenderer::class);
        $this->setDefaultSorting('sort_position', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.competitions.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.competitions.destroy');
    }
}
