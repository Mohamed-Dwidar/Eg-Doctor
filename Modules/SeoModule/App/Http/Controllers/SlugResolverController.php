<?php

namespace Modules\SeoModule\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ArticleModule\app\Http\Controllers\ArticleModuleController;
use Modules\BlogModule\Http\Controllers\BlogModuleController;
use Modules\DepartmentModule\app\Http\Controllers\DepartmentModuleController;
use Modules\DoctorModule\app\Http\Controllers\DoctorModuleController;
use Modules\InformationModule\app\Http\Controllers\InformationModuleController;
use Modules\QuestionModule\app\Http\Controllers\QuestionModuleController;
use Modules\SeoModule\App\Models\Seo;

class SlugResolverController extends Controller
{
    /**
     * Maps a seo_capable_type's short class name to the front
     * controller + action that renders that content type's public
     * page. Add an entry here whenever a new module's records should
     * be reachable by their SEO slug.
     */
    private const TYPE_HANDLERS = [
        'Department' => [DepartmentModuleController::class, 'show'],
        'Doctor' => [DoctorModuleController::class, 'show'],
        'Question' => [QuestionModuleController::class, 'show'],
        'Article' => [ArticleModuleController::class, 'show'],
        'Information' => [InformationModuleController::class, 'show'],
        'Blog' => [BlogModuleController::class, 'singleBlog'],
    ];

    /**
     * Laravel's fallback route: called only when no other route in
     * the app matched the request. Looks the path up as a slug in
     * the seos table and, if found, hands off to whichever
     * controller renders that content type.
     */
    public function resolve(Request $request)
    {
        $slug = $request->decodedPath();

        $seo = Seo::where('slug', $slug)->first();

        if (!$seo) {
            abort(404);
        }

        $type = class_basename($seo->seo_capable_type);
        $handler = self::TYPE_HANDLERS[$type] ?? null;

        if (!$handler) {
            abort(404);
        }

        [$controllerClass, $method] = $handler;

        return app($controllerClass)->{$method}($seo->seo_capable_id);
    }
}
