<?php

namespace Modules\DoctorModule\app\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DegreeModule\app\Models\Degree;
use Modules\DepartmentModule\app\Models\Department;
use Modules\SeoModule\App\Models\Seo;

class Doctor extends Model
{
    protected $guarded = [];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seo_capable');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'doctor_departments', 'doctor_id', 'department_id');
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
