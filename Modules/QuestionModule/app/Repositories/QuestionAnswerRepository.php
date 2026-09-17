<?php

namespace Modules\QuestionModule\app\Repositories;

use Modules\QuestionModule\app\Models\QuestionAnswer;
use Prettus\Repository\Eloquent\BaseRepository;

class QuestionAnswerRepository extends BaseRepository
{
    public function model()
    {
        return QuestionAnswer::class;
    }

    function filter($request)
    {
        return QuestionAnswer::filter($request);
    }
}
