<?php

namespace Ivvy\Ads\Loaders;

use Illuminate\Support\Facades\File;

trait RoutesLoader
{
    /**
     * @var string|null
     */
    protected $name = null;

    /**
     * @var string|null
     */
    protected $prefix = true;

    /**
     * @var string|null
     */
    protected $directory = null;

    /**
     * @var string|null
     */
    protected $namespace = null;

    /**
     * @var boolean
     */
    protected $private = false;


    /**
     * @return void
     */
    protected function loadContainerRoutes()
    {
        $this->loadHttpRoutes("{$this->directory}/UI/API/Routes");
        $this->loadHttpRoutes("{$this->directory}/UI/Web/Routes");
    }

    /**
     * @param $directory
     * @return void
     */
    private function loadHttpRoutes($directory)
    {
        if (File::isDirectory($directory)) {
            $this->loadRoutesFrom($directory . '/routes.php');
        }
    }
}