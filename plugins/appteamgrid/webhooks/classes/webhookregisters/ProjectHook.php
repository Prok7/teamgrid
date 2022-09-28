<?php

namespace AppTeamgrid\Webhooks\Classes\WebhookRegisters;

use AppTeamgrid\Webhooks\Classes\Helpers\HttpHelper;
use AppTeamgrid\Data\Http\Resources\ProjectResource;
use AppTeamgrid\Data\Models\Project;

class ProjectHook {

    static function registerHooks() {
        HttpHelper::makeWebhook(Project::class, ProjectResource::class, "afterCreate");
        HttpHelper::makeWebhook(Project::class, ProjectResource::class, "afterUpdate");
    }

}