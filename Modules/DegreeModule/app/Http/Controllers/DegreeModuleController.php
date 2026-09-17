<?php

namespace Modules\DegreeModule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DegreeModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('degreemodule::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('degreemodule::create');
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
        return view('degreemodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('degreemodule::edit');
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
