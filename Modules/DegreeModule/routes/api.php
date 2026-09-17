<?php

use Illuminate\Support\Facades\Route;
use Modules\DegreeModule\Http\Controllers\DegreeModuleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('degreemodules', DegreeModuleController::class)->names('degreemodule');
});
