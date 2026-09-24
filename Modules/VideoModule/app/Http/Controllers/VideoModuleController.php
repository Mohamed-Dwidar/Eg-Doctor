<?php

namespace Modules\VideoModule\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\VideoModule\app\Services\VideoService;
use Modules\QuestionModule\app\Repositories\QuestionRepository;

class VideoModuleController extends Controller
{
    protected $videoService;
    protected $questionRepository;

    public function __construct(VideoService $videoService, QuestionRepository $questionRepository)
    {
        $this->videoService = $videoService;
        $this->questionRepository = $questionRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = $this->videoService->getPublishedPaginated(10);
        $readAlso = $this->videoService->getRandomPublished(4);
        $latestQuestions = $this->questionRepository->latest(4);

        return view('videomodule::guest.index', compact('videos', 'readAlso', 'latestQuestions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videomodule::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $video = $this->videoService->findOneWithRelations($id);

        if (!$video) {
            abort(404);
        }

        // One random pool, split so "مقالات أخرى" and "اقرأ أيضا" never
        // show the same videos as each other or as the current one.
        $otherPool = $this->videoService->getRandomExcept($video->id, 7);
        $otherVideos = $otherPool->take(3);
        $readAlso = $otherPool->slice(3, 4)->values();

        $latestQuestions = $this->questionRepository->latest(4);

        return view('videomodule::guest.show', compact('video', 'otherVideos', 'readAlso', 'latestQuestions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('videomodule::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
