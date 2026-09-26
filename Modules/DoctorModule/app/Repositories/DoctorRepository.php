<?php

namespace Modules\DoctorModule\app\Repositories;

use Modules\DoctorModule\app\Models\Doctor;
use Prettus\Repository\Eloquent\BaseRepository;

class DoctorRepository extends BaseRepository
{

    public function model()
    {
        return Doctor::class;
    }

    function filter($request)
    {
        return Doctor::filter($request);
    }

    /**
     * A random sample of doctors, with the relations the "Featured
     * Doctors" homepage section needs already eager loaded.
     */
    function random($count)
    {
        return Doctor::with(['degree', 'city', 'zone', 'departments', 'seo'])
            ->where('more_info', '!=', "")
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }

    /**
     * Single doctor with the relations the public profile page needs
     * already eager loaded.
     */
    function findWithRelations($id)
    {
        return Doctor::with(['degree', 'city', 'zone', 'departments.seo', 'seo'])->find($id);
    }

    /**
     * Paginated doctors matching the public search form filters
     * (specialty / governorate / area / doctor_name), applied via
     * Doctor::scopeFilter.
     */
    function search($request, $perPage = 10)
    {
        return Doctor::filter($request)
            ->with(['degree', 'city', 'zone', 'departments', 'seo'])
            ->orderByDesc('id')
            ->paginate($perPage);
    }
}
