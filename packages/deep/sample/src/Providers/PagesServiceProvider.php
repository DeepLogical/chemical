<?php

namespace Deep\Sample\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

// use Deep\Sample\Http\Livewire\Admin\AddUpdateBlog;

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

        // Livewire::component('addUpdateBlog', AddUpdateBlog::class);
    }
}