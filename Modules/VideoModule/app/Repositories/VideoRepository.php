<?php

namespace Modules\VideoModule\app\Repositories;

use Modules\VideoModule\app\Models\Video;
use Prettus\Repository\Eloquent\BaseRepository;

class VideoRepository extends BaseRepository
{

    public function model()
    {
        return Video::class;
    }

    function filter($request)
    {
        return Video::filter($request);
    }

    /**
     * A random sample of active videos, for the homepage's
     * "أحدث المقالات الطبية" section.
     */
    function random($count)
    {
        return Video::with('seo')
            ->where('is_active', 1)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }

    /**
     * Every active video, newest first, for the public videos
     * listing page.
     */
    function publishedPaginated($perPage)
    {
        return Video::with('seo')
            ->where('is_active', 1)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Single video with SEO eager loaded, for the public video
     * detail page.
     */
    function findWithRelations($id)
    {
        return Video::with('seo')->find($id);
    }

    /**
     * A random sample of active videos other than the given one,
     * for the "related videos" areas of the video detail page.
     */
    function randomExcept($excludeId, $count)
    {
        return Video::with('seo')
            ->where('is_active', 1)
            ->where('id', '!=', $excludeId)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }
}
