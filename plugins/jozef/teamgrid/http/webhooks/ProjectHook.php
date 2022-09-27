<?php

namespace Jozef\Teamgrid\Http\Webhooks;

use Jozef\Teamgrid\Classes\Helpers\HttpHelper;
use Jozef\Teamgrid\Http\Resources\ProjectResource;
use Jozef\Teamgrid\Models\Project;

class ProjectHook {

    static function registerHooks() {
        HttpHelper::makeWebhook(Project::class, ProjectResource::class, "afterCreate");
        HttpHelper::makeWebhook(Project::class, ProjectResource::class, "afterUpdate");
    }

}