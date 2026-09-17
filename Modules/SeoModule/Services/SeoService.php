<?php

namespace Modules\SeoModule\Services;

use App\Helpers\UploaderHelper;
use Illuminate\Support\Facades\File;
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

    public function update($data)
    {
        $project_data = [
            'name' => $data->name,
            'img_alt' => $data->img_alt,
        ];
        if ($data->hasFile('image')) {
            $imageName = $this->uploadImage($data->file('image'), 'projects', 'p');
            if ($imageName) {
                $old_data = $this->projectRepository->find($data->id);
                $old_image_title = $old_data->image;
                /////Delete the old image////
                if ($old_image_title != null) {
                    File::delete(public_path('uploads/projects/' . $old_image_title));
                }
                /////////////////////////////
                $project_data['image'] = $imageName;
            }
        }

        return $this->projectRepository->update($project_data, $data->id);
    }
    public function create($data)
    {
        // dd($data);
        $project_data = [
            'name' => $data->name,
            'img_alt' => $data->img_alt,
        ];

        $service = $this->projectRepository->create($project_data);

        if ($data->hasFile('image')) {
            $imageName = $this->uploadImage($data->file('image'), 'projects', 'p');
            $project_data['image'] = $imageName;
        }

        return $this->projectRepository->update($project_data, $service->id);
    }

    public function findAll()
    {
        return $this->projectRepository->get();
    }

    public function findOne($id)
    {
        return $this->projectRepository->find($id);
    }

    public function delete($id)
    {
        return $this->projectRepository->delete($id);
    }

    public function paginate()
    {
        return $this->projectRepository->paginate();
    }
}
