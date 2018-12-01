<?php

namespace Partymeister\Competitions\Services\Component;

use Partymeister\Competitions\Models\Component\ComponentVoting;
use Motor\CMS\Services\ComponentBaseService;

class ComponentVotingService extends ComponentBaseService
{

    protected $model = ComponentVoting::class;

    protected $name = 'voting';
}
