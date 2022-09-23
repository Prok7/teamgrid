<?php namespace Jozef\Teamgrid;

use Backend;
use System\Classes\PluginBase;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;

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
        $this->app["router"]->aliasMiddleware("apiException", ApiExceptionMiddleware::class);
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

        return [
            'teamgrid' => [
                'label'       => 'Teamgrid',
                'url'         => Backend::url('jozef/teamgrid/projects'),
                'icon'        => 'icon-leaf',
                'permissions' => ['jozef.teamgrid.*'],
                'order'       => 500,
                'sideMenu'    => [
                    "projects" => [
                        'label'       => 'Projects',
                        'url'         => Backend::url('jozef/teamgrid/projects'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['jozef.teamgrid.*'],
                    ],
                    "tasks" => [
                        'label'       => 'Tasks',
                        'url'         => Backend::url('jozef/teamgrid/tasks'),
                        'icon'        => 'icon-leaf',
                        'permissions' => ['jozef.teamgrid.*'],
                    ]
                ]
            ],
        ];
    }
}
