<?php
    namespace Jozef\Teamgrid\Http\Controllers;

    use Exception;
    use Jozef\Teamgrid\Http\Resources\TimeEntryResource;
    use Jozef\Teamgrid\Models\TimeEntry;
    use Jozef\Teamgrid\Models\Task;

    class TimeEntryController {

        // start time tracking on task
        function startTracking($task_id) {
            $task = Task::findOrFail($task_id);

            if ($task->tracking == false) {
                $task->tracking = true;
                $task->save();
    
                $timeEntry = new TimeEntry;
                $timeEntry->start_time = now();
                $timeEntry->task_id = $task_id;
                $timeEntry->save();

                return new TimeEntryResource($timeEntry);
            } else {
                throw new Exception("Task is already being tracked");
            }
        }

        // stop time tracking on task
        function stopTracking($task_id) {
            $task = Task::findOrFail($task_id);

            if ($task->tracking) {
                $task->tracking = false;
                $task->save();
    
                $timeEntry = $task->time_entries->last();
                $timeEntry->end_time = now();
                $timeEntry->tracked_seconds = $timeEntry->start_time->diffInSeconds($timeEntry->end_time);
                $timeEntry->save();

                return new TimeEntryResource($timeEntry);
            } else {
                throw new Exception("Task hasn't started tracking yet");
            }
        }

        // manual-create time entry
        function create($task_id) {
            if (post("end_time")) {
                Task::findOrFail($task_id);

                $timeEntry = new TimeEntry;
                $timeEntry->task_id = $task_id;
                $timeEntry->fill(post());
                $timeEntry->tracked_seconds = $timeEntry->start_time->diffInSeconds($timeEntry->end_time);
                $timeEntry->save();
    
                return new TimeEntryResource($timeEntry);
            } else {
                throw new Exception("You need to define start_time and end_time");
            }
        }

        function edit($id) {
            $timeEntry = TimeEntry::findOrFail($id);
            $timeEntry->fill(post());
            $timeEntry->tracked_seconds = $timeEntry->start_time->diffInSeconds($timeEntry->end_time);
            $timeEntry->save();

            return new TimeEntryResource($timeEntry);
        }

        function show($task_id) {
            $task = Task::findOrFail($task_id);
            $timeEntries = $task->time_entries;
            return TimeEntryResource::collection($timeEntries);
        }

    }