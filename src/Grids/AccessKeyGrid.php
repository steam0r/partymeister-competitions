<?php

namespace Partymeister\Competitions\Grids;

use Motor\Backend\Grid\Grid;
use Motor\Backend\Grid\Renderers\DateRenderer;

class AccessKeyGrid extends Grid
{

    protected function setup()
    {
        $this->addColumn('access_key', trans('partymeister-competitions::backend/access_keys.access_key'), true);
        $this->addColumn('ip_address', trans('partymeister-competitions::backend/access_keys.ip_address'), true);
        $this->addColumn('registered_at', trans('partymeister-competitions::backend/access_keys.registered_at'), true)->renderer(DateRenderer::class);
        //$this->addColumn('visitor.handle', trans('partymeister-competitions::backend/access_keys.ip_address'), true);

        $this->setDefaultSorting('id', 'ASC');
        $this->addEditAction(trans('motor-backend::backend/global.edit'), 'backend.access_keys.edit');
        $this->addDeleteAction(trans('motor-backend::backend/global.delete'), 'backend.access_keys.destroy');
    }
}
