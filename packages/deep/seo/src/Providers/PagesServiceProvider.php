<?php

namespace Deep\Seo\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

use Deep\Seo\Http\Livewire\Seo\AdminMeta;
use Deep\Seo\Http\Livewire\Seo\AdminSitemap;

use Deep\Seo\Http\Livewire\Schema\BlogSchema;
use Deep\Seo\Http\Livewire\Schema\PageSchema;
use Deep\Seo\Http\Livewire\Schema\ProductSchema;

use Deep\Seo\Http\Livewire\Seo\UploadMeta;
use Deep\Seo\Http\Livewire\Seo\AdminPageScan;

class PagesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(){
        $this->mergeConfigFrom( __DIR__.'/../../config/deep.php', 'deep' );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(){
        $this->publishes([ __DIR__.'/../../config/deep.php' => config_path('deep.php'), ], 'config');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'deep');
        $this->publishes([ __DIR__.'/../../resources/views' => resource_path('views/vendor/deep'), ], 'views');

        Livewire::component('adminMeta', AdminMeta::class);
        Livewire::component('adminSitemap', AdminSitemap::class);
        Livewire::component('uploadMeta', UploadMeta::class);
        Livewire::component('adminPageScan', AdminPageScan::class);

        Livewire::component('blogSchema', BlogSchema::class);
        Livewire::component('pageSchema', PageSchema::class);
        Livewire::component('productSchema', ProductSchema::class);
    }
}