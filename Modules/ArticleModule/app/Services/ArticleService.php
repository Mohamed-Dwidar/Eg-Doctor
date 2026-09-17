<?php

namespace Modules\ArticleModule\app\Services;


use App\Helpers\UploaderHelper;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Modules\ArticleModule\app\Repositories\ArticleRepository;
use Modules\SeoModule\Repository\SeoRepository;

class ArticleService {
    use UploaderHelper;

    protected $articleRepository;
    protected $seoRepository;

    /**
     * Article fields that come straight from the request with no
     * extra processing (pic upload / user_id are handled separately).
     */
    private const FILLABLE_FIELDS = ['title', 'content', 'doctor_id', 'status'];

    public function __construct(ArticleRepository $articleRepository, SeoRepository $seoRepository) {
        $this->articleRepository = $articleRepository;
        $this->seoRepository = $seoRepository;
    }

    public function getAllArticles() {
        return $this->articleRepository->all();
    }
    public function findWhere($arr) {
        return $this->articleRepository->findWhere($arr);
    }

    public function findOne($id) {
        return $this->articleRepository->findWhere(['id' => $id])->first();
    }

    public function getArticleById($id) {
        return $this->articleRepository->find($id);
    }

    public function create($data) {
        $articleData = $this->extractFillableData($data);
        $articleData['user_id'] = auth('admin')->id();

        $article = $this->articleRepository->create($articleData);

        if (!empty($data['pic']) && $data['pic'] instanceof UploadedFile) {
            $picName = $this->uploadImage($data['pic'], 'articles', 'Article');
            $this->articleRepository->update(['pic' => $picName], $article->id);
        }

        $this->seoRepository->create([
            'meta_title' => ($data['meta_title'] ?? null) ?: $data['title'],
            'meta_description' => ($data['meta_description'] ?? null) ?: $data['title'],
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $data['title']),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($article),
            'seo_capable_id' => $article->id
        ]);

        return $article->fresh();
    }

    public function update($data) {
        $id = $data['id'];
        $article = $this->articleRepository->find($id);
        if (!$article) {
            return null; // Handle case where article is not found
        }

        // Update article data
        $articleData = $this->extractFillableData($data);
        $this->articleRepository->update($articleData, $id);

        if (!empty($data['pic']) && $data['pic'] instanceof UploadedFile) {
            $oldPic = $article->pic;
            $picName = $this->uploadImage($data['pic'], 'articles', 'Article');
            $this->articleRepository->update(['pic' => $picName], $id);

            if ($oldPic) {
                File::delete(public_path('uploads/articles/' . $oldPic));
            }
        }

        // Update or create SEO data
        $seoData = [
            'slug' => ($data['slug'] ?? null) ?: $article->title,
            'meta_title' => ($data['meta_title'] ?? null) ?: $article->title,
            'meta_description' => ($data['meta_description'] ?? null) ?: $article->title,
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $article->title),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($article),
            'seo_capable_id' => $article->id
        ];
        if ($article->seo) {
            $this->seoRepository->update($seoData, $article->seo->id);
        } else {
            $this->seoRepository->create($seoData);
        }

        return $article->fresh();
    }

    /**
     * Pull the plain (non-file, non-owner) article fields out of the
     * request data, normalizing blank strings to null.
     */
    private function extractFillableData($data) {
        $result = [];

        foreach (self::FILLABLE_FIELDS as $field) {
            if (!array_key_exists($field, $data)) {
                continue;
            }

            $result[$field] = $data[$field] === '' ? null : $data[$field];
        }

        $result['status'] = !empty($data['status']) ? 1 : 0;

        return $result;
    }

    public function deleteArticle($id) {
        return $this->articleRepository->delete($id);
    }

    /**
     * List every saved article and back-fill a default SEO record
     * (meta title/description/tag = article title) for any of them
     * that don't already have one. Articles that already have SEO
     * data are left untouched.
     */
    public function applySeoToAllArticles() {
        $articles = $this->articleRepository->all();
        $updatedCount = 0;

        foreach ($articles as $article) {
            if ($article->seo) {
                continue;
            }

            $arr_data['slug'] = $article->title;
            $arr_data['meta_title'] = $article->title;
            $arr_data['meta_description'] = $article->content;
            $arr_data['meta_tag'] = $this->toKeywords($article->content);
            $arr_data['seo_capable_type'] = get_class($article);
            $arr_data['seo_capable_id'] = $article->id;

            $this->seoRepository->create($arr_data);

            $updatedCount++;
        }

        return $updatedCount;
    }

    public function filter($data = []) {
        return $this->articleRepository->filter($data);
    }

    /**
     * Turn free text into a comma-separated SEO keywords list
     * (splits on whitespace and/or existing commas, trims each
     * word, and drops empty pieces).
     */
    private function toKeywords($text) {
        if (!$text) {
            return $text;
        }

        $words = preg_split('/[\s,]+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        return implode(',', $words);
    }
}
