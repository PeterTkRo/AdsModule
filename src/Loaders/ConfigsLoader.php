<?php

namespace Ivvy\Ads\Loaders;

use Illuminate\Support\Facades\File;

trait ConfigsLoader
{
    /**
     * @var string|null
     */
    protected $directory = null;

    /**
     * @return void
     */
    protected function loadContainerConfigs()
    {
        $this->loadConfigs("{$this->directory}/../config");
    }

    /**
     * @param $directory
     * @return void
     */
    protected function loadConfigs($directory)
    {
        if (File::isDirectory($directory)) {
            $files = File::allFiles($directory);

            foreach ($files as $file) {
                $this->mergeConfigFrom($file->getPathname(), pathinfo($file->getFilename(), PATHINFO_FILENAME));
            }
        }
    }
}
