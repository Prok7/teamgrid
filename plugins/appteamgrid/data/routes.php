<?php
    use AppTeamgrid\Data\Http\Controllers\ProjectController;
    use AppTeamgrid\Data\Http\Controllers\TaskController;
    use AppTeamgrid\Data\Http\Controllers\TimeEntryController;
    use AppTeamgrid\Data\Http\Middlewares\CompareUsersMiddleware;

    Route::group([
        "prefix" => "api",
        "middleware" => ["api", "auth"]
    ], function() {

        Route::post("projects", [ProjectController::class, "create"]);
        Route::post("projects/{id}", [ProjectController::class, "edit"]);
        Route::get("projects", [ProjectController::class, "index"]);

        Route::post("projects/{project_id}/users/{user_id}/tasks", [TaskController::class, "create"]);
        Route::get("projects/{project_id}/tasks", [TaskController::class, "index"]);
        Route::get("tasks/{task_id}/timeentries", [TimeEntryController::class, "index"]);

        // routes in which logged user must be task owner
        Route::group(["middleware" => CompareUsersMiddleware::class], function() {
            Route::post("tasks/{task_id}", [TaskController::class, "edit"]);
            Route::get("tasks/{task_id}/start", [TimeEntryController::class, "startTracking"]);
            Route::get("tasks/{task_id}/stop", [TimeEntryController::class, "stopTracking"]);
            Route::post("tasks/{task_id}/timeentries", [TimeEntryController::class, "create"]);
            Route::post("timeentries/{entry_id}", [TimeEntryController::class, "edit"]);
        });

    });