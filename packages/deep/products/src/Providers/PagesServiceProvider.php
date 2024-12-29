<?php

namespace Deep\Products\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

use Deep\Products\Http\Livewire\Admin\AdminProduct;

use Deep\Products\Http\Livewire\Pages\ProductPage;
use Deep\Products\Http\Livewire\Pages\Form;

use Deep\Products\Http\Livewire\Parts\SingleProductItem;
use Deep\Products\Http\Livewire\Parts\SingleProductItemBlock;
use Deep\Products\Http\Livewire\Parts\SingleSidebar;
use Deep\Products\Http\Livewire\Parts\SuggestProducts;
use Deep\Products\Http\Livewire\Parts\WriteForUsBlock;
use Deep\Products\Http\Livewire\Parts\VerticalProductItem;
use Deep\Products\Http\Livewire\Parts\SmallProductItem;
use Deep\Products\Http\Livewire\Parts\SmallProductItemBlock;
use Deep\Products\Http\Livewire\Parts\QuarterProductItem;
use Deep\Products\Http\Livewire\Parts\HorizontalProductItem;

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

        // Livewire::component('addUpdateProduct', AddUpdateProduct::class);
        Livewire::component('adminProduct', AdminProduct::class);

        Livewire::component('productPage', ProductPage::class);
        Livewire::component('writeForUs', WriteForUs::class);

        Livewire::component('singleProductItem', SingleProductItem::class);
        Livewire::component('singleProductItemBlock', SingleProductItemBlock::class);
        Livewire::component('singleSidebar', SingleSidebar::class);
        Livewire::component('suggestProducts', SuggestProducts::class);
        Livewire::component('writeForUsBlock', WriteForUsBlock::class);
        Livewire::component('verticalProductItem', VerticalProductItem::class);
        Livewire::component('smallProductItem', SmallProductItem::class);
        Livewire::component('quarterProductItem', QuarterProductItem::class);
        Livewire::component('horizontalProductItem', HorizontalProductItem::class);
        Livewire::component('form', Form::class);
    }
}