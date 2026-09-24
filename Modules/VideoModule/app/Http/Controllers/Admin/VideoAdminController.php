<?php

namespace Modules\VideoModule\app\Http\Controllers\Admin;

use App\Helpers\ApiResponseHelper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\VideoModule\app\Services\VideoService;
use Illuminate\Support\Facades\Session;

class VideoAdminController extends Controller {
    protected $videoService;

    public function __construct(VideoService $videoService) {
        $this->videoService = $videoService;
    }

    public function index(Request $request) {
        $videos = $this->videoService->filter($request->all())->paginate(15);
        return view('videomodule::admin.index', compact('videos'));
    }

    public function show($id) {
        $video = $this->videoService->findOne($id);
        return view('videomodule::admin.show', compact('video'));
    }


    public function create() {
        return view('videomodule::admin.create');
    }

    public function store(Request $request) {
        $validator = Validator::make(
            $request->all(),
            $this->validationRules(),
            $this->validationMessages()
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->videoService->create($request->all());
        return redirect()->route('admin.videos')->with('success', 'The video has been created successfully!');
    }

    public function edit($id) {
        $video = $this->videoService->findOne($id);
        return view('videomodule::admin.edit', compact('video'));
    }

    public function update(Request $request) {
        $video = $this->videoService->findWhere(['id' => $request->id])->first();
        $validator = Validator::make(
            $request->all(),
            $this->validationRules($video->id),
            $this->validationMessages()
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->videoService->update($request->all());
        return redirect()->route('admin.videos')->with('success', 'The video has been updated successfully!');

    }

    public function destroy($id) {
        $this->videoService->deleteVideo($id);
        return redirect()->route('admin.videos')->with('success', 'The video has been deleted successfully!');
    }

    /**
     * List every saved video and back-fill default SEO data
     * (meta title/description/tag = video title) for any that
     * don't have an SEO record yet.
     */
    public function applySeoToAll() {
        $updatedCount = $this->videoService->applySeoToAllVideos();

        return redirect()->route('admin.videos')
            ->with('success', __('messages.seo_applied_to_videos', ['count' => $updatedCount]));
    }

    private function validationRules($ignoreVideoId = null) {
        $titleUniqueRule = 'unique:videos,title' . ($ignoreVideoId ? ',' . $ignoreVideoId : '');

        return [
            'title' => "required|string|max:255|{$titleUniqueRule}",
            'description' => 'required|string',
            'youtube_code' => 'nullable|string|max:100',
            'video_code' => 'nullable|string',
            'img_url' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'header_script' => 'nullable|string',
            'footer_script' => 'nullable|string',
        ];
    }

    private function validationMessages() {
        return [
            'title.required' => 'Please enter the title.',
            'title.unique' => 'This video title already exists. Please enter a different title.',
            'description.required' => 'Please enter the description.',
        ];
    }
}
