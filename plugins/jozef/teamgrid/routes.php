<?php
    use Jozef\Teamgrid\Http\Controllers\ProjectController;
    use Jozef\Teamgrid\Http\Controllers\TaskController;
    use Jozef\Teamgrid\Http\Controllers\TimeEntryController;

    Route::group([
        "prefix" => "api",
        "middleware" => ["api", "auth"]
    ], function() {

        Route::post("projects", [ProjectController::class, "create"]);
        Route::post("projects/{id}", [ProjectController::class, "edit"]);
        Route::get("projects", [ProjectController::class, "show"]);

        Route::post("projects/{project_id}/users/{user_id}/tasks", [TaskController::class, "create"]);
        Route::get("projects/{project_id}/tasks", [TaskController::class, "show"]);
        Route::get("tasks/{task_id}/timeentries", [TimeEntryController::class, "show"]);

        // routes in which logged user must be task owner
        Route::post("tasks/{id}", [TaskController::class, "edit"]);
        Route::get("tasks/{task_id}/start", [TimeEntryController::class, "startTracking"]);
        Route::get("tasks/{task_id}/stop", [TimeEntryController::class, "stopTracking"]);
        Route::post("tasks/{task_id}/timeentries", [TimeEntryController::class, "create"]);
        Route::post("timeentries/{id}", [TimeEntryController::class, "edit"]);

    });