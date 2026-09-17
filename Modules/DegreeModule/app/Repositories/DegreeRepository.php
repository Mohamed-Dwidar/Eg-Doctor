<?php

namespace Modules\DegreeModule\app\Repositories;

use Modules\DegreeModule\app\Models\Degree;
use Prettus\Repository\Eloquent\BaseRepository;

class DegreeRepository extends BaseRepository
{

    public function model()
    {
        return Degree::class;
    }

    function filter($request)
    {
        return Degree::filter($request);
    }
}
