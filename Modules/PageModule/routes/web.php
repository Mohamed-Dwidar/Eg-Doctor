<?php

use Illuminate\Support\Facades\Route;
use Modules\PageModule\app\Http\Controllers\Admin\PageAdminController;
use Modules\PageModule\Http\Controllers\PageModuleController;

Route::group(['prefix' => 'admin/pages', 'middleware' => ['auth:admin']], function () {


    Route::get('/', [PageAdminController::class, 'index'])->name('admin.pages');
    Route::get('/add', [PageAdminController::class, 'create'])->name('admin.pages.add');
    Route::post('/store', [PageAdminController::class, 'store'])->name('admin.pages.store');
    Route::get('/view/{id}', [PageAdminController::class, 'show'])->name('admin.pages.view');
    Route::get('/edit/{id}', [PageAdminController::class, 'edit'])->name('admin.pages.edit');
    Route::get('/edit_full/{id}', [PageAdminController::class, 'edit_full'])->name('admin.pages.edit_full');
    Route::post('/update', [PageAdminController::class, 'update'])->name('admin.pages.update');
    Route::post('/delete/{id}', [PageAdminController::class, 'destroy'])->name('admin.pages.delete');
    Route::get('{parent_id}', [PageAdminController::class, 'index'])->name('admin.pages.index_subs');
    Route::get('/sub_pages/{id}', [PageAdminController::class, 'getSubPages'])->name('admin.getSubPages');
    Route::get('changePageActivity/{id}', [PageAdminController::class, 'changePageActivity'])->name('admin.pages.change_activity');
});

Route::group(['prefix' => 'pages'], function () {
    Route::get('/{slug}', [PageModuleController::class, 'showPage'])->name('pages.show');
    Route::get('/{slug}/edit', [PageModuleController::class, 'editPage'])->name('pages.edit');
});
