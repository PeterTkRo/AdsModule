<?php

namespace Ivvy\Ads\Loaders;

trait ViewsLoader
{
    /**
     * @var string|null
     */
    protected $name = null;

    /**
     * @var string|null
     */
    protected $directory = null;

    /**
     * @return void
     */
    protected function loadContainerViews()
    {
        $this->loadViewsFrom("{$this->directory}/UI/Web/Views", $this->name);
    }
}