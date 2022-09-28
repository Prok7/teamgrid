<?php namespace AppTeamgrid\Data\Classes\Extend;

    use AppTeamgrid\Data\Models\Task;
    use RainLab\User\Models\User;

    class UserExtend {

        // add tasks relationship to user
        static function addTasksRelation() {

            User::extend(function($model) {
                $model->hasMany = [
                    "tasks" => [Task::class, "key" => "user_id"]
                ];
            });
            
        }

    }