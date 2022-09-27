<?php

namespace Jozef\Teamgrid\Http\Webhooks;

use Jozef\Teamgrid\Http\Webhooks\ProjectHook;
use Jozef\Teamgrid\Http\Webhooks\TaskHook;
use Jozef\Teamgrid\Http\Webhooks\TimeEntryHook;

class AllHooks {

    // register all webHooks
    static function registerHooks() {
        ProjectHook::registerHooks();
        TaskHook::registerHooks();
        TimeEntryHook::registerHooks();
    }

}