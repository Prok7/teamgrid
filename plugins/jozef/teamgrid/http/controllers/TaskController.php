<?php
    namespace Jozef\Teamgrid\Http\Controllers;
    use Jozef\Teamgrid\Models\Task;
    use Jozef\Teamgrid\Http\Resources\TaskResource;

    // todo: create resource, add fillable, create endopints
    class TaskController {
        function create() {
            $task = new Task;
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
    }