<?php

use Illuminate\Support\Facades\Route;
use Modules\ArticleModule\app\Http\Controllers\Admin\ArticleAdminController;
use Modules\ArticleModule\app\Http\Controllers\ArticleModuleController;

Route::get('/articles', [ArticleModuleController::class, 'index'])->name('articles');

Route::group(['prefix' => 'admin/articles', 'middleware' => ['auth:admin']], function () {
    Route::get('/', [ArticleAdminController::class, 'index'])->name('admin.articles');
    Route::post('/apply-seo', [ArticleAdminController::class, 'applySeoToAll'])->name('admin.articles.apply-seo');
    Route::get('/add', [ArticleAdminController::class, 'create'])->name('admin.articles.add');
    Route::post('/store', [ArticleAdminController::class, 'store'])->name('admin.articles.store');
    Route::get('/view/{id}', [ArticleAdminController::class, 'show'])->name('admin.articles.view');
    Route::get('/edit/{id}', [ArticleAdminController::class, 'edit'])->name('admin.articles.edit');
    Route::post('/update', [ArticleAdminController::class, 'update'])->name('admin.articles.update');
    Route::post('/delete/{id}', [ArticleAdminController::class, 'destroy'])->name('admin.articles.delete');
});
