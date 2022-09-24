<?php
    namespace Jozef\Teamgrid\Http\Controllers;
    use Jozef\Teamgrid\Models\Task;
    use Jozef\Teamgrid\Http\Resources\TaskResource;
    use Jozef\Teamgrid\Models\Project;

    class TaskController {
        function create($project_id) {
            Project::findOrFail($project_id);
            
            $task = new Task;
            $task->project_id = $project_id;
            $task->fill(post());
            $task->save();

            return new TaskResource($task);
        }

        function edit($id) {
            $task = Task::findOrFail($id);
            $task->fill(post());
            $task->save();

            return new TaskResource($task);
        }

        function show($project_id) {
            $project = Project::findOrFail($project_id);
            $completed = get("completed");

            $tasks = $project->tasks()
                ->when($completed, function($query, $completed) {
                    $query->where("completed", $completed);
                }, function() {
                    $query;
                })
                ->get();
            
            return TaskResource::collection($tasks);
        }
    }