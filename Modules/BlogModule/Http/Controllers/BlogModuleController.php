<?php

namespace Modules\BlogModule\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BlogModule\Services\BlogService;
use Modules\BlogModule\Entities\Blog;
use Modules\BlogModule\Http\Requests\BlogRequest;

class BlogModuleController extends Controller
{
    public $blogService ;

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
        return view('blogmodule::guest.blogs', compact('blogs'));
    }
    public function singleBlog($id)
    {
        $blog = $this->blogService->findOne($id);
        $previous = Blog::where('id', '<', $blog->id)->first();
        $next = Blog::where('id', '>', $blog->id)->first();
        $relatedBlogs = Blog::where('id', '!=', $id)->latest()->take(4)->get();
        return view('blogmodule::guest.singleBlog', compact('blog', 'previous', 'next', 'relatedBlogs'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blogmodule::create');
    }

    /**
     * Display a listing of the resource via the API (no auth required).
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiIndex()
    {
        $blogs = $this->blogService->paginate();

        return response()->json([
            'data' => $blogs,
        ]);
    }

    /**
     * Store a newly created resource in storage via the API (no auth required).
     * @param BlogRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BlogRequest $request)
    {
        $blog = $this->blogService->create($request);

        return response()->json([
            'message' => 'Blog created successfully.',
            'data' => $blog,
        ], 201);
    }

    /**
     * Show the specified resource via the API (no auth required).
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $blog = $this->blogService->findOne($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found.',
            ], 404);
        }

        return response()->json([
            'data' => $blog,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('blogmodule::edit');
    }

    /**
     * Update the specified resource in storage via the API (no auth required).
     * @param BlogRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BlogRequest $request, $id)
    {
        try {
            $this->blogService->findOne($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found.',
            ], 404);
        }

        $request->merge(['id' => $id]);
        $blog = $this->blogService->update($request);

        return response()->json([
            'message' => 'Blog updated successfully.',
            'data' => $blog,
        ]);
    }

    /**
     * Remove the specified resource from storage via the API (no auth required).
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->blogService->delete($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Blog not found.',
            ], 404);
        }

        return response()->json([
            'message' => 'Blog deleted successfully.',
        ]);
    }
}
