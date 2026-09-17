<?php

namespace Modules\DegreeModule\app\Http\Controllers\Admin;

use App\Helpers\ApiResponseHelper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\DegreeModule\app\Services\DegreeService;
use Illuminate\Support\Facades\Session;

class DegreeAdminController extends Controller
{
    protected $degreeService;

    public function __construct(DegreeService $degreeService)
    {
        $this->degreeService = $degreeService;
    }

    public function index(Request $request)
    {
        $degrees = $this->degreeService->filter($request->all())->paginate(15);
        return view('degreemodule::admin.index', compact('degrees'));
    }

    public function show($id)
    {
        $degree = $this->degreeService->findOne($id);
        return view('degreemodule::admin.show', compact('degree'));
    }


    public function create()
    {
        return view('degreemodule::admin.create');
    }

    public function store(Request $request)
    {
        // Define Validation Rules
        $validationRules = [
            'name' => 'required|string|max:255|unique:degrees'
        ];

        $messages = [
            'name.required' => 'Please enter the name.',
            'name.unique' => 'This degree name already exists. Please enter a different name.',
        ];

        // Validate Data
        $validatedData = $request->validate($validationRules, $messages);

        try {
            // Save degree data
            $degree = $this->degreeService->create($request->all())->paginate(15);

            return redirect()->route('admin.degrees')->with('success', 'The degree has been created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the degree.'])->withInput();
        }
    }

    public function edit($id)
    {
        $degree = $this->degreeService->findOne($id);
        return view('degreemodule::admin.edit', compact('degree'));
    }

    public function update(Request $request)
    {
        $degree = $this->degreeService->findWhere(['id' => $request->id])->first();

        $messages = [
            'name.required' => 'Please enter the name.',
            'name.unique' => 'This degree name already exists. Please enter a different name.'
        ];

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:degrees,name,' . $request->id
        ], $messages);

        try {
            $degree = $this->degreeService->update($request->all());
            return redirect()->route('admin.degrees')->with('success', 'The degree has been updated successfully');
        } catch (\Exception $e) {

            \Log::error('Error updating degree: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while creating the degree.'])->withInput();
        }
    }

    public function destroy($id)
    {
        $this->degreeService->deleteDegree($id);
        return redirect()->route('admin.degrees')->with('success', 'The degree has been deleted successfully!');
    }
}
