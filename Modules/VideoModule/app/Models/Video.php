<?php

namespace Modules\VideoModule\app\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\SeoModule\App\Models\Seo;

class Video extends Model
{
    protected $guarded = [];

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
