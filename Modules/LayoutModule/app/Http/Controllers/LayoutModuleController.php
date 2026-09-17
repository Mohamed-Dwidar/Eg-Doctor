<?php

namespace Modules\LayoutModule\app\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\PageModule\app\Services\PageService;

class LayoutModuleController extends Controller
{
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function home_page()
    {
        $pages = $this->pageService->findAll();
        return view('layoutmodule::front.home', compact('pages'));
    }

    public function welcome()
    {
        return view('layoutmodule::front.welcome');
    }

    public function admin_dashboard()
    {
        if (Auth::guard('admin')->check()) {
            // dd(Auth::guard('admin')->user()->email);
            return view('layoutmodule::admin.dashboard');
        } else {
            return redirect()->route('admin.login');
        }
    }
}
