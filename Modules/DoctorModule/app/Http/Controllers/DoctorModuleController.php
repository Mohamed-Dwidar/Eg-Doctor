<?php

namespace Modules\DoctorModule\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ArticleModule\app\Repositories\ArticleRepository;
use Modules\DoctorModule\app\Services\DoctorService;
use Modules\QuestionModule\app\Repositories\QuestionRepository;

class DoctorModuleController extends Controller
{
    protected $doctorService;
    protected $articleRepository;
    protected $questionRepository;

    public function __construct(
        DoctorService $doctorService,
        ArticleRepository $articleRepository,
        QuestionRepository $questionRepository
    ) {
        $this->doctorService = $doctorService;
        $this->articleRepository = $articleRepository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('doctormodule::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctormodule::create');
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
        $doctor = $this->doctorService->findOneWithRelations($id);

        if (!$doctor) {
            abort(404);
        }

        $relatedArticles = $this->articleRepository->forDoctor($doctor->id, 4);
        if ($relatedArticles->isEmpty()) {
            $relatedArticles = $this->articleRepository->random(4);
        }

        $latestQuestions = $this->questionRepository->latest(4);

        return view('doctormodule::show', compact('doctor', 'relatedArticles', 'latestQuestions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('doctormodule::edit');
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
