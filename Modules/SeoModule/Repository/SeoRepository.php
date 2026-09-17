<?php

namespace Modules\SeoModule\Repository;

use Modules\SeoModule\Entities\Seo;
use Prettus\Repository\Eloquent\BaseRepository;


class SeoRepository extends BaseRepository
{
    function model()
    {
        return Seo::class;
    }
    
}
