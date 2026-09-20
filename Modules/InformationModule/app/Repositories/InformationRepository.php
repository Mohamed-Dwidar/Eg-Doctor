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

    /**
     * A random sample of active informations, for the homepage's
     * "معلومات طبية" section.
     */
    function random($count)
    {
        return Information::with('seo')
            ->where('is_active', 1)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }
}
