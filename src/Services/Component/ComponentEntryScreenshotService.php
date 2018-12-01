<?php

namespace Partymeister\Competitions\Services\Component;

use Partymeister\Competitions\Models\Component\ComponentEntryScreenshot;
use Motor\CMS\Services\ComponentBaseService;

class ComponentEntryScreenshotService extends ComponentBaseService
{

    protected $model = ComponentEntryScreenshot::class;

    protected $name = 'entry-screenshots';
}
