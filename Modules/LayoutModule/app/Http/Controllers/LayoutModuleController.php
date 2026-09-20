<?php

namespace Modules\LayoutModule\app\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\ArticleModule\app\Repositories\ArticleRepository;
use Modules\DepartmentModule\app\Repositories\DepartmentRepository;
use Modules\DoctorModule\app\Repositories\CityRepository;
use Modules\DoctorModule\app\Repositories\DoctorRepository;
use Modules\DoctorModule\app\Repositories\ZoneRepository;
use Modules\InformationModule\app\Repositories\InformationRepository;
use Modules\PageModule\app\Services\PageService;
use Modules\QuestionModule\app\Repositories\QuestionRepository;

class LayoutModuleController extends Controller
{
    protected $pageService;
    protected $departmentRepository;
    protected $cityRepository;
    protected $zoneRepository;
    protected $doctorRepository;
    protected $articleRepository;
    protected $questionRepository;
    protected $informationRepository;

    public function __construct(
        PageService $pageService,
        DepartmentRepository $departmentRepository,
        CityRepository $cityRepository,
        ZoneRepository $zoneRepository,
        DoctorRepository $doctorRepository,
        ArticleRepository $articleRepository,
        QuestionRepository $questionRepository,
        InformationRepository $informationRepository
    ) {
        $this->pageService = $pageService;
        $this->departmentRepository = $departmentRepository;
        $this->cityRepository = $cityRepository;
        $this->zoneRepository = $zoneRepository;
        $this->doctorRepository = $doctorRepository;
        $this->articleRepository = $articleRepository;
        $this->questionRepository = $questionRepository;
        $this->informationRepository = $informationRepository;
    }

    public function home_page()
    {
        // $pages = $this->pageService->findAll();
        $departments = $this->departmentRepository->all()->sortBy('name')->values();

        $cities = $this->cityRepository->all()->sortBy('id')->values();
        $defaultCity = $cities->firstWhere('name', 'القاهرة') ?? $cities->first();
        $defaultCityZones = $defaultCity
            ? $this->zoneRepository->findWhere(['city_id' => $defaultCity->id])->sortBy('name')->values()
            : collect();

        $featuredDoctors = $this->doctorRepository->random(6);
        $randomArticles = $this->articleRepository->random(4);
        $latestQuestions = $this->questionRepository->latest(4);
        $randomInformations = $this->informationRepository->random(6);

        return view('layoutmodule::front.home', compact(
            'departments',
            'cities',
            'defaultCity',
            'defaultCityZones',
            'featuredDoctors',
            'randomArticles',
            'latestQuestions',
            'randomInformations'
        ));
    }

    public function welcome()
    {
        return view('layoutmodule::front.welcome');
    }

    public function admin_dashboard()
    {
        if (Auth::guard('admin')->check()) {
            // dd(Auth::guard('admin')->user()->email);
            return view('layoutmodule::admin.dashboard');
        } else {
            return redirect()->route('admin.login');
        }
    }
}
