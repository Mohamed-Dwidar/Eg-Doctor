<?php

namespace Modules\PageModule\app\Repositories;

use Modules\PageModule\app\Models\Page;
use Prettus\Repository\Eloquent\BaseRepository;
use Modules\PageModule\app\Models\PageTag;

class PageRepository extends BaseRepository
{

    public function model()
    {
        return Page::class;
    }

    static function getTopParents($not_id = 0)
    {
        $query = Page::where('parent_id', 0)
            ->where('is_active', 1);
        if ($not_id > 0) {
            $query->where('id', '!=', $not_id);
        }
        return $query->limit(100)->get();
    }

    function getRandom($rand)
    {
        return Page::get()->random($rand);
    }

    function getPagesTree($parent_id = 0, $spacing = '', $tree_array = array())
    {
        $pages = Page::where('parent_id', '=', $parent_id)->orderBy('parent_id')->get();
        foreach ($pages as $item) {
            $item->name = ' ' . $spacing . ' ' . $item->name;
            $tree_array[] = $item;

            //$tree_array[] = ['pageId' => $item->id, 'pageName' =>$spacing . $item->name] ;
            $tree_array = $this->getPagesTree($item->id, $spacing . ' - ', $tree_array);
        }
        return $tree_array;
    }

    static function getSubPages($parent_id = 0, $without_id = null)
    {
        $query = Page::where('parent_id', $parent_id);
        if ($without_id) {
            $query->where('id', '<>', $without_id);
        }

        return $query->get();
    }

    public function getExtraPages($extra_page_ids)
    {
        $query = Page::whereIn('id', $extra_page_ids);
        return $query->get();
    }

    function filter($request)
    {
        return Page::filter($request);
    }
}
