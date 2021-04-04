<?php

namespace Ivvy\Ads\Models;

use Illuminate\Database\Eloquent\Model;

class BannersI18N extends  Model
{
    const TABLE_NAME = 'banners_i18n';

    protected $table = self::TABLE_NAME;

    public function banner()
    {
        return $this->hasOne('App\Modules\BannersModule\Models\Banners', "id", "banner_id");
    }
}