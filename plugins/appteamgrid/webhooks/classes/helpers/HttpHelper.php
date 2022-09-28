<?php

namespace AppTeamgrid\Webhooks\Classes\Helpers;
use October\Rain\Support\Facades\Http;

class HttpHelper {

    // send model data to url when event is fired
    static function makeWebhook($modelClass, $modelResource, $eventType) {

        $modelClass::extend(function($model) use ($modelResource, $eventType) {
            $model->bindEvent("model.$eventType", function() use ($model, $modelResource) {
                $url = config("jozef.teamgrid::config.webhook_url");
                Http::post($url, new $modelResource($model));
            });
        });
        
    }

}