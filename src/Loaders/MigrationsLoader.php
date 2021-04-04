<?php

namespace Ivvy\Ads\Loaders;

use Illuminate\Support\Facades\File;

trait MigrationsLoader
{
    /**
     * @var string|null
     */
    protected $directory = null;

    /**
     * @return void
     */
    protected function loadContainerMigrations()
    {
        $this->loadMigrations("{$this->directory}/Database/Migrations");
    }

    /**
     * @param $directory
     */
    protected function loadMigrations($directory)
    {
        if (File::isDirectory($directory)) {
            $this->loadMigrationsFrom($directory);
        }
    }
}