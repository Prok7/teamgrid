<?php

namespace Jozef\Teamgrid\Http\Webhooks;

use Jozef\Teamgrid\Classes\Helpers\HttpHelper;
use Jozef\Teamgrid\Http\Resources\TaskResource;
use Jozef\Teamgrid\Models\Task;

    class TaskHook {
        
        static function registerHooks() {
            HttpHelper::makeWebhook(Task::class, TaskResource::class, "afterCreate");
            HttpHelper::makeWebhook(Task::class, TaskResource::class, "afterUpdate");
        }
    
    }