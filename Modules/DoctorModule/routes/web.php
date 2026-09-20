<?php

use Illuminate\Support\Facades\Route;
use Modules\DoctorModule\app\Http\Controllers\Admin\DoctorAdminController;

// Public: used by the front homepage's city -> zone cascading search field.
Route::get('/zones-by-city/{city}', [DoctorAdminController::class, 'zonesByCity'])->name('zones-by-city');

Route::group(['prefix' => 'admin/doctors', 'middleware' => ['auth:admin']], function () {
    Route::get('/', [DoctorAdminController::class, 'index'])->name('admin.doctors');
    Route::post('/apply-seo', [DoctorAdminController::class, 'applySeoToAll'])->name('admin.doctors.apply-seo');
    Route::get('/zones-by-city/{city}', [DoctorAdminController::class, 'zonesByCity'])->name('admin.doctors.zones-by-city');
    Route::get('/add', [DoctorAdminController::class, 'create'])->name('admin.doctors.add');
    Route::post('/store', [DoctorAdminController::class, 'store'])->name('admin.doctors.store');
    Route::get('/view/{id}', [DoctorAdminController::class, 'show'])->name('admin.doctors.view');
    Route::get('/edit/{id}', [DoctorAdminController::class, 'edit'])->name('admin.doctors.edit');
    Route::post('/update', [DoctorAdminController::class, 'update'])->name('admin.doctors.update');
    Route::post('/delete/{id}', [DoctorAdminController::class, 'destroy'])->name('admin.doctors.delete');
});
