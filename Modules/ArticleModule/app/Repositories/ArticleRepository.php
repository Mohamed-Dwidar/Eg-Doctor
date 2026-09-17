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
}
