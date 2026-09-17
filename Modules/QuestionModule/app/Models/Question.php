<?php

namespace Modules\QuestionModule\app\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\SeoModule\App\Models\Seo;

class Question extends Model
{
    protected $guarded = [];

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seo_capable');
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class);
    }

    public function scopeFilter($query, $request)
    {
        $request_array = (!is_array($request)) ? collect($request)->toArray() : $request;
        if (isset($request_array['title']) && $request_array['title'] != '') {
            $query->where('title', 'like', '%' . $request_array['title'] . '%');
        }

        if (isset($request_array['question']) && $request_array['question'] != '') {
            $query->where('question', 'like', '%' . $request_array['question'] . '%');
        }

        if (isset($request_array['writer']) && $request_array['writer'] != '') {
            $query->where('writer', 'like', '%' . $request_array['writer'] . '%');
        }

        if (isset($request_array['email']) && $request_array['email'] != '') {
            $query->where('email', 'like', '%' . $request_array['email'] . '%');
        }

        return $query;
    }
}
