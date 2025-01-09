<?php

namespace Deep\Products\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

use Deep\Products\Http\Livewire\Admin\AdminProductmeta;
use Deep\Products\Http\Livewire\Admin\AdminProduct;
use Deep\Products\Http\Livewire\Admin\AddUpdateProduct;

use Deep\Products\Http\Livewire\Pages\ProductListing;
use Deep\Products\Http\Livewire\Pages\ProductSingle;
use Deep\Products\Http\Livewire\Pages\Form;


use Deep\Products\Http\Livewire\Parts\ProductSidebar;
use Deep\Products\Http\Livewire\Parts\SuggestProduct;

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


        Livewire::component('adminProductmeta', AdminProductmeta::class);
        Livewire::component('adminProductSpecial', AdminProductSpecial::class);
        Livewire::component('adminProduct', AdminProduct::class);
        Livewire::component('adminInstructor', AdminInstructor::class);
        Livewire::component('addUpdateProduct', AddUpdateProduct::class);
        Livewire::component('productListing', ProductListing::class);
        Livewire::component('productSingle', ProductSingle::class);
        Livewire::component('productSidebar', ProductSidebar::class);
        Livewire::component('suggestProduct', SuggestProduct::class);
        Livewire::component('form', Form::class);
        // Livewire::component('addUpdateProduct', AddUpdateProduct::class);
    }
}