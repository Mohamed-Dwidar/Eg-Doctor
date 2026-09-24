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

    /**
     * Every question, newest first, for the public questions listing
     * page.
     */
    function paginatedLatest($perPage)
    {
        return Question::with('seo')
            ->withCount('answers')
            ->orderByDesc('created_at')
            ->paginate($perPage);
    }

    /**
     * Single question with SEO eager loaded, for the public question
     * detail page.
     */
    function findWithSeo($id)
    {
        return Question::with('seo')->withCount('answers')->find($id);
    }

    /**
     * A random sample of other questions, for the question detail
     * page's "استشارات طبية أخرى" section.
     */
    function randomExcept($excludeIds, $count)
    {
        return Question::with('seo')
            ->withCount('answers')
            ->whereNotIn('id', (array) $excludeIds)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }
}
