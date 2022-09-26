<?php
    namespace Jozef\Teamgrid\Http\Controllers;
    use Jozef\Teamgrid\Models\Task;
    use Jozef\Teamgrid\Http\Resources\TaskResource;
    use Jozef\Teamgrid\Http\Resources\TaskResourceWithoutTimes;
    use Jozef\Teamgrid\Models\Project;
    use RainLab\User\Models\User;
    use Exception;

    class TaskController {
        private function compareUsers($task) {
            $logged_user = auth()->userOrFail();

            if (!$logged_user->is($task->user)) {
                throw new Exception("This task doesn't belong to logged user");
            }
        }

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
            $this->compareUsers($task);
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