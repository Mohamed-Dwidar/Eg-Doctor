<?php

namespace Modules\DoctorModule\app\Http\Controllers\Admin;

use App\Helpers\ApiResponseHelper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\DegreeModule\app\Repositories\DegreeRepository;
use Modules\DepartmentModule\app\Repositories\DepartmentRepository;
use Modules\DoctorModule\app\Repositories\CityRepository;
use Modules\DoctorModule\app\Repositories\ZoneRepository;
use Modules\DoctorModule\app\Services\DoctorService;
use Illuminate\Support\Facades\Session;

class DoctorAdminController extends Controller {
    protected $doctorService;
    protected $cityRepository;
    protected $zoneRepository;
    protected $degreeRepository;
    protected $departmentRepository;

    public function __construct(
        DoctorService $doctorService,
        CityRepository $cityRepository,
        ZoneRepository $zoneRepository,
        DegreeRepository $degreeRepository,
        DepartmentRepository $departmentRepository
    ) {
        $this->doctorService = $doctorService;
        $this->cityRepository = $cityRepository;
        $this->zoneRepository = $zoneRepository;
        $this->degreeRepository = $degreeRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function index(Request $request) {
        $doctors = $this->doctorService->filter($request->all())->paginate(15);
        return view('doctormodule::admin.index', compact('doctors'));
    }

    public function show($id) {
        $doctor = $this->doctorService->findOne($id);
        return view('doctormodule::admin.show', compact('doctor'));
    }


    public function create() {
        $cities = $this->cityRepository->all();
        $degrees = $this->degreeRepository->all();
        $departments = $this->departmentRepository->all();

        return view('doctormodule::admin.create', compact('cities', 'degrees', 'departments'));
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
        $this->doctorService->create($request->all());
        return redirect()->route('admin.doctors')->with('success', 'The doctor has been created successfully!');
    }

    public function edit($id) {
        $doctor = $this->doctorService->findOne($id);
        $cities = $this->cityRepository->all();
        $degrees = $this->degreeRepository->all();
        $departments = $this->departmentRepository->all();
        $zones = $doctor->city_id
            ? $this->zoneRepository->findWhere(['city_id' => $doctor->city_id])
            : collect();

        return view('doctormodule::admin.edit', compact('doctor', 'cities', 'degrees', 'departments', 'zones'));
    }

    public function update(Request $request) {
        $doctor = $this->doctorService->findWhere(['id' => $request->id])->first();
        $validator = Validator::make(
            $request->all(),
            $this->validationRules($doctor->id),
            $this->validationMessages()
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->doctorService->update($request->all());
        return redirect()->route('admin.doctors')->with('success', 'The doctor has been updated successfully!');

    }

    public function destroy($id) {
        $this->doctorService->deleteDoctor($id);
        return redirect()->route('admin.doctors')->with('success', 'The doctor has been deleted successfully!');
    }

    /**
     * List every saved doctor and back-fill default SEO data
     * (meta title/description/tag = doctor name) for any that
     * don't have an SEO record yet.
     */
    public function applySeoToAll() {
        $updatedCount = $this->doctorService->applySeoToAllDoctors();

        return redirect()->route('admin.doctors')
            ->with('success', __('messages.seo_applied_to_doctors', ['count' => $updatedCount]));
    }

    /**
     * Zones belonging to a given city, for the city -> zone AJAX
     * cascading dropdown on the create/edit forms.
     */
    public function zonesByCity($cityId) {
        $zones = $this->zoneRepository->findWhere(['city_id' => $cityId]);

        return response()->json($zones);
    }

    private function validationRules($ignoreDoctorId = null) {
        $nameUniqueRule = 'unique:doctors,name' . ($ignoreDoctorId ? ',' . $ignoreDoctorId : '');

        return [
            'name' => "required|string|max:255|{$nameUniqueRule}",
            'degree_id' => 'required|integer|exists:degrees,id',
            'city_id' => 'required|integer|exists:cities,id',
            'zone_id' => 'required|integer|exists:zones,id',
            'address' => 'nullable|string',
            'address_latitude' => 'nullable|numeric',
            'address_longitude' => 'nullable|numeric',
            'address_map_zoom' => 'nullable|integer',
            'phone' => 'nullable|string|max:100',
            'mobile' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:200',
            'website' => 'nullable|string|max:200',
            'pic' => 'nullable|image|max:2048',
            'working_time' => 'nullable|string|max:255',
            'more_info' => 'nullable|string',
            'found_us' => 'nullable|string|max:255',
            'departments' => 'nullable|array',
            'departments.*' => 'integer|exists:departments,id',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'header_script' => 'nullable|string',
            'footer_script' => 'nullable|string',
        ];
    }

    private function validationMessages() {
        return [
            'name.required' => 'Please enter the name.',
            'name.unique' => 'This doctor name already exists. Please enter a different name.',
            'degree_id.required' => 'Please select the degree.',
            'city_id.required' => 'Please select the city.',
            'zone_id.required' => 'Please select the zone.',
        ];
    }
}
