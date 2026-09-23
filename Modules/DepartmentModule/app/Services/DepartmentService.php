<?php

namespace Modules\DepartmentModule\app\Services;


use Modules\DepartmentModule\app\Repositories\DepartmentRepository;
use Modules\SeoModule\Repository\SeoRepository;

class DepartmentService {
    protected $departmentRepository;
    protected $seoRepository;

    public function __construct(DepartmentRepository $departmentRepository, SeoRepository $seoRepository) {
        $this->departmentRepository = $departmentRepository;
        $this->seoRepository = $seoRepository;
    }

    public function getAllDepartments() {
        return $this->departmentRepository->all();
    }

    public function getAllDepartmentsSorted() {
        return $this->departmentRepository->allSorted();
    }

    public function findOneWithSeo($id) {
        return $this->departmentRepository->findWithSeo($id);
    }
    public function findWhere($arr) {
        return $this->departmentRepository->findWhere($arr);
    }

    public function findOne($id) {
        return $this->departmentRepository->findWhere(['id' => $id])->first();
    }

    public function getDepartmentById($id) {
        return $this->departmentRepository->find($id);
    }

    public function create($data) {
        $departmentData = [
            'name' => $data['name']
        ];

        $department = $this->departmentRepository->create($departmentData);

        $this->seoRepository->create([
            'meta_title' => ($data['meta_title'] ?? null) ?: $data['name'],
            'meta_description' => ($data['meta_description'] ?? null) ?: $data['name'],
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $data['name']),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($department),
            'seo_capable_id' => $department->id
        ]);
        return $department;
    }

    public function update($data) {
        $id = $data['id'];
        $department = $this->departmentRepository->find($id);
        if (!$department) {
            return null; // Handle case where department is not found
        }

        // Update department data
        $departmentData = [
            'name' => $data['name'] ?? $department->name
        ];

        $this->departmentRepository->update($departmentData, $id);

        // Update or create SEO data
        $seoData = [
            'slug' => ($data['slug'] ?? null) ?: $department->name,
            'meta_title' => ($data['meta_title'] ?? null) ?: $department->name,
            'meta_description' => ($data['meta_description'] ?? null) ?: $department->name,
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $department->name),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($department),
            'seo_capable_id' => $department->id
        ];
        if ($department->seo) {
            $this->seoRepository->update($seoData, $department->seo->id);
        } else {
            $this->seoRepository->create($seoData);
        }

        return $department;
    }

    public function deleteDepartment($id) {
        return $this->departmentRepository->delete($id);
    }

    /**
     * List every saved department and back-fill a default SEO record
     * (meta title/description/tag = department name) for any of them
     * that don't already have one. Departments that already have SEO
     * data are left untouched.
     */
    public function applySeoToAllDepartments() {
        $departments = $this->departmentRepository->all();
        $updatedCount = 0;

        foreach ($departments as $department) {
            if ($department->seo) {
                continue;
            }

            $arr_data['slug'] = $department->name;
            $arr_data['meta_title'] = $department->name;
            $arr_data['meta_description'] = $department->description;
            $arr_data['meta_tag'] = $this->toKeywords($department->description);
            $arr_data['seo_capable_type'] = get_class($department);
            $arr_data['seo_capable_id'] = $department->id;

            $this->seoRepository->create($arr_data);

            $updatedCount++;
        }

        return $updatedCount;
    }

    public function filter($data = []) {
        return $this->departmentRepository->filter($data);
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
