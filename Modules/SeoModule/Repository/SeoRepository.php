<?php

namespace Modules\SeoModule\Repository;


use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Str;
use Modules\SeoModule\App\Models\Seo;

class SeoRepository extends BaseRepository {
    function model() {
        return Seo::class;
    }
    public function create($data) {
        $project_data = [
            'slug' => $this->slugCreator(key_exists('slug', $data) ? $data['slug'] : $data['meta_title']),
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
            'meta_tag' => $data['meta_tag'],
            'header_script' => key_exists('header_script', $data) ? $data['header_script'] : $data['meta_description'],
            'footer_script' => key_exists('footer_script', $data) ? $data['footer_script'] : $data['meta_description'],
            'seo_capable_type' => $data['seo_capable_type'],
            'seo_capable_id' => $data['seo_capable_id'],
        ];

        return Seo::create($project_data);
    }

    public function update($data, $id) {
        $project_data = [
            'slug' => $this->slugCreator(key_exists('slug', $data) ? $data['slug'] : $data['meta_title']),
            'meta_title' => $data['meta_title'],
            'meta_description' => $data['meta_description'],
            'meta_tag' => $data['meta_tag'],
            'header_script' => key_exists('header_script', $data) ? $data['header_script'] : $data['meta_description'],
            'footer_script' => key_exists('footer_script', $data) ? $data['footer_script'] : $data['meta_description'],
        ];

        return Seo::where('id', $id)->update($project_data);
    }

    private function slugCreator($text, $excludeId = null) {
        $baseSlug = Str::slug($text, '-', null);
        $slug = $baseSlug;
        $count = 1;

        while (
            Seo::where('slug', $slug)
                ->when($excludeId, fn($query) => $query->where('id', '!=', $excludeId))
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
