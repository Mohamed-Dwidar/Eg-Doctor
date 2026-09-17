<?php

namespace Modules\PageModule\app\Services;

use App\Helpers\UploaderHelper;
use App\Helpers\ApiResponseHelper;

use Illuminate\Support\Facades\File;
use Modules\PageModule\app\Repositories\PageRepository;

class PageService
{
    use ApiResponseHelper;
    private $pageRepository;

    use UploaderHelper;

    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function create($data)
    {
        ///////Upload Image////////
        $imageName = null;
        if ($data->hasFile('image')) {
            $imageName = $this->uploadImage($data->file('image'), 'pages', 'pag');
        }
        //////////////////////////

        $page_data = [
            'title' => $data->title,
            'parent_id' => $data->parent_id ? $data->parent_id : 0,
            'slug' => $data->slug ? $data->slug : null,
            'content' => $data->content ? $data->content : null,
            'is_active' => $data->is_active ? 1 : 0,
            'meta_title' => $data->meta_title ? $data->meta_title : null,
            'meta_description' => $data->meta_description ? $data->meta_description : null,
            'meta_keywords' => $data->meta_keywords ? $data->meta_keywords : null,
            'image' => $imageName,
        ];
       return $this->pageRepository->create($page_data);
    }

    public function update($data)
    {
        $old_data = $this->pageRepository->find($data->id);
        $page_data = [
            'title' => $data->title ? $data->title : $old_data->title,
            'parent_id' => $data->parent_id ? $data->parent_id : 0,
            'slug' => $data->slug ? $data->slug : $old_data->slug,
            'content' => $data->content ? $data->content : $old_data->content,
            'is_active' => $data->is_active ? 1 : 0,
            'meta_title' => $data->meta_title ? $data->meta_title : $old_data->meta_title,
            'meta_description' => $data->meta_description ? $data->meta_description : $old_data->meta_description,
            'meta_keywords' => $data->meta_keywords ? $data->meta_keywords : $old_data->meta_keywords
        ];

        $old_data = $this->pageRepository->find($data->id);

        ///////Upload Image////////
        if ($data->hasFile('image')) {
            $imageName = $this->uploadImage($data->file('image'), 'pages', 'pag');
            if ($imageName) {
                $old_image_name = $old_data->image;
                /////Delete the old image////
                if ($old_image_name != null) {
                    File::delete(public_path('uploads/pages/' . $old_image_name));
                }
                /////////////////////////////
                $page_data['image'] = $imageName;
            }
        }

        return $this->pageRepository->update($page_data, $data->id);
    }

    public function findAll()
    {
        return $this->pageRepository->get();
    }

    public function findAllActive()
    {
        return $this->pageRepository->findWhere(['is_active' => 1]);
    }

    public function findTopParents($not_id = 0)
    {
        return $this->pageRepository->getTopParents($not_id);
    }

    public function findSubPages($parent_id = 0, $without_id = null)
    {
        return $this->pageRepository->getSubPages($parent_id, $without_id);
    }

    public function findRandom($rand)
    {
        return $this->pageRepository->getRandom($rand);
    }

    public function findOne($id)
    {
        return $this->pageRepository->findWhere(['id'=>$id])->first();
    }
    
    public function findBySlug($slug)
    {
        return $this->pageRepository->findWhere(['slug' => $slug])->first();
    }

    public function deleteOne($id)
    {
        $old_data = $this->pageRepository->find($id);
        if (!empty($old_data)) {
            if ($this->pageRepository->delete($id)) {
                $old_image_name = $old_data->image;
                /////Delete the old image////
                if ($old_image_name != null) {
                    File::delete(public_path('uploads/pages/' . $old_image_name));
                }
                /////////////////////////////
            }
        }
    }

    public function deleteMany($arr_ids)
    {
        if (!empty($arr_ids)) {
            foreach ($arr_ids as $id) {
                $old_data = $this->pageRepository->find($id);
                if (!empty($old_data)) {
                    if ($this->pageRepository->delete($id)) {
                        $old_image_name = $old_data->image;
                        /////Delete the old image////
                        if ($old_image_name != null) {
                            File::delete(public_path('uploads/pages/' . $old_image_name));
                        }
                        /////////////////////////////
                    }
                }
            }
        }
    }

    public function filter($request)
    {
        return $this->pageRepository->filter($request);
    }

    public function changePageActivity($id)
    {
        $page = $this->pageRepository->find($id);
        
        if (!$page) {
            // Handle the case when the page with the given ID is not found
            return null;
        }
    
        // Toggle the is_active status of the main page
        $page_is_active = $page->is_active;
        $page_data = [
            "is_active" => $page_is_active == 1 ? 0 : 1
        ];
    
        $this->pageRepository->update($page_data, $id);
    
        // Update the is_active status of subpages
        $subpages = $this->pageRepository->getPagesTree($id);
    
        foreach ($subpages as $subpage) {
            $subpage_data = [
                "is_active" => $page_data["is_active"]
            ];
    
            $this->pageRepository->update($subpage_data, $subpage->id);
        }
    
        return $page;
    }
}
