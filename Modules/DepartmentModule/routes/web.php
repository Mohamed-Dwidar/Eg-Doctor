<?php

use Illuminate\Support\Facades\Route;
use Modules\DepartmentModule\app\Http\Controllers\Admin\DepartmentAdminController;
use Modules\DepartmentModule\app\Http\Controllers\DepartmentModuleController;

Route::group(['prefix' => 'admin/departments', 'middleware' => ['auth:admin']], function () {
    Route::get('/', [DepartmentAdminController::class, 'index'])->name('admin.departments');
    Route::post('/apply-seo', [DepartmentAdminController::class, 'applySeoToAll'])->name('admin.departments.apply-seo');
    Route::get('/add', [DepartmentAdminController::class, 'create'])->name('admin.departments.add');
    Route::post('/store', [DepartmentAdminController::class, 'store'])->name('admin.departments.store');
    Route::get('/view/{id}', [DepartmentAdminController::class, 'show'])->name('admin.departments.view');
    Route::get('/edit/{id}', [DepartmentAdminController::class, 'edit'])->name('admin.departments.edit');
    Route::post('/update', [DepartmentAdminController::class, 'update'])->name('admin.departments.update');
    Route::post('/delete/{id}', [DepartmentAdminController::class, 'destroy'])->name('admin.departments.delete');
});


Route::group(['prefix' => 'departments', 'middleware' => ['auth:admin']], function () {
   // Route::get('/view/{id}', [DepartmentModuleController::class, 'show'])->name('admin.departments.view');
});
