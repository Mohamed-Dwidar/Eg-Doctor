<?php

use Illuminate\Support\Facades\Route;
use Modules\QuestionModule\app\Http\Controllers\Admin\QuestionAdminController;

Route::group(['prefix' => 'admin/questions', 'middleware' => ['auth:admin']], function () {
    Route::get('/', [QuestionAdminController::class, 'index'])->name('admin.questions');
    Route::post('/apply-seo', [QuestionAdminController::class, 'applySeoToAll'])->name('admin.questions.apply-seo');
    Route::get('/{id}/answers', [QuestionAdminController::class, 'answers'])->name('admin.questions.answers');
    Route::get('/add', [QuestionAdminController::class, 'create'])->name('admin.questions.add');
    Route::post('/store', [QuestionAdminController::class, 'store'])->name('admin.questions.store');
    Route::get('/view/{id}', [QuestionAdminController::class, 'show'])->name('admin.questions.view');
    Route::get('/edit/{id}', [QuestionAdminController::class, 'edit'])->name('admin.questions.edit');
    Route::post('/update', [QuestionAdminController::class, 'update'])->name('admin.questions.update');
    Route::post('/delete/{id}', [QuestionAdminController::class, 'destroy'])->name('admin.questions.delete');
});

Route::group(['prefix' => 'questions', 'middleware' => ['auth:web']], function () {
    Route::get('/', [QuestionAdminController::class, 'index'])->name('questions');
    Route::get('/add', [QuestionAdminController::class, 'create'])->name('questions.add');
    Route::post('/store', [QuestionAdminController::class, 'store'])->name('questions.store');
    Route::get('/view/{id}', [QuestionAdminController::class, 'show'])->name('questions.view');
});
