<?php

namespace Modules\ArticleModule\app\Repositories;

use Modules\ArticleModule\app\Models\Article;
use Prettus\Repository\Eloquent\BaseRepository;

class ArticleRepository extends BaseRepository
{

    public function model()
    {
        return Article::class;
    }

    function filter($request)
    {
        return Article::filter($request);
    }

    /**
     * A random sample of published articles, for the homepage's
     * "أحدث المقالات الطبية" section.
     */
    function random($count)
    {
        return Article::with(['seo', 'doctor'])
            ->where('status', 1)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }
}
