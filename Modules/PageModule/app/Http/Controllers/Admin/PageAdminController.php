<?php

namespace Modules\PageModule\app\Http\Controllers\Admin;

use App\Helpers\ApiResponseHelper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\PageModule\app\Services\PageService;
use Illuminate\Support\Facades\Session;

class PageAdminController extends Controller
{
    use ApiResponseHelper;
    private $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $pages = $this->pageService->filter($request->all())->paginate(15);
        return view('pagemodule::admin.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $top_pages = $this->pageService->findTopParents();
        return view('pagemodule::admin.create', compact('top_pages'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'parent_id' => 'nullable|exists:pages,id',
                // 'slug' => 'required|unique:pages,slug',
                'content' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->pageService->create($request);

        return redirect()->route('admin.pages')
            ->with('success', __('messages.successfully_saved'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $page = $this->pageService->findOne($id);
        return view('pagemodule::admin.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $page = $this->pageService->findOne($id);
        if (!$page) {
            return redirect()->route('admin.pages')
                ->with('error', __('messages.page_not_found'));
        }
        $top_pages = $this->pageService->findTopParents();
        return view('pagemodule::admin.edit', compact('page', 'top_pages'));
    }

    public function edit_full($id)
    {
        $page = $this->pageService->findOne($id);
        if (!$page) {
            return redirect()->route('admin.pages')
                ->with('error', __('messages.page_not_found'));
        }
        $top_pages = $this->pageService->findTopParents();
        return view('pagemodule::admin.edit_full', compact('page', 'top_pages'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'parent_id' => 'nullable|exists:pages,id',
                // 'slug' => 'required|unique:pages,slug,' . $request->id,
                'content' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->pageService->update($request);

        return back()->with('success', __('messages.successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->pageService->deleteOne($id);
        return redirect()->route('admin.pages')
            ->with('success', __('messages.successfully_deleted'));
    }
}
