<?php

namespace Modules\InformationModule\app\Repositories;

use Modules\InformationModule\app\Models\Information;
use Prettus\Repository\Eloquent\BaseRepository;

class InformationRepository extends BaseRepository
{

    public function model()
    {
        return Information::class;
    }

    function filter($request)
    {
        return Information::filter($request);
    }
}
