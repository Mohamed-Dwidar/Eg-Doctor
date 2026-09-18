<?php

namespace Modules\InformationModule\app\Services;


use Modules\InformationModule\app\Repositories\InformationRepository;
use Modules\SeoModule\Repository\SeoRepository;

class InformationService {
    protected $informationRepository;
    protected $seoRepository;

    /**
     * Information fields that come straight from the request with no
     * extra processing (is_active is coerced separately, since it's
     * a checkbox).
     */
    private const FILLABLE_FIELDS = ['title', 'content'];

    public function __construct(InformationRepository $informationRepository, SeoRepository $seoRepository) {
        $this->informationRepository = $informationRepository;
        $this->seoRepository = $seoRepository;
    }

    public function getAllInformations() {
        return $this->informationRepository->all();
    }
    public function findWhere($arr) {
        return $this->informationRepository->findWhere($arr);
    }

    public function findOne($id) {
        return $this->informationRepository->findWhere(['id' => $id])->first();
    }

    public function getInformationById($id) {
        return $this->informationRepository->find($id);
    }

    public function create($data) {
        $informationData = $this->extractFillableData($data);

        $information = $this->informationRepository->create($informationData);

        $this->seoRepository->create([
            'meta_title' => ($data['meta_title'] ?? null) ?: $data['title'],
            'meta_description' => ($data['meta_description'] ?? null) ?: $data['title'],
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $data['title']),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($information),
            'seo_capable_id' => $information->id
        ]);

        return $information->fresh();
    }

    public function update($data) {
        $id = $data['id'];
        $information = $this->informationRepository->find($id);
        if (!$information) {
            return null; // Handle case where information is not found
        }

        // Update information data
        $informationData = $this->extractFillableData($data);
        $this->informationRepository->update($informationData, $id);

        // Update or create SEO data
        $seoData = [
            'slug' => ($data['slug'] ?? null) ?: $information->title,
            'meta_title' => ($data['meta_title'] ?? null) ?: $information->title,
            'meta_description' => ($data['meta_description'] ?? null) ?: $information->title,
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $information->title),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($information),
            'seo_capable_id' => $information->id
        ];
        if ($information->seo) {
            $this->seoRepository->update($seoData, $information->seo->id);
        } else {
            $this->seoRepository->create($seoData);
        }

        return $information->fresh();
    }

    /**
     * Pull the plain information fields out of the request data,
     * normalizing blank strings to null. is_active is coerced
     * separately since it's a checkbox (absent when unchecked).
     */
    private function extractFillableData($data) {
        $result = [];

        foreach (self::FILLABLE_FIELDS as $field) {
            if (!array_key_exists($field, $data)) {
                continue;
            }

            $result[$field] = $data[$field] === '' ? null : $data[$field];
        }

        $result['is_active'] = !empty($data['is_active']) ? 1 : 0;

        return $result;
    }

    public function deleteInformation($id) {
        return $this->informationRepository->delete($id);
    }

    /**
     * List every saved information and back-fill a default SEO record
     * (meta title/description/tag = information title) for any of them
     * that don't already have one. Informations that already have SEO
     * data are left untouched.
     */
    public function applySeoToAllInformations() {
        $informations = $this->informationRepository->all();
        $updatedCount = 0;

        foreach ($informations as $information) {
            if ($information->seo) {
                continue;
            }

            $arr_data['slug'] = $information->title;
            $arr_data['meta_title'] = $information->title;
            $arr_data['meta_description'] = $information->content;
            $arr_data['meta_tag'] = $this->toKeywords($information->content);
            $arr_data['seo_capable_type'] = get_class($information);
            $arr_data['seo_capable_id'] = $information->id;

            $this->seoRepository->create($arr_data);

            $updatedCount++;
        }

        return $updatedCount;
    }

    public function filter($data = []) {
        return $this->informationRepository->filter($data);
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
