<?php

use Illuminate\Support\Facades\Route;
use Modules\InformationModule\app\Http\Controllers\Admin\InformationAdminController;

Route::group(['prefix' => 'admin/informations', 'middleware' => ['auth:admin']], function () {
    Route::get('/', [InformationAdminController::class, 'index'])->name('admin.informations');
    Route::post('/apply-seo', [InformationAdminController::class, 'applySeoToAll'])->name('admin.informations.apply-seo');
    Route::get('/add', [InformationAdminController::class, 'create'])->name('admin.informations.add');
    Route::post('/store', [InformationAdminController::class, 'store'])->name('admin.informations.store');
    Route::get('/view/{id}', [InformationAdminController::class, 'show'])->name('admin.informations.view');
    Route::get('/edit/{id}', [InformationAdminController::class, 'edit'])->name('admin.informations.edit');
    Route::post('/update', [InformationAdminController::class, 'update'])->name('admin.informations.update');
    Route::post('/delete/{id}', [InformationAdminController::class, 'destroy'])->name('admin.informations.delete');
});
