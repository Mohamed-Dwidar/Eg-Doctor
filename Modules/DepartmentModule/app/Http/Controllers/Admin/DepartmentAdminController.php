<?php

namespace Modules\DepartmentModule\app\Http\Controllers\Admin;

use App\Helpers\ApiResponseHelper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\DepartmentModule\app\Services\DepartmentService;
use Illuminate\Support\Facades\Session;

class DepartmentAdminController extends Controller {
    protected $departmentService;

    public function __construct(DepartmentService $departmentService) {
        $this->departmentService = $departmentService;
    }

    public function index(Request $request) {
        $departments = $this->departmentService->filter($request->all())->paginate(15);
        return view('departmentmodule::admin.index', compact('departments'));
    }

    public function show($id) {
        $department = $this->departmentService->findOne($id);
        return view('departmentmodule::admin.show', compact('department'));
    }


    public function create() {
        return view('departmentmodule::admin.create');
    }

    public function store(Request $request) {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255|unique:departments',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_tag' => 'nullable|string',
                'header_script' => 'nullable|string',
                'footer_script' => 'nullable|string',
            ],
            [
                'name.required' => 'Please enter the name.',
                'name.unique' => 'This department name already exists. Please enter a different name.',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->departmentService->create($request->all());
        return redirect()->route('admin.departments')->with('success', 'The department has been created successfully!');
    }

    public function edit($id) {
        $department = $this->departmentService->findOne($id);
        return view('departmentmodule::admin.edit', compact('department'));
    }

    public function update(Request $request) {
        $department = $this->departmentService->findWhere(['id' => $request->id])->first();
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_tag' => 'nullable|string',
                'header_script' => 'nullable|string',
                'footer_script' => 'nullable|string',
            ],
            [
                'name.required' => 'Please enter the name.',
                'name.unique' => 'This department name already exists. Please enter a different name.',
            ]
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->departmentService->update($request->all());
        return redirect()->route('admin.departments')->with('success', 'The department has been updated successfully!');

    }

    public function destroy($id) {
        $this->departmentService->deleteDepartment($id);
        return redirect()->route('admin.departments')->with('success', 'The department has been deleted successfully!');
    }

    /**
     * List every saved department and back-fill default SEO data
     * (meta title/description/tag = department name) for any that
     * don't have an SEO record yet.
     */
    public function applySeoToAll() {
        $updatedCount = $this->departmentService->applySeoToAllDepartments();

        return redirect()->route('admin.departments')
            ->with('success', __('messages.seo_applied_to_departments', ['count' => $updatedCount]));
    }
}
