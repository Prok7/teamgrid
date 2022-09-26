<?php
    namespace Jozef\Teamgrid\Http\Controllers;

    use Exception;
    use Jozef\Teamgrid\Http\Resources\TimeEntryResource;
    use Jozef\Teamgrid\Models\TimeEntry;
    use Jozef\Teamgrid\Models\Task;

    class TimeEntryController {

        // compare logged user with task user
        private function compareUsers($task) {
            $logged_user = auth()->userOrFail();

            if (!$logged_user->is($task->user)) {
                throw new Exception("This task doesn't belong to logged user");
            }
        }

        // start time tracking on task
        function startTracking($task_id) {
            $task = Task::findOrFail($task_id);
            $this->compareUsers($task);

            if ($task->tracking) {
                throw new Exception("Task is already being tracked");
            }

            $task->tracking = true;
            $task->save();

            $timeEntry = new TimeEntry;
            $timeEntry->start_time = now();
            $timeEntry->task_id = $task_id;
            $timeEntry->save();

            return new TimeEntryResource($timeEntry);
        }

        // stop time tracking on task
        function stopTracking($task_id) {
            $task = Task::findOrFail($task_id);
            $this->compareUsers($task);

            if (!$task->tracking) {
                throw new Exception("Task hasn't started tracking yet");
            }

            $task->tracking = false;
            $task->save();

            $timeEntry = $task->time_entries->last();
            $timeEntry->end_time = now();
            $timeEntry->save();

            return new TimeEntryResource($timeEntry);
        }

        // manual-create time entry
        function create($task_id) {
            if (!post("end_time")) {
                throw new Exception("You need to define start_time and end_time");
            }
            
            $task = Task::findOrFail($task_id);
            $this->compareUsers($task);

            $timeEntry = new TimeEntry;
            $timeEntry->task_id = $task_id;
            $timeEntry->fill(post());
            $timeEntry->save();

            return new TimeEntryResource($timeEntry);
        }

        function edit($id) {
            $timeEntry = TimeEntry::findOrFail($id);
            $this->compareUsers($timeEntry->task);

            $timeEntry->fill(post());
            $timeEntry->save();

            return new TimeEntryResource($timeEntry);
        }

        function index($task_id) {
            $task = Task::findOrFail($task_id);
            $timeEntries = $task->time_entries;
            return TimeEntryResource::collection($timeEntries);
        }

    }