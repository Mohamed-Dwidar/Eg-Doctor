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
}
