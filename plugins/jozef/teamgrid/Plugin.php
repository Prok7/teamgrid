<?php namespace Jozef\Teamgrid;

use Jozef\Teamgrid\Classes\Extend\TimeEntryExtend;
use Jozef\Teamgrid\Classes\Extend\UserExtend;
use System\Classes\PluginBase;

/**
 * teamgrid Plugin Information File
 */
class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'teamgrid',
            'description' => 'No description provided yet...',
            'author'      => 'jozef',
            'icon'        => 'icon-leaf'
        ];
    }

    public function boot()
    {
        UserExtend::addTasksRelation();
        TimeEntryExtend::hookOnBeforeSave();
    }
}