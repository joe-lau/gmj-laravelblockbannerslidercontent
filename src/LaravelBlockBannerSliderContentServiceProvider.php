<?php

namespace GMJ\LaravelBlockBannerSliderContent;

use GMJ\LaravelBlockBannerSliderContent\View\Components\Frontend;
use Illuminate\Support\ServiceProvider;

class LaravelBlockBannerSliderContentServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/gmj.php', 'gmj');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . "/routes/web.php", 'laravelblockbannerslidercontent');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'laravelblockbannerslidercontent');
        $this->loadViewComponentsAs('laravelblockbannerslidercontent', [
            Frontend::class
        ]);

        $this->publishes([
            __DIR__ . '/config/gmj.php' => config_path('gmj.php'),
            __DIR__ . '/resources/assets' => public_path('gmj'),
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'GMJ\LaravelBlockBannerSliderContent');
    }


    public function register()
    {
    }
}
