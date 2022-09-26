<?php
    namespace Jozef\Teamgrid\Classes\Extend;
    use Jozef\Teamgrid\Models\TimeEntry;

    class TimeEntryExtend {

        static function hookOnBeforeSave() {
            TimeEntry::extend(function($model) {
                $model->bindEvent("model.beforeSave", function() use ($model) {
                    $model->tracked_seconds = $model->start_time->diffInSeconds($model->end_time);
                });
            });
        }

    }