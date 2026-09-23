<?php

use Illuminate\Support\Facades\Route;
use Modules\ArticleModule\app\Http\Controllers\ArticleModuleController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('articlemodules', ArticleModuleController::class)->names('articlemodule');
});
