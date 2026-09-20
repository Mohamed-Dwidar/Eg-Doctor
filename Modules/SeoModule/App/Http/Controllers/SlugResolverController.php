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
     * the seos table. A manually-created entry (no seo_capable_type)
     * internally forwards to whatever route matches its target_path
     * (e.g. "terms" => "pages/2") and returns that route's response
     * as-is — the browser keeps showing the original slug URL, it's
     * not a redirect. Anything else hands off to whichever controller
     * renders that content type.
     */
    public function resolve(Request $request)
    {
        $slug = $request->decodedPath();

        $seo = Seo::where('slug', $slug)->first();

        if (!$seo) {
            abort(404);
        }

        // Shared so metas.blade.php can use the slug that was actually
        // typed, even after a manual entry's forwardTo() rebinds the
        // request to its target_path's own sub-request below.
        app()->instance('resolved_seo', $seo);

        if (!$seo->seo_capable_type) {
            if (!$seo->target_path) {
                abort(404);
            }

            return $this->forwardTo($request, $seo->target_path);
        }

        $type = class_basename($seo->seo_capable_type);
        $handler = self::TYPE_HANDLERS[$type] ?? null;

        if (!$handler) {
            abort(404);
        }

        [$controllerClass, $method] = $handler;

        return app($controllerClass)->{$method}($seo->seo_capable_id);
    }

    /**
     * Dispatches target_path's own route internally and returns its
     * response, without ever sending a redirect — so the browser's
     * address bar keeps showing the slug the visitor actually typed.
     */
    private function forwardTo(Request $originalRequest, string $targetPath)
    {
        $subRequest = Request::create(
            '/' . ltrim($targetPath, '/'),
            'GET',
            [],
            $originalRequest->cookies->all(),
            [],
            $originalRequest->server->all()
        );

        if ($originalRequest->hasSession()) {
            $subRequest->setLaravelSession($originalRequest->session());
        }

        app()->instance('request', $subRequest);

        return app('router')->dispatch($subRequest);
    }
}
