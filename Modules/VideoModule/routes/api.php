<?php

use Illuminate\Support\Facades\Route;
use Modules\VideoModule\app\Http\Controllers\VideoModuleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('videomodules', VideoModuleController::class)->names('videomodule');
});
