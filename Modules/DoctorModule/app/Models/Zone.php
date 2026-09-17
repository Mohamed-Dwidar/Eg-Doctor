<?php

namespace Modules\DoctorModule\app\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {
    protected $guarded = [];
    protected $table = 'zones';

    public function city() {
        return $this->belongsTo(City::class);
    }
}
