<?php

namespace Modules\DepartmentModule\app\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DoctorModule\app\Models\Doctor;
use Modules\SeoModule\App\Models\Seo;

class Department extends Model
{
    protected $guarded = [];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seo_capable');
    }

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_departments', 'department_id', 'doctor_id');
    }

    public function scopeFilter($query, $request)
    {
        $request_array = (!is_array($request)) ? collect($request)->toArray() : $request;
        if (isset($request_array['name']) && $request_array['name'] != '') {
            $query->where('name', 'like', '%' . $request_array['name'] . '%');
        }

        return $query;
    }
}
