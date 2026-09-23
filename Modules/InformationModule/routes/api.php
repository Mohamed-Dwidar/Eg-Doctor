<?php

use Illuminate\Support\Facades\Route;
use Modules\InformationModule\app\Http\Controllers\InformationModuleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('informationmodules', InformationModuleController::class)->names('informationmodule');
});
