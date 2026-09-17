<?php

namespace Modules\QuestionModule\app\Services;


use Modules\QuestionModule\app\Repositories\QuestionRepository;
use Modules\SeoModule\Repository\SeoRepository;

class QuestionService {
    protected $questionRepository;
    protected $seoRepository;

    public function __construct(QuestionRepository $questionRepository, SeoRepository $seoRepository) {
        $this->questionRepository = $questionRepository;
        $this->seoRepository = $seoRepository;
    }

    public function getAllQuestions() {
        return $this->questionRepository->all();
    }
    public function findWhere($arr) {
        return $this->questionRepository->findWhere($arr);
    }

    public function findOne($id) {
        return $this->questionRepository->findWhere(['id' => $id])->first();
    }

    public function getQuestionById($id) {
        return $this->questionRepository->find($id);
    }

    /**
     * Question fields that come straight from the request with no
     * extra processing.
     */
    private const FILLABLE_FIELDS = ['title', 'question', 'writer', 'email'];

    public function create($data) {
        $questionData = $this->extractFillableData($data);

        $question = $this->questionRepository->create($questionData);

        $this->seoRepository->create([
            'meta_title' => ($data['meta_title'] ?? null) ?: $data['title'],
            'meta_description' => ($data['meta_description'] ?? null) ?: $data['title'],
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $data['title']),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($question),
            'seo_capable_id' => $question->id
        ]);
        return $question;
    }

    public function update($data) {
        $id = $data['id'];
        $question = $this->questionRepository->find($id);
        if (!$question) {
            return null; // Handle case where question is not found
        }

        // Update question data
        $questionData = $this->extractFillableData($data);
        $this->questionRepository->update($questionData, $id);

        // Update or create SEO data
        $seoData = [
            'slug' => ($data['slug'] ?? null) ?: $question->title,
            'meta_title' => ($data['meta_title'] ?? null) ?: $question->title,
            'meta_description' => ($data['meta_description'] ?? null) ?: $question->title,
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $question->title),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($question),
            'seo_capable_id' => $question->id
        ];
        if ($question->seo) {
            $this->seoRepository->update($seoData, $question->seo->id);
        } else {
            $this->seoRepository->create($seoData);
        }

        return $question;
    }

    /**
     * Pull the plain question fields out of the request data,
     * normalizing blank strings to null for the optional ones.
     */
    private function extractFillableData($data) {
        $result = [];

        foreach (self::FILLABLE_FIELDS as $field) {
            if (!array_key_exists($field, $data)) {
                continue;
            }

            $result[$field] = $data[$field] === '' ? null : $data[$field];
        }

        return $result;
    }

    public function deleteQuestion($id) {
        return $this->questionRepository->delete($id);
    }

    /**
     * List every saved question and back-fill a default SEO record
     * (meta title/description/tag = question title) for any of them
     * that don't already have one. Questions that already have SEO
     * data are left untouched.
     */
    public function applySeoToAllQuestions() {
        $questions = $this->questionRepository->all();
        $updatedCount = 0;

        foreach ($questions as $question) {
            if ($question->seo) {
                continue;
            }

            $arr_data['slug'] = $question->title;
            $arr_data['meta_title'] = $question->title;
            $arr_data['meta_description'] = $question->question;
            $arr_data['meta_tag'] = $this->toKeywords($question->question);
            $arr_data['seo_capable_type'] = get_class($question);
            $arr_data['seo_capable_id'] = $question->id;

            $this->seoRepository->create($arr_data);

            $updatedCount++;
        }

        return $updatedCount;
    }

    public function filter($data = []) {
        return $this->questionRepository->filter($data);
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
