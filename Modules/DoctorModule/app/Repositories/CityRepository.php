<?php

namespace Modules\DoctorModule\app\Repositories;

use Modules\DoctorModule\app\Models\City;
use Prettus\Repository\Eloquent\BaseRepository;

class CityRepository extends BaseRepository {

    public function model() {
        return City::class;
    }
}
