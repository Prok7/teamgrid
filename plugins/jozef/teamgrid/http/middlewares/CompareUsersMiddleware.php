<?php
namespace Jozef\Teamgrid\Http\Middlewares;

use Closure;
use Exception;
use Jozef\Teamgrid\Models\Task;
use Jozef\Teamgrid\Models\TimeEntry;

class CompareUsersMiddleware {

    private function compareUsers($task, $next, $request) {
        $logged_user = auth()->userOrFail();
        if (!$logged_user->is($task->user)) {
            throw new Exception("This task doesn't belong to logged user");
        }

        return $next($request);
    }

    function handle($request, Closure $next) {
        if ($request->task_id) {
            $task = Task::findOrFail($request->task_id);
        } else {
            $task = TimeEntry::findOrFail($request->entry_id)->task;
        }
        
        return $this->compareUsers($task, $next, $request);
    }

}