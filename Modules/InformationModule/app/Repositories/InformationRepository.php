<?php

namespace Modules\InformationModule\app\Repositories;

use Modules\InformationModule\app\Models\Information;
use Prettus\Repository\Eloquent\BaseRepository;

class InformationRepository extends BaseRepository
{

    public function model()
    {
        return Information::class;
    }

    function filter($request)
    {
        return Information::filter($request);
    }

    /**
     * A random sample of active informations, for the homepage's
     * "معلومات طبية" section.
     */
    function random($count)
    {
        return Information::with('seo')
            ->where('is_active', 1)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }

    /**
     * Every active information entry, newest first, for the public
     * quick-info listing page.
     */
    function publishedPaginated($perPage)
    {
        return Information::with('seo')
            ->where('is_active', 1)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Single information entry with SEO eager loaded, for the public
     * detail page.
     */
    function findWithRelations($id)
    {
        return Information::with('seo')->find($id);
    }

    /**
     * A random sample of active informations other than the given
     * one, for the "related" areas of the detail page.
     */
    function randomExcept($excludeId, $count)
    {
        return Information::with('seo')
            ->where('is_active', 1)
            ->where('id', '!=', $excludeId)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }
}
