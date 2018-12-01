<?php

namespace Partymeister\Competitions\Services\Component;

use Partymeister\Competitions\Models\Component\ComponentEntryUpload;
use Motor\CMS\Services\ComponentBaseService;

class ComponentEntryUploadService extends ComponentBaseService
{

    protected $model = ComponentEntryUpload::class;

    protected $name = 'entry-uploads';
}
