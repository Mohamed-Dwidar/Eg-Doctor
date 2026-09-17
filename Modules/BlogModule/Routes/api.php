<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/blogmodule', function (Request $request) {
    return $request->user();
});

Route::get('/blogmodule/blogs', [\Modules\BlogModule\Http\Controllers\BlogModuleController::class, 'apiIndex']);
Route::get('/blogmodule/blogs/{id}', [\Modules\BlogModule\Http\Controllers\BlogModuleController::class, 'show']);
Route::post('/blogmodule/blogs', [\Modules\BlogModule\Http\Controllers\BlogModuleController::class, 'store']);
Route::put('/blogmodule/blogs/{id}', [\Modules\BlogModule\Http\Controllers\BlogModuleController::class, 'update']);
Route::delete('/blogmodule/blogs/{id}', [\Modules\BlogModule\Http\Controllers\BlogModuleController::class, 'destroy']);