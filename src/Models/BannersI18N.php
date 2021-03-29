<?php

namespace App\Modules\BannersModule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class BannersI18N extends  Model
{
    const TABLE_NAME = 'banners_i18n';

    protected $table = self::TABLE_NAME;

    public function banner()
    {
        return $this->hasOne('App\Modules\BannersModule\Models\Banners', "id", "banner_id");
    }
}