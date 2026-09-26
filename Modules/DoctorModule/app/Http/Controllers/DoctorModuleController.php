<?php

namespace Modules\DoctorModule\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\ArticleModule\app\Repositories\ArticleRepository;
use Modules\DepartmentModule\app\Repositories\DepartmentRepository;
use Modules\DoctorModule\app\Repositories\CityRepository;
use Modules\DoctorModule\app\Repositories\ZoneRepository;
use Modules\DoctorModule\app\Services\DoctorService;
use Modules\InformationModule\app\Services\InformationService;
use Modules\QuestionModule\app\Repositories\QuestionRepository;
use Modules\VideoModule\app\Services\VideoService;

class DoctorModuleController extends Controller
{
    protected $doctorService;
    protected $departmentRepository;
    protected $cityRepository;
    protected $zoneRepository;
    protected $articleRepository;
    protected $questionRepository;
    protected $videoService;
    protected $informationService;

    public function __construct(
        DoctorService $doctorService,
        DepartmentRepository $departmentRepository,
        CityRepository $cityRepository,
        ZoneRepository $zoneRepository,
        ArticleRepository $articleRepository,
        QuestionRepository $questionRepository,
        VideoService $videoService,
        InformationService $informationService
    ) {
        $this->doctorService = $doctorService;
        $this->departmentRepository = $departmentRepository;
        $this->cityRepository = $cityRepository;
        $this->zoneRepository = $zoneRepository;
        $this->articleRepository = $articleRepository;
        $this->questionRepository = $questionRepository;
        $this->videoService = $videoService;
        $this->informationService = $informationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('doctormodule::index');
    }

    /**
     * Dedicated "search for a doctor" page — just the search card
     * (plus surrounding ads), linked from the nav/footer. Submits to
     * search() below.
     */
    public function searchForm()
    {
        $departments = $this->departmentRepository->allSorted();

        $cities = $this->cityRepository->all()->sortBy('id')->values();
        $defaultCity = $cities->firstWhere('name', 'القاهرة') ?? $cities->first();
        $defaultCityZones = $defaultCity
            ? $this->zoneRepository->findWhere(['city_id' => $defaultCity->id])->sortBy('name')->values()
            : collect();

        return view('doctormodule::search-form', compact(
            'departments', 'cities', 'defaultCity', 'defaultCityZones'
        ));
    }

    /**
     * Public doctors search — driven by the homepage search card
     * (specialty / governorate / area / doctor_name), filtered via
     * Doctor::scopeFilter.
     */
    public function search(Request $request)
    {
        $filters = [
            'specialty' => $this->digitsOrNull($request->input('specialty')),
            'governorate' => $this->digitsOrNull($request->input('governorate')),
            'area' => $this->digitsOrNull($request->input('area')),
            'doctor_name' => $request->filled('doctor_name')
                ? trim(strip_tags((string) $request->input('doctor_name')))
                : null,
        ];

        $doctors = $this->doctorService->search($filters, 10)->withQueryString();

        $departments = $this->departmentRepository->allSorted();
        $cities = $this->cityRepository->all()->sortBy('id')->values();
        $zones = $filters['governorate']
            ? $this->zoneRepository->findWhere(['city_id' => $filters['governorate']])->sortBy('name')->values()
            : collect();

        $relatedArticles = $this->articleRepository->random(4);
        $latestQuestions = $this->questionRepository->latest(4);
        $randomVideos = $this->videoService->getRandomPublished(4);
        $randomInformations = $this->informationService->getRandomPublished(4);

        return view('doctormodule::search', compact(
            'doctors', 'filters', 'departments', 'cities', 'zones',
            'relatedArticles', 'latestQuestions', 'randomVideos', 'randomInformations'
        ));
    }

    /**
     * Cast a request value to int when it's a plain digit string, else null.
     */
    private function digitsOrNull($value)
    {
        return ($value !== null && $value !== '' && ctype_digit((string) $value)) ? (int) $value : null;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('doctormodule::create');
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
        $doctor = $this->doctorService->findOneWithRelations($id);

        if (!$doctor) {
            abort(404);
        }

        $relatedArticles = $this->articleRepository->forDoctor($doctor->id, 4);
        if ($relatedArticles->isEmpty()) {
            $relatedArticles = $this->articleRepository->random(4);
        }

        $latestQuestions = $this->questionRepository->latest(4);
        $randomVideos = $this->videoService->getRandomPublished(4);
        $randomInformations = $this->informationService->getRandomPublished(4);

        return view('doctormodule::show', compact(
            'doctor', 'relatedArticles', 'latestQuestions', 'randomVideos', 'randomInformations'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('doctormodule::edit');
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
