<?php

namespace Modules\DegreeModule\app\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function scopeFilter($query, $request)
    {
        $request_array = (!is_array($request)) ? collect($request)->toArray() : $request;
        if (isset($request_array['name']) && $request_array['name'] != '') {
            $query->where('name', 'like', '%' . $request_array['name'] . '%');
        }

        return $query;
    }
}
