<?php

namespace Modules\BlogModule\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\BlogModule\Http\Requests\BlogRequest;
use Modules\BlogModule\Services\BlogService;

class BlogAdminController extends Controller
{

    public $blogService;
    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService ;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $blogs = $this->blogService->paginate();

        return view('blogmodule::admin.index',[
            'blogs' => $blogs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blogmodule::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(BlogRequest $request)
    {
        $this->blogService->create($request);
        return redirect()->route('admin.blogs')->with('success', 'Created Successfully.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blogmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
       $blog = $this->blogService->findOne($id);
        return view('blogmodule::admin.edit',[
            'blog' => $blog ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(BlogRequest $request)
    {
        $this->blogService->update($request);
        return redirect()->route('admin.blogs')
            ->with('success', 'Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function delete($id)
    {
        $this->blogService->delete($id);
        return redirect()->route('admin.blogs')
            ->with('success', ' Deleted Successfully .');
    }
    public function addTopBlogs($id)
    {

        $Blog = $this->blogService->findWhere(['id'=>$id]);
        $this->blogService->bestBlogs($id);
        return true;
    }
    public function removeTopBlog($id)
    {

        $Blog = $this->blogService->findWhere(['id'=>$id]);
        $this->blogService->removeTopBlog($id);
        return true;
    }
}
