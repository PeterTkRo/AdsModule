<?php

namespace Ivvy\Ads\Loaders;

trait AutoLoader
{
    use AssetsLoader;
    use ConfigsLoader;
    use LanguagesLoader;
    use MigrationsLoader;
    use RoutesLoader;
    use ViewsLoader;

    /**
     * @return void
     */
    public function autoload()
    {
        $this->loadContainerAssets();
        $this->loadContainerConfigs();
        $this->loadContainerLanguages();
        $this->loadContainerMigrations();
        $this->loadContainerRoutes();
        $this->loadContainerViews();
    }
}