<?php

namespace Modules\SeoModule\Services;

use App\Helpers\UploaderHelper;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Modules\SeoModule\Repository\SeoRepository;

class SeoService
{
    private $seoRepository;
    use UploaderHelper;
    // use Mailer;

    public function __construct(SeoRepository $seoRepository)
    {
        $this->seoRepository = $seoRepository;

    }
    public function create($data)
    {
        return $this->seoRepository->create($data);
    }

    public function update($data)
    {
        $project_data = [
            'slug' => Str::slug($data->slug, '-', null),
            'meta_title' => $data->meta_title,
            'meta_description' => $data->meta_description,
            'meta_tag' => $data->meta_tag,
            'header_script' => $data->header_script,
            'footer_script' => $data->footer_script,
        ];

        return $this->seoRepository->update($project_data, $data->id);
    }

    public function findAll()
    {
        return $this->seoRepository->all();
    }

    public function findOne($id)
    {
        return $this->seoRepository->find($id);
    }

    public function delete($id)
    {
        return $this->seoRepository->delete($id);
    }

    public function paginate()
    {
        return $this->seoRepository->paginate();
    }
}
