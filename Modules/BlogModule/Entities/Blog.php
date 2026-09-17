<?php

namespace Modules\BlogModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\SeoModule\App\Models\Seo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getNameAttribute()
    {
        $lang = config('app.locale') == 'ar' ? '_ar' : '_en';
        $lang = "_ar";
        return $this->attributes['name' . $lang];
    }

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seo_capable');
    }

    public function getDescriptionAttribute()
    {
        $lang = config('app.locale') == 'ar' ? '_ar' : '_en';
        $lang = "_ar";
        return $this->attributes['description' . $lang];
    }
    public function getImageFullPathAttribute()
    {
        if ($this->attributes['image']) {
            if (str_starts_with($this->attributes['image'], 'http') == 'true') {
                return $this->attributes['image'];
            } else {
                return asset('/uploads/blogs/' . $this->attributes['image']);
            }
        } else {
            return asset('admin_assets/assets/defaults/user.png');
        }
    }

    public function scopeFilter($query, $request)
    {
        $request_array = (!is_array($request)) ? collect($request)->toArray() : $request;


        if ( isset($request['top_Blog']) ) {
            $query->where('top_Blog', 1);
        }



        return $query;
    }
}
