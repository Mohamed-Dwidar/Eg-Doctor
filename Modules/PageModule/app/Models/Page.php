<?php

namespace Modules\PageModule\app\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    public function getImagePathAttribute()
    {
        if ($this->image) {
            return asset('/uploads/pages/' . $this->image);
        } else {
            return asset('assets/front/img/defaults/page.svg');
        }
    }

   public function scopeFilter($query, $request)
    {
        $request_array = (!is_array($request)) ? collect($request)->toArray() : $request;
        if (isset($request_array['title']) && $request_array['title'] != '') {
            $query->where('title', 'like', '%' . $request_array['title'] . '%');
        }
        if (isset($request_array['is_active']) && $request_array['is_active'] != '') {
            $query->where('is_active', $request_array['is_active']);
        }

        return $query;
    }
}
