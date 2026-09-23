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

    /**
     * Published articles written by a specific doctor, for that
     * doctor's public profile page ("مقالات قد تهمك").
     */
    function forDoctor($doctorId, $count)
    {
        return Article::with(['seo', 'doctor'])
            ->where('status', 1)
            ->where('doctor_id', $doctorId)
            ->latest()
            ->limit($count)
            ->get();
    }

    /**
     * Every published article, newest first, for the public articles
     * listing page.
     */
    function publishedPaginated($perPage)
    {
        return Article::with(['seo', 'doctor'])
            ->where('status', 1)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Single article with SEO + doctor eager loaded, for the public
     * article detail page.
     */
    function findWithRelations($id)
    {
        return Article::with(['seo', 'doctor'])->find($id);
    }

    /**
     * A random sample of published articles other than the given one,
     * for the "related articles" areas of the article detail page.
     */
    function randomExcept($excludeId, $count)
    {
        return Article::with(['seo', 'doctor'])
            ->where('status', 1)
            ->where('id', '!=', $excludeId)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }
}
