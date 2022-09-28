<?php

namespace AppTeamgrid\Webhooks\Classes\WebhookRegisters;

use AppTeamgrid\Webhooks\Classes\Helpers\HttpHelper;
use AppTeamgrid\Data\Http\Resources\TaskResource;
use AppTeamgrid\Data\Models\Task;

    class TaskHook {
        
        static function registerHooks() {
            HttpHelper::makeWebhook(Task::class, TaskResource::class, "afterCreate");
            HttpHelper::makeWebhook(Task::class, TaskResource::class, "afterUpdate");
        }
    
    }