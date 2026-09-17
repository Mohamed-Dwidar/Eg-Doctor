<?php

namespace Modules\QuestionModule\app\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model {
    protected $guarded = [];

    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function scopeFilter($query, $request) {
        $request_array = (!is_array($request)) ? collect($request)->toArray() : $request;

        if (isset($request_array['question_id']) && $request_array['question_id'] != '') {
            $query->where('question_id', $request_array['question_id']);
        }

        if (isset($request_array['answer']) && $request_array['answer'] != '') {
            $query->where('answer', 'like', '%' . $request_array['answer'] . '%');
        }

        if (isset($request_array['writer']) && $request_array['writer'] != '') {
            $query->where('writer', 'like', '%' . $request_array['writer'] . '%');
        }

        return $query;
    }
}
