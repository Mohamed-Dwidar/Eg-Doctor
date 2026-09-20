<?php

namespace Modules\QuestionModule\app\Repositories;

use Modules\QuestionModule\app\Models\Question;
use Prettus\Repository\Eloquent\BaseRepository;

class QuestionRepository extends BaseRepository
{

    public function model()
    {
        return Question::class;
    }

    function filter($request)
    {
        return Question::filter($request);
    }

    /**
     * The most recently asked questions, for the homepage's
     * "الاستشارات الطبية" section.
     */
    function latest($count)
    {
        return Question::with('seo')
            ->withCount('answers')
            ->orderByDesc('created_at')
            ->limit($count)
            ->get();
    }
}
