<?php

namespace Modules\ArticleModule\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ArticleModule\app\Services\ArticleService;
use Modules\QuestionModule\app\Repositories\QuestionRepository;

class ArticleModuleController extends Controller
{
    protected $articleService;
    protected $questionRepository;

    public function __construct(ArticleService $articleService, QuestionRepository $questionRepository)
    {
        $this->articleService = $articleService;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = $this->articleService->getPublishedPaginated(10);
        $readAlso = $this->articleService->getRandomPublished(4);
        $latestQuestions = $this->questionRepository->latest(4);

        return view('articlemodule::guest.index', compact('articles', 'readAlso', 'latestQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articlemodule::create');
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
        $article = $this->articleService->findOneWithRelations($id);

        if (!$article) {
            abort(404);
        }

        // One random pool, split so "مقالات أخرى" and "اقرأ أيضا" never
        // show the same articles as each other or as the current one.
        $otherPool = $this->articleService->getRandomExcept($article->id, 7);
        $otherArticles = $otherPool->take(3);
        $readAlso = $otherPool->slice(3, 4)->values();

        $latestQuestions = $this->questionRepository->latest(4);

        return view('articlemodule::guest.show', compact('article', 'otherArticles', 'readAlso', 'latestQuestions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('articlemodule::edit');
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
