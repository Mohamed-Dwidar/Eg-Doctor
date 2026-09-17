<?php

use Illuminate\Support\Facades\Route;
use Modules\SeoModule\App\Http\Controllers\SeoModuleController;
use Modules\SeoModule\App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('seomodule', SeoModuleController::class)->names('seomodule');
});

Route::get('/sitemap.xml', [SitemapController::class, 'index']);
