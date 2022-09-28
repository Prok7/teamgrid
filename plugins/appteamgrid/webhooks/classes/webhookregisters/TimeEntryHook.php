<?php

namespace AppTeamgrid\Webhooks\Classes\WebhookRegisters;

use AppTeamgrid\Webhooks\Classes\Helpers\HttpHelper;
use AppTeamgrid\Data\Http\Resources\TimeEntryResource;
use AppTeamgrid\Data\Models\TimeEntry;

class TimeEntryHook {

    static function registerHooks() {
        HttpHelper::makeWebhook(TimeEntry::class, TimeEntryResource::class, "startedTracking");
        HttpHelper::makeWebhook(TimeEntry::class, TimeEntryResource::class, "stoppedTracking");
        HttpHelper::makeWebhook(TimeEntry::class, TimeEntryResource::class, "afterCreate");
        HttpHelper::makeWebhook(TimeEntry::class, TimeEntryResource::class, "afterUpdate");
    }

}