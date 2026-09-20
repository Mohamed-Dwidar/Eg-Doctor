<?php

namespace Modules\SeoModule\App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\SeoModule\App\Models\Seo;

class SeoAdminController extends Controller {
    /**
     * List manually-created SEO entries only — records tied to a
     * real content type (Department, Doctor, ...) are managed from
     * that content type's own edit page, not here.
     */
    public function index(Request $request) {
        $seos = Seo::manual()
            ->when($request->filled('slug'), function ($query) use ($request) {
                $query->where('slug', 'like', '%' . $request->slug . '%');
            })
            ->latest('id')
            ->paginate(15);

        return view('seomodule::admin.manual.index', compact('seos'));
    }

    public function create() {
        return view('seomodule::admin.manual.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), $this->validationRules(), $this->validationMessages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Seo::create($this->extractData($request));

        return redirect()->route('admin.seo.manual')->with('success', 'The SEO entry has been created successfully!');
    }

    public function edit($id) {
        $seo = Seo::manual()->findOrFail($id);
        return view('seomodule::admin.manual.edit', compact('seo'));
    }

    public function update(Request $request) {
        $seo = Seo::manual()->findOrFail($request->id);

        $validator = Validator::make($request->all(), $this->validationRules($seo->id), $this->validationMessages());

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $seo->update($this->extractData($request));

        return redirect()->route('admin.seo.manual')->with('success', 'The SEO entry has been updated successfully!');
    }

    public function destroy($id) {
        Seo::manual()->findOrFail($id)->delete();

        return redirect()->route('admin.seo.manual')->with('success', 'The SEO entry has been deleted successfully!');
    }

    /**
     * seo_capable_type/seo_capable_id are deliberately left out here
     * (and therefore null) — that's what marks a row as manual.
     */
    private function extractData(Request $request) {
        return [
            'slug' => ltrim($request->slug, '/'),
            'target_path' => ltrim($request->target_path, '/'),
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_tag' => $request->meta_tag,
            'header_script' => $request->header_script,
            'footer_script' => $request->footer_script,
        ];
    }

    private function validationRules($ignoreId = null) {
        $slugUniqueRule = 'unique:seos,slug' . ($ignoreId ? ',' . $ignoreId : '');

        return [
            'slug' => "required|string|max:255|{$slugUniqueRule}",
            'target_path' => 'required|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_tag' => 'nullable|string',
            'header_script' => 'nullable|string',
            'footer_script' => 'nullable|string',
        ];
    }

    private function validationMessages() {
        return [
            'slug.required' => 'Please enter the slug.',
            'slug.unique' => 'This slug is already in use.',
            'target_path.required' => 'Please enter the target path.',
        ];
    }
}
