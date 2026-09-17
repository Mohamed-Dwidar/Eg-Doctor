<?php

namespace Modules\BlogModule\Repository;

use Modules\BlogModule\Entities\Blog;
use Prettus\Repository\Eloquent\BaseRepository;


class BlogRepository extends BaseRepository
{
    function model()
    {
        return Blog::class;
    }
    function filter($request)
    {
        return Blog::filter($request);
    }
}
