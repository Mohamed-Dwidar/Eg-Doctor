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
}
