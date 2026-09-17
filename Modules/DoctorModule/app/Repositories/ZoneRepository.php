<?php

namespace Modules\DoctorModule\app\Repositories;

use Modules\DoctorModule\app\Models\Zone;
use Prettus\Repository\Eloquent\BaseRepository;

class ZoneRepository extends BaseRepository {

    public function model() {
        return Zone::class;
    }
}
