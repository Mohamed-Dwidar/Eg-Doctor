<?php

namespace Modules\SeoModule\App\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\BlogModule\Services\BlogService;

class SitemapController extends Controller {

    public $blogService;
    public function __construct(BlogService $blogService) {
        $this->blogService = $blogService;
    }

    public function index() {
        $blogs = $this->blogService->findAll();

        return response()->view('seomodule::sitemap', compact('blogs'))->header('Content-Type', 'text/xml');
    }
}
