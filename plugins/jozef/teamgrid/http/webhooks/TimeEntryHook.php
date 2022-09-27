<?php

namespace Jozef\Teamgrid\Http\Webhooks;

use Jozef\Teamgrid\Classes\Helpers\HttpHelper;
use Jozef\Teamgrid\Http\Resources\TimeEntryResource;
use Jozef\Teamgrid\Models\TimeEntry;

class TimeEntryHook {

    static function registerHooks() {
        HttpHelper::makeWebhook(TimeEntry::class, TimeEntryResource::class, "startedTracking");
        HttpHelper::makeWebhook(TimeEntry::class, TimeEntryResource::class, "stoppedTracking");
        HttpHelper::makeWebhook(TimeEntry::class, TimeEntryResource::class, "afterCreate");
        HttpHelper::makeWebhook(TimeEntry::class, TimeEntryResource::class, "afterUpdate");
    }

}