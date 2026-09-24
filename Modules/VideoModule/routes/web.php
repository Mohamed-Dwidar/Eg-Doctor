<?php

use Illuminate\Support\Facades\Route;
use Modules\VideoModule\app\Http\Controllers\Admin\VideoAdminController;
use Modules\VideoModule\app\Http\Controllers\VideoModuleController;

Route::get('/videos', [VideoModuleController::class, 'index'])->name('videos');

Route::group(['prefix' => 'admin/videos', 'middleware' => ['auth:admin']], function () {
    Route::get('/', [VideoAdminController::class, 'index'])->name('admin.videos');
    Route::post('/apply-seo', [VideoAdminController::class, 'applySeoToAll'])->name('admin.videos.apply-seo');
    Route::get('/add', [VideoAdminController::class, 'create'])->name('admin.videos.add');
    Route::post('/store', [VideoAdminController::class, 'store'])->name('admin.videos.store');
    Route::get('/view/{id}', [VideoAdminController::class, 'show'])->name('admin.videos.view');
    Route::get('/edit/{id}', [VideoAdminController::class, 'edit'])->name('admin.videos.edit');
    Route::post('/update', [VideoAdminController::class, 'update'])->name('admin.videos.update');
    Route::post('/delete/{id}', [VideoAdminController::class, 'destroy'])->name('admin.videos.delete');
});
