<?php

namespace Modules\DoctorModule\app\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DepartmentModule\app\Models\Department;

class DoctorDepartment extends Model {
    protected $guarded = [];
    protected $table = 'doctor_departments';
    public $timestamps = false;

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function doctor() {
        return $this->belongsTo(Doctor::class);
    }
}
