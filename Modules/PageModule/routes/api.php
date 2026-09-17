<?php

use Illuminate\Support\Facades\Route;
use Modules\PageModule\Http\Controllers\PageModuleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('pagemodules', PageModuleController::class)->names('pagemodule');
});
