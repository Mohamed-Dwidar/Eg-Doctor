<?php

namespace Modules\DoctorModule\app\Repositories;

use Modules\DoctorModule\app\Models\DoctorDepartment;
use Prettus\Repository\Eloquent\BaseRepository;

class DoctorDepartmentRepository extends BaseRepository
{

    public function model()
    {
        return DoctorDepartment::class;
    }
}
