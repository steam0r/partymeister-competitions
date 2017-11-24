<?php

namespace Partymeister\Competitions\Grids;

use Motor\Backend\Grid\Grid;
use Motor\Backend\Grid\Renderers\BladeRenderer;
use Motor\Backend\Grid\Renderers\DateRenderer;
use Motor\Backend\Grid\Renderers\DecorationRenderer;

class EntryGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('id', 'ID', true)->renderer(DecorationRenderer::class, ['style' => 'color: red; font-weight: bold;']);
        $this->addColumn('competition.name', trans('partymeister-competitions::backend/competitions.competition'), true);
        $this->addColumn('name', trans('partymeister-competitions::backend/entries.name'), true)->renderer(BladeRenderer::class, ['template' => 'partymeister-competitions::grid.entry_name']);
        $this->addColumn('sort_position', trans('partymeister-competitions::backend/entries.sort_position'), true);
        $this->addColumn('last_file_uploaded_at', trans('partymeister-competitions::backend/entries.last_file_uploaded_at'), true)->renderer(DateRenderer::class);
        $this->addColumn('status', trans('partymeister-competitions::backend/entries.status'), true)->renderer(BladeRenderer::class, ['template' => 'partymeister-competitions::grid.entry_status']);
        $this->setDefaultSorting('sort_position', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.entries.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.entries.destroy');
    }
}
