<?php

namespace Modules\QuestionModule\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Rules\SafeText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\ArticleModule\app\Repositories\ArticleRepository;
use Modules\QuestionModule\app\Repositories\QuestionAnswerRepository;
use Modules\QuestionModule\app\Services\QuestionService;

class QuestionModuleController extends Controller
{
    protected $questionService;
    protected $articleRepository;
    protected $questionAnswerRepository;

    public function __construct(
        QuestionService $questionService,
        ArticleRepository $articleRepository,
        QuestionAnswerRepository $questionAnswerRepository
    ) {
        $this->questionService = $questionService;
        $this->articleRepository = $articleRepository;
        $this->questionAnswerRepository = $questionAnswerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = $this->questionService->getPaginatedLatest(10);
        $relatedArticles = $this->articleRepository->random(4);
        $latestQuestions = $this->questionService->getLatest(4);

        return view('questionmodule::guest.index', compact('questions', 'relatedArticles', 'latestQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('questionmodule::create');
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
        $question = $this->questionService->findOneWithSeo($id);

        if (!$question) {
            abort(404);
        }

        $answers = $this->questionAnswerRepository->paginatedForQuestion($id, 15);

        $relatedArticles = $this->articleRepository->random(4);
        $latestQuestions = $this->questionService->getLatest(4);

        $excludeIds = $latestQuestions->pluck('id')->push($question->id)->all();
        $otherQuestions = $this->questionService->getRandomExcept($excludeIds, 3);

        return view('questionmodule::guest.show', compact(
            'question', 'answers', 'relatedArticles', 'latestQuestions', 'otherQuestions'
        ));
    }

    /**
     * Store a visitor's answer to a question.
     */
    public function storeAnswer(Request $request, $id)
    {
        $question = $this->questionService->getQuestionById($id);

        if (!$question) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'writer' => ['required', 'string', 'max:255', new SafeText()],
            'answer' => ['required', 'string', 'min:5', 'max:300', new SafeText()],
        ], [], [
            'writer' => 'الاسم',
            'answer' => 'الرد',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $answer = $this->questionAnswerRepository->create([
            'question_id' => $question->id,
            'writer' => $validated['writer'],
            'answer' => $validated['answer'],
        ]);

        $successMessage = 'تم إضافة ردك بنجاح، شكرًا لمشاركتك.';

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'answer' => [
                    'writer' => $answer->writer ?: 'زائر',
                    'answer' => $answer->answer,
                    'date' => $answer->created->format('d/m/Y H:i'),
                ],
            ]);
        }

        $redirectUrl = ($question->seo?->slug ? url($question->seo->slug) : url()->previous()) . '#answer-form';

        return redirect($redirectUrl)->with('success', $successMessage);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('questionmodule::edit');
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
