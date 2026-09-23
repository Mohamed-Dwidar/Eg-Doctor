<?php

namespace Modules\DepartmentModule\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ArticleModule\app\Repositories\ArticleRepository;
use Modules\DepartmentModule\app\Services\DepartmentService;
use Modules\QuestionModule\app\Repositories\QuestionRepository;

class DepartmentModuleController extends Controller
{
    protected $departmentService;
    protected $articleRepository;
    protected $questionRepository;

    public function __construct(
        DepartmentService $departmentService,
        ArticleRepository $articleRepository,
        QuestionRepository $questionRepository
    ) {
        $this->departmentService = $departmentService;
        $this->articleRepository = $articleRepository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = $this->departmentService->getAllDepartmentsSorted();

        return view('departmentmodule::guest.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departmentmodule::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $department = $this->departmentService->findOneWithSeo($id);

        if (!$department) {
            abort(404);
        }

        $doctors = $department->doctors()
            ->with(['degree', 'city', 'zone', 'departments', 'seo'])
            ->orderByDesc('doctors.id')
            ->paginate(10);

        $relatedArticles = $this->articleRepository->random(4);
        $latestQuestions = $this->questionRepository->latest(4);

        return view('departmentmodule::guest.show', compact('department', 'doctors', 'relatedArticles', 'latestQuestions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('departmentmodule::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
