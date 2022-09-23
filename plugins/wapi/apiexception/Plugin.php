<?php namespace WApi\ApiException;

use Backend;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;
use System\Classes\PluginBase;

/**
 * Api Plugin Information File
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
            'name'        => 'ApiException',
            'description' => 'No description provided yet...',
            'author'      => 'WApi',
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
        $this->app[\Illuminate\Contracts\Http\Kernel::class]->prependMiddlewareToGroup('api', ApiExceptionMiddleware::class);
    }

}
