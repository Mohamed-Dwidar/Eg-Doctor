<?php

namespace Modules\InformationModule\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\InformationModule\app\Services\InformationService;
use Modules\QuestionModule\app\Repositories\QuestionRepository;
use Modules\VideoModule\app\Services\VideoService;

class InformationModuleController extends Controller
{
    protected $informationService;
    protected $questionRepository;
    protected $videoService;

    public function __construct(
        InformationService $informationService,
        QuestionRepository $questionRepository,
        VideoService $videoService
    ) {
        $this->informationService = $informationService;
        $this->questionRepository = $questionRepository;
        $this->videoService = $videoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informations = $this->informationService->getPublishedPaginated(10);
        $readAlso = $this->informationService->getRandomPublished(4);
        $latestQuestions = $this->questionRepository->latest(4);
        $randomVideos = $this->videoService->getRandomPublished(4);

        return view('informationmodule::guest.index', compact(
            'informations', 'readAlso', 'latestQuestions', 'randomVideos'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('informationmodule::create');
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
        $information = $this->informationService->findOneWithRelations($id);

        if (!$information) {
            abort(404);
        }

        // One random pool, split so "معلومات طبية سريعة أخرى" and the
        // sidebar's "معلومات طبية سريعة" never show the same entries
        // as each other or as the current one.
        $otherPool = $this->informationService->getRandomExcept($information->id, 7);
        $otherInformations = $otherPool->take(3);
        $readAlso = $otherPool->slice(3, 4)->values();

        $latestQuestions = $this->questionRepository->latest(4);
        $randomVideos = $this->videoService->getRandomPublished(4);

        return view('informationmodule::guest.show', compact(
            'information', 'otherInformations', 'readAlso', 'latestQuestions', 'randomVideos'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('informationmodule::edit');
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
