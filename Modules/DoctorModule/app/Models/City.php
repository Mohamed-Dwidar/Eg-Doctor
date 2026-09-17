<?php

namespace Modules\DoctorModule\app\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model {
    protected $guarded = [];
    protected $table = 'cities';
    public $timestamps = false;

    public function zones() {
        return $this->hasMany(Zone::class);
    }
}
