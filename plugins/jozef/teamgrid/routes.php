<?php
    use Jozef\Teamgrid\Http\Controllers\ProjectController;
    use Jozef\Teamgrid\Http\Controllers\TaskController;

    Route::group([
        "prefix" => "api",
        "middleware" => "apiException"
    ], function() {
        Route::post("projects", [ProjectController::class, "create"]);
        Route::post("projects/{id}", [ProjectController::class, "edit"]);
        
        Route::post("tasks", [TaskController::class, "create"]);
        Route::post("tasks/{id}", [TaskController::class, "edit"]);
    });