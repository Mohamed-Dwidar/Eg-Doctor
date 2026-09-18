<?php

namespace Modules\InformationModule\app\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\SeoModule\App\Models\Seo;

class Information extends Model
{
    protected $guarded = [];
    protected $table = 'informations';

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seo_capable');
    }

    public function scopeFilter($query, $request)
    {
        $request_array = (!is_array($request)) ? collect($request)->toArray() : $request;
        if (isset($request_array['title']) && $request_array['title'] != '') {
            $query->where('title', 'like', '%' . $request_array['title'] . '%');
        }

        return $query;
    }
}
