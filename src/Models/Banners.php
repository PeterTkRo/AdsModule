<?php

namespace Ivvy\Ads\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\App;

class Banners extends  Model
{
    const TABLE_NAME = 'banners';

    const CATEGORY_BANNER_TYPE = 1;
    const PRODUCT_BANNER_TYPE = 2;

    protected $table = self::TABLE_NAME;

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * @return HasOne
     */
    public function bannersI18N()
    {
        return $this->hasOne('App\Modules\BannersModule\Models\BannersI18N', "banner_id")->where('local', '=', App::getLocale());
    }

    /**
     * @param $language
     * @return Model|HasOne|object|null
     */
    public function langBannersI18N($language)
    {
        return $this->hasOne('App\Modules\BannersModule\Models\BannersI18N', "banner_id")->where('local', $language)->first();
    }
}