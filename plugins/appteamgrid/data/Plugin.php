<?php namespace AppTeamgrid\Data;

use AppTeamgrid\Data\Classes\Extend\UserExtend;
use System\Classes\PluginBase;

/**
 * teamgrid Plugin Information File
 */
class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'data',
            'description' => 'No description provided yet...',
            'author'      => 'appteamgrid',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        UserExtend::addTasksRelation();
    }
}