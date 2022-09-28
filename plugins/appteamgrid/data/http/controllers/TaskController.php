<?php namespace AppTeamgrid\Data\Http\Controllers;

    use AppTeamgrid\Data\Http\Resources\TaskResource;
    use AppTeamgrid\Data\Http\Resources\TaskResourceWithoutTimes;
    use AppTeamgrid\Data\Models\Project;
    use AppTeamgrid\Data\Models\Task;
    use RainLab\User\Models\User;

    class TaskController {

        function create($project_id, $user_id) {
            Project::findOrFail($project_id);
            User::findOrFail($user_id);
            
            $task = new Task;
            $task->project_id = $project_id;
            $task->user_id = $user_id;
            $task->fill(post());
            $task->save();

            return new TaskResourceWithoutTimes($task);
        }

        function edit($id) {
            $task = Task::findOrFail($id);
            $task->fill(post());
            $task->save();

            return new TaskResource($task);
        }

        function index($project_id) {
            $project = Project::findOrFail($project_id);
            $completed = get("completed");

            $tasks = $project->tasks()
                ->when($completed, function($query, $completed) {
                    $query->where("completed", $completed);
                }, function($query) {
                    $query;
                })
                ->get();
            
            return TaskResourceWithoutTimes::collection($tasks);
        }
    }