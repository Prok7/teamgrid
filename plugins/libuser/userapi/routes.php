<?php
    use LibUser\Userapi\Http\Controllers\RegisterController;
    use LibUser\Userapi\Http\Controllers\JWTController;
    use LibUser\Userapi\Http\Controllers\ResetPassController;
    use LibUser\Userapi\Http\Controllers\UserController;

    Route::group(["prefix" => "api", "middleware" => "api"], function() {

        // routes that need authentication (email and password)
        Route::group([
            "prefix" => "auth"
        ], function() {
            Route::post("register", RegisterController::class);
            Route::post("resend/code", [RegisterController::class, "resendCode"]);
            Route::post("activate", [UserController::class, "activate"]);
            Route::post("login", [JWTController::class, "login"]);
            Route::post("reset/password", ResetPassController::class);
        });

        // get user info based on id
        Route::match(["post", "get"], "users/{id}", [UserController::class, "show"]);

        // routes that are just for logged users
        Route::group(["middleware" => "auth"], function() {
            Route::post("update/user", [UserController::class, "update"]);
            Route::delete("delete/user", [UserController::class, "delete"]);
            Route::get("jwt/refresh", [JWTController::class, "refreshJWT"]);
            Route::get("jwt/invalidate", [JWTController::class, "invalidateJWT"]);
        });

    });