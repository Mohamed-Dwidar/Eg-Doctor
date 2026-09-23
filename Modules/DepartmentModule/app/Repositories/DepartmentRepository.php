<?php

namespace Modules\DepartmentModule\app\Repositories;

use Modules\DepartmentModule\app\Models\Department;
use Prettus\Repository\Eloquent\BaseRepository;

class DepartmentRepository extends BaseRepository
{

    public function model()
    {
        return Department::class;
    }

    function filter($request)
    {
        return Department::filter($request);
    }

    /**
     * Every department, alphabetically, with SEO eager loaded — for
     * the public "all specialties" listing page.
     */
    function allSorted()
    {
        return Department::with('seo')->orderBy('name')->get();
    }

    /**
     * Single department with SEO eager loaded, for the public
     * department page (doctor listing per specialty).
     */
    function findWithSeo($id)
    {
        return Department::with('seo')->find($id);
    }
}
