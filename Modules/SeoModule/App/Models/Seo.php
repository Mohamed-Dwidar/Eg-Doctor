<?php

namespace Modules\SeoModule\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\SeoModule\Database\factories\SeoFactory;

class Seo extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = [];

    protected static function newFactory(): SeoFactory
    {
        //return SeoFactory::new();
    }

    public function seo_capable()
    {
        return $this->morphTo();
    }

    /**
     * Manually-created entries that aren't tied to any real content
     * record — just a slug that redirects to a fixed target_path
     * (e.g. "terms" => "pages/2").
     */
    public function scopeManual($query)
    {
        return $query->whereNull('seo_capable_type');
    }
}
