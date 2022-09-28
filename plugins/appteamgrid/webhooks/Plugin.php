<?php namespace AppTeamgrid\Webhooks;

use System\Classes\PluginBase;
use AppTeamgrid\Webhooks\Classes\WebhookRegisters\TaskHook;
use AppTeamgrid\Webhooks\Classes\WebhookRegisters\ProjectHook;
use AppTeamgrid\Webhooks\Classes\WebhookRegisters\TimeEntryHook;


/**
 * teamgrid Plugin Information File
 */
class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'webhooks',
            'description' => 'No description provided yet...',
            'author'      => 'appteamgrid',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        ProjectHook::registerHooks();
        TaskHook::registerHooks();
        TimeEntryHook::registerHooks();
    }
}