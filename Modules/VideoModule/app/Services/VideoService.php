<?php

namespace Modules\VideoModule\app\Services;


use Modules\VideoModule\app\Repositories\VideoRepository;
use Modules\SeoModule\Repository\SeoRepository;

class VideoService {
    protected $videoRepository;
    protected $seoRepository;

    /**
     * Video fields that come straight from the request with no
     * extra processing. is_active is coerced separately since it's
     * a checkbox; views_nu/views_nu_url are auto-managed counters,
     * not user-editable.
     */
    private const FILLABLE_FIELDS = ['title', 'description', 'youtube_code', 'video_code', 'img_url'];

    public function __construct(VideoRepository $videoRepository, SeoRepository $seoRepository) {
        $this->videoRepository = $videoRepository;
        $this->seoRepository = $seoRepository;
    }

    public function getAllVideos() {
        return $this->videoRepository->all();
    }

    public function getPublishedPaginated($perPage) {
        return $this->videoRepository->publishedPaginated($perPage);
    }

    public function getRandomPublished($count) {
        return $this->videoRepository->random($count);
    }

    public function findOneWithRelations($id) {
        return $this->videoRepository->findWithRelations($id);
    }

    public function getRandomExcept($excludeId, $count) {
        return $this->videoRepository->randomExcept($excludeId, $count);
    }

    public function findWhere($arr) {
        return $this->videoRepository->findWhere($arr);
    }

    public function findOne($id) {
        return $this->videoRepository->findWhere(['id' => $id])->first();
    }

    public function getVideoById($id) {
        return $this->videoRepository->find($id);
    }

    public function create($data) {
        $videoData = $this->extractFillableData($data);

        $video = $this->videoRepository->create($videoData);

        $this->seoRepository->create([
            'meta_title' => ($data['meta_title'] ?? null) ?: $data['title'],
            'meta_description' => ($data['meta_description'] ?? null) ?: $data['title'],
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $data['title']),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($video),
            'seo_capable_id' => $video->id
        ]);

        return $video->fresh();
    }

    public function update($data) {
        $id = $data['id'];
        $video = $this->videoRepository->find($id);
        if (!$video) {
            return null; // Handle case where video is not found
        }

        // Update video data
        $videoData = $this->extractFillableData($data);
        $this->videoRepository->update($videoData, $id);

        // Update or create SEO data
        $seoData = [
            'slug' => ($data['slug'] ?? null) ?: $video->title,
            'meta_title' => ($data['meta_title'] ?? null) ?: $video->title,
            'meta_description' => ($data['meta_description'] ?? null) ?: $video->title,
            'meta_tag' => $this->toKeywords(($data['meta_tag'] ?? null) ?: $video->title),
            'header_script' => $data['header_script'] ?? null,
            'footer_script' => $data['footer_script'] ?? null,
            'seo_capable_type' => get_class($video),
            'seo_capable_id' => $video->id
        ];
        if ($video->seo) {
            $this->seoRepository->update($seoData, $video->seo->id);
        } else {
            $this->seoRepository->create($seoData);
        }

        return $video->fresh();
    }

    /**
     * Pull the plain video fields out of the request data,
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

    public function deleteVideo($id) {
        return $this->videoRepository->delete($id);
    }

    /**
     * List every saved video and back-fill a default SEO record
     * (meta title/description/tag = video title) for any of them
     * that don't already have one. Videos that already have SEO
     * data are left untouched.
     */
    public function applySeoToAllVideos() {
        $videos = $this->videoRepository->all();
        $updatedCount = 0;

        foreach ($videos as $video) {
            if ($video->seo) {
                continue;
            }

            $arr_data['slug'] = $video->title;
            $arr_data['meta_title'] = $video->title;
            $arr_data['meta_description'] = $video->description;
            $arr_data['meta_tag'] = $this->toKeywords($video->description);
            $arr_data['seo_capable_type'] = get_class($video);
            $arr_data['seo_capable_id'] = $video->id;

            $this->seoRepository->create($arr_data);

            $updatedCount++;
        }

        return $updatedCount;
    }

    public function filter($data = []) {
        return $this->videoRepository->filter($data);
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
