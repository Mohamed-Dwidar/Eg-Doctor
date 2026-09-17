<?php

use Illuminate\Support\Facades\Route;
use Modules\DegreeModule\app\Http\Controllers\Admin\DegreeAdminController;

Route::group(['prefix' => 'admin/degrees', 'middleware' => ['auth:admin']], function () {
    Route::get('/', [DegreeAdminController::class, 'index'])->name('admin.degrees');
    Route::get('/add', [DegreeAdminController::class, 'create'])->name('admin.degrees.add');
    Route::post('/store', [DegreeAdminController::class, 'store'])->name('admin.degrees.store');
    Route::get('/view/{id}', [DegreeAdminController::class, 'show'])->name('admin.degrees.view');
    Route::get('/edit/{id}', [DegreeAdminController::class, 'edit'])->name('admin.degrees.edit');
    Route::post('/update', [DegreeAdminController::class, 'update'])->name('admin.degrees.update');
    Route::post('/delete/{id}', [DegreeAdminController::class, 'destroy'])->name('admin.degrees.delete');
});
