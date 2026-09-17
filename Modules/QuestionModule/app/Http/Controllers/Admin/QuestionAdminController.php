<?php

namespace Modules\QuestionModule\app\Http\Controllers\Admin;

use App\Helpers\ApiResponseHelper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\QuestionModule\app\Repositories\QuestionAnswerRepository;
use Modules\QuestionModule\app\Services\QuestionService;
use Illuminate\Support\Facades\Session;

class QuestionAdminController extends Controller {
    protected $questionService;
    protected $questionAnswerRepository;

    public function __construct(QuestionService $questionService, QuestionAnswerRepository $questionAnswerRepository) {
        $this->questionService = $questionService;
        $this->questionAnswerRepository = $questionAnswerRepository;
    }

    public function index(Request $request) {
        $questions = $this->questionService->filter($request->all())->withCount('answers')->paginate(15);
        return view('questionmodule::admin.index', compact('questions'));
    }

    public function show($id) {
        $question = $this->questionService->findOne($id);
        return view('questionmodule::admin.show', compact('question'));
    }


    public function create() {
        return view('questionmodule::admin.create');
    }

    public function store(Request $request) {
        $validator = Validator::make(
            $request->all(),
            $this->validationRules(),
            $this->validationMessages()
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->questionService->create($request->all());
        return redirect()->route('admin.questions')->with('success', 'The question has been created successfully!');
    }

    public function edit($id) {
        $question = $this->questionService->findOne($id);
        return view('questionmodule::admin.edit', compact('question'));
    }

    public function update(Request $request) {
        $question = $this->questionService->findWhere(['id' => $request->id])->first();
        $validator = Validator::make(
            $request->all(),
            $this->validationRules($question->id),
            $this->validationMessages()
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->questionService->update($request->all());
        return redirect()->route('admin.questions')->with('success', 'The question has been updated successfully!');

    }

    public function destroy($id) {
        $this->questionService->deleteQuestion($id);
        return redirect()->route('admin.questions')->with('success', 'The question has been deleted successfully!');
    }

    /**
     * List every saved question and back-fill default SEO data
     * (meta title/description/tag = question title) for any that
     * don't have an SEO record yet.
     */
    public function applySeoToAll() {
        $updatedCount = $this->questionService->applySeoToAllQuestions();

        return redirect()->route('admin.questions')
            ->with('success', __('messages.seo_applied_to_questions', ['count' => $updatedCount]));
    }

    /**
     * Answers for a single question, for the "view answers" modal on
     * the questions list. Answers themselves aren't manageable from
     * the admin yet — this is read-only.
     */
    public function answers($id) {
        $answers = $this->questionAnswerRepository->findWhere(['question_id' => $id]);

        return response()->json($answers);
    }

    private function validationRules($ignoreQuestionId = null) {
        $titleUniqueRule = 'unique:questions,title' . ($ignoreQuestionId ? ',' . $ignoreQuestionId : '');

        return [
            'title' => "required|string|max:255|{$titleUniqueRule}",
            'question' => 'required|string',
            'writer' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:200',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'header_script' => 'nullable|string',
            'footer_script' => 'nullable|string',
        ];
    }

    private function validationMessages() {
        return [
            'title.required' => 'Please enter the title.',
            'title.unique' => 'This question title already exists. Please enter a different title.',
            'question.required' => 'Please enter the question.',
        ];
    }
}
