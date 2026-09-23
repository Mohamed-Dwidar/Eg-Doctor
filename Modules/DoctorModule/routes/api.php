<?php

use Illuminate\Support\Facades\Route;
use Modules\DoctorModule\app\Http\Controllers\DoctorModuleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('doctormodules', DoctorModuleController::class)->names('doctormodule');
});
