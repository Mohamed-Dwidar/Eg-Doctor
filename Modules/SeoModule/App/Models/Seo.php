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
}
