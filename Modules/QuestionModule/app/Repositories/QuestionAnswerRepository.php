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

    /**
     * A question's answers, newest first, for the public question
     * detail page.
     */
    function paginatedForQuestion($questionId, $perPage)
    {
        return QuestionAnswer::where('question_id', $questionId)
            ->orderByDesc('created')
            ->paginate($perPage);
    }
}
