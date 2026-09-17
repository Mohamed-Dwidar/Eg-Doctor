<?php

namespace Modules\BlogModule\Services;

use App\Helpers\UploaderHelper;
use Illuminate\Support\Facades\File;
use Modules\BlogModule\Repository\BlogRepository;

class BlogService {
    private $BlogRepository;
    use UploaderHelper;
    // use Mailer;

    public function __construct(BlogRepository $BlogRepository) {
        $this->BlogRepository = $BlogRepository;
    }

    public function update($data) {
        $Blog_data = [
            'name_ar' => $data->name_ar,
            'description_ar' => $data->description_ar,
            'name_en' => $data->name_en,
            'description_en' => $data->description_en,
            'img_alt' => $data->img_alt ?? $data->name_en,
        ];
        $old_data = $this->BlogRepository->find($data->id);

        if ($data->hasFile('image')) {
            $imageName = $this->uploadImage($data->file('image'), 'blogs', 'Blog');

            if ($imageName) {
                $old_image_title = $old_data->image;
                /////Delete the old image////
                if ($old_image_title != null) {
                    File::delete(public_path('uploads/Blogs/image/' . $old_image_title));
                }
                /////////////////////////////
                $Blog_data['image'] = $imageName;
            }
        }

        $old_data->seo()->update([
            'meta_title' => $data->meta_title ?: $data->name_en,
            'meta_description' => $data->meta_description ?: $data->name_en,
            'meta_tag' => $data->meta_tag ?: $data->name_en,
            'footer_script' => $data->footer_script ?: $data->name_en,
            'header_script' => $data->header_script ?: $data->name_en,
        ]);



        return $this->BlogRepository->update($Blog_data, $data->id);
    }

    public function create($data) {

        $Blog_data = [
            'name_ar' => $data->name_ar,
            'description_ar' => $data->description_ar,
            'name_en' => $data->name_en,
            'description_en' => $data->description_en,
            'img_alt' => $data->img_alt ?? $data->name_en,
        ];

        $Blog = $this->BlogRepository->create($Blog_data);

        if ($data->hasFile('image')) {

            $imageName = $this->uploadImage($data->file('image'), 'blogs', 'Blog');
            $this->BlogRepository->update(['image' => $imageName], $Blog->id);
        }

        $Blog->seo()->create([
            'meta_title' => $data->meta_title ?: $data->name_en,
            'meta_description' => $data->meta_description ?: $data->name_en,
            'meta_tag' => $data->meta_tag ?: $data->name_en,
            'footer_script' => $data->footer_script ?: $data->name_en,
            'header_script' => $data->header_script ?: $data->name_en,
        ]);


        return $this->BlogRepository->update($Blog_data, $Blog->id);
    }

    public function findAll() {
        return $this->BlogRepository->get();
    }

    public function findOne($id) {
        return $this->BlogRepository->find($id);
    }

    public function delete($id) {
        $blog = $this->BlogRepository->find($id);
        $blog->seo()->delete();

        return $this->BlogRepository->delete($id);
    }

    public function paginate() {
        return $this->BlogRepository->paginate(12);
    }
    public function findWhere($arr) {
        return $this->BlogRepository->findWhere($arr);
    }

    public function bestBlogs($id) {
        return $this->BlogRepository->update(['top_Blog' => 1], $id);
    }
    public function removeTopBlog($id) {
        return $this->BlogRepository->update(['top_Blog' => 0], $id);
    }

    public function filter($request) {
        return $this->BlogRepository->filter($request);
    }
}
