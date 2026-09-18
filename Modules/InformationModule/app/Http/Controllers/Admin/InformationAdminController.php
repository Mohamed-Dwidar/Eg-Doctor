<?php

namespace Modules\InformationModule\app\Http\Controllers\Admin;

use App\Helpers\ApiResponseHelper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\InformationModule\app\Services\InformationService;
use Illuminate\Support\Facades\Session;

class InformationAdminController extends Controller {
    protected $informationService;

    public function __construct(InformationService $informationService) {
        $this->informationService = $informationService;
    }

    public function index(Request $request) {
        $informations = $this->informationService->filter($request->all())->paginate(15);
        return view('informationmodule::admin.index', compact('informations'));
    }

    public function show($id) {
        $information = $this->informationService->findOne($id);
        return view('informationmodule::admin.show', compact('information'));
    }


    public function create() {
        return view('informationmodule::admin.create');
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
        $this->informationService->create($request->all());
        return redirect()->route('admin.informations')->with('success', 'The information has been created successfully!');
    }

    public function edit($id) {
        $information = $this->informationService->findOne($id);
        return view('informationmodule::admin.edit', compact('information'));
    }

    public function update(Request $request) {
        $information = $this->informationService->findWhere(['id' => $request->id])->first();
        $validator = Validator::make(
            $request->all(),
            $this->validationRules($information->id),
            $this->validationMessages()
        );

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->informationService->update($request->all());
        return redirect()->route('admin.informations')->with('success', 'The information has been updated successfully!');

    }

    public function destroy($id) {
        $this->informationService->deleteInformation($id);
        return redirect()->route('admin.informations')->with('success', 'The information has been deleted successfully!');
    }

    /**
     * List every saved information and back-fill default SEO data
     * (meta title/description/tag = information title) for any that
     * don't have an SEO record yet.
     */
    public function applySeoToAll() {
        $updatedCount = $this->informationService->applySeoToAllInformations();

        return redirect()->route('admin.informations')
            ->with('success', __('messages.seo_applied_to_informations', ['count' => $updatedCount]));
    }

    private function validationRules($ignoreInformationId = null) {
        $titleUniqueRule = 'unique:informations,title' . ($ignoreInformationId ? ',' . $ignoreInformationId : '');

        return [
            'title' => "required|string|max:255|{$titleUniqueRule}",
            'content' => 'required|string',
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
            'title.unique' => 'This information title already exists. Please enter a different title.',
            'content.required' => 'Please enter the content.',
        ];
    }
}
