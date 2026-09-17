<?php

namespace Modules\PageModule\Http\Controllers;

use App\Helpers\ApiResponseHelper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\PageModule\app\Services\PageService;

class PageModuleController extends Controller
{
    use ApiResponseHelper;
    private $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function showPage($slug)
    {
        $page = $this->pageService->findBySlug($slug);
        if (!$page) {
            return $this->errorResponse(__('messages.page_not_found'), 404);
        }
        return view('pagemodule::front.show', compact('page'));
    }
}
