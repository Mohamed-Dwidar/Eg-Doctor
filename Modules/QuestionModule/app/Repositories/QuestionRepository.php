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
}
