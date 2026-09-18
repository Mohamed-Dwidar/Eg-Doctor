<?php

use Illuminate\Support\Facades\Route;
use Modules\SeoModule\App\Http\Controllers\SeoModuleController;
use Modules\SeoModule\App\Http\Controllers\SitemapController;
use Modules\SeoModule\App\Http\Controllers\SlugResolverController;

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

/*
 * Public SEO-friendly URLs: any request that doesn't match a real
 * route falls through here, where the path is looked up as a slug
 * in the seos table and handed off to the right content type's
 * controller. Registered as a fallback (not a normal route) so it
 * can never shadow routes registered by modules loaded after this
 * one, regardless of module boot order.
 */
Route::fallback([SlugResolverController::class, 'resolve']);
