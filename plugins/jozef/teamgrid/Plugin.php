<?php namespace Jozef\Teamgrid;

use Backend;
use Jozef\Teamgrid\Models\Task;
use System\Classes\PluginBase;
use RainLab\User\Models\User;

/**
 * teamgrid Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'teamgrid',
            'description' => 'No description provided yet...',
            'author'      => 'jozef',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        User::extend(function($model) {
            $model->hasMany = [
                "tasks" => [Task::class, "key" => "user_id"]
            ];
        });
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'Jozef\Teamgrid\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'jozef.teamgrid.some_permission' => [
                'tab' => 'teamgrid',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate
        
        return [
            'teamgrid' => [
                'label'       => 'Teamgrid',
                'url'         => Backend::url('jozef/teamgrid/projects'),
                'icon'        => 'icon-leaf',
                'permissions' => ['jozef.teamgrid.*'],
                'order'       => 500,
            ],
        ];
    }
}
