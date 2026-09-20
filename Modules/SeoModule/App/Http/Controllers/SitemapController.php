<?php

namespace Modules\SeoModule\App\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SeoModule\App\Models\Seo;

class SitemapController extends Controller {

    public function index() {
        $seosByType = Seo::orderBy('seo_capable_type')->get()->groupBy('seo_capable_type');

        return response()
            ->view('seomodule::sitemap', compact('seosByType'))
            ->header('Content-Type', 'text/xml');
    }
}
