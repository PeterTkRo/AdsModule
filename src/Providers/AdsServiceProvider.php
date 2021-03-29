<?php

namespace Ivvy\Ads\Providers;

use Illuminate\Support\ServiceProvider;
use Ivvy\Ads\Loaders\AutoLoader;

class AdsServiceProvider extends ServiceProvider
{
    use AutoLoader;

    /**
     * @return void
     */
    public function boot()
    {
        $this->autoload();
    }
}