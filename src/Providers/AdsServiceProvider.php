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

    /**
     * @param $name
     * @param $directory
     * @param $namespace
     */
    public function container($name, $directory, $namespace)
    {
        $this->name = $name;
        $this->directory = $directory;
        $this->namespace = $namespace;
    }
}