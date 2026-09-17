<?php

namespace Modules\ArticleModule\app\Http\Controllers\Admin;

use App\Helpers\ApiResponseHelper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\ArticleModule\app\Services\ArticleService;
use Modules\DoctorModule\app\Repositories\DoctorRepository;
use Illuminate\Support\Facades\Session;

class ArticleAdminController extends Controller {
    protected $articleService;
    protected $doctorRepository;

    public function __construct(ArticleService $articleService, DoctorRepository $doctorRepository) {
        $this->articleService = $articleService;
        $this->doctorRepository = $doctorRepository;
    }

    public function index(Request $request) {
        $articles = $this->articleService->filter($request->all())->with('doctor')->paginate(15);
        return view('articlemodule::admin.index', compact('articles'));
    }

    public function show($id) {
        $article = $this->articleService->findOne($id);
        return view('articlemodule::admin.show', compact('article'));
    }


    public function create() {
        $doctors = $this->doctorRepository->all();
        return view('articlemodule::admin.create', compact('doctors'));
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
        $this->articleService->create($request->all());
        return redirect()->route('admin.articles')->with('success', 'The article has been created successfully!');
    }

    public function edit($id) {
        $article = $this->articleService->findOne($id);
        $doctors = $this->doctorRepository->all();
        return view('articlemodule::admin.edit', compact('article', 'doctors'));
    }

    public function update(Request $request) {
        $article = $this->articleService->findWhere(['id' => $request->id])->first();
        $validator = Validator::make(
            $request->all(),
            $this->validationRules($article->id),
            $this->validationMessages()
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->articleService->update($request->all());
        return redirect()->route('admin.articles')->with('success', 'The article has been updated successfully!');

    }

    public function destroy($id) {
        $this->articleService->deleteArticle($id);
        return redirect()->route('admin.articles')->with('success', 'The article has been deleted successfully!');
    }

    /**
     * List every saved article and back-fill default SEO data
     * (meta title/description/tag = article title) for any that
     * don't have an SEO record yet.
     */
    public function applySeoToAll() {
        $updatedCount = $this->articleService->applySeoToAllArticles();

        return redirect()->route('admin.articles')
            ->with('success', __('messages.seo_applied_to_articles', ['count' => $updatedCount]));
    }

    private function validationRules($ignoreArticleId = null) {
        $titleUniqueRule = 'unique:articles,title' . ($ignoreArticleId ? ',' . $ignoreArticleId : '');

        return [
            'title' => "required|string|max:255|{$titleUniqueRule}",
            'content' => 'required|string',
            'doctor_id' => 'nullable|integer|exists:doctors,id',
            'pic' => 'nullable|image|max:2048',
            'status' => 'nullable|boolean',
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
            'title.unique' => 'This article title already exists. Please enter a different title.',
            'content.required' => 'Please enter the content.',
        ];
    }
}
