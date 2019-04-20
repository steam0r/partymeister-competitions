<?php

namespace Partymeister\Competitions\Services\Component;

use Partymeister\Competitions\Models\Component\ComponentEntry;
use Motor\CMS\Services\ComponentBaseService;
use Partymeister\Core\Services\StuhlService;

class ComponentEntryService extends ComponentBaseService
{

    protected $model = ComponentEntry::class;

    protected $name = 'entries';
}
