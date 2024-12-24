<?php

namespace Deep\Blogs\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;

use Deep\Blogs\Http\Livewire\Admin\AddUpdateBlog;
use Deep\Blogs\Http\Livewire\Admin\AdminBlog;
use Deep\Blogs\Http\Livewire\Admin\AdminAuthor;
use Deep\Blogs\Http\Livewire\Admin\AdminBlogmeta;

use Deep\Blogs\Http\Livewire\Pages\BlogPage;
use Deep\Blogs\Http\Livewire\Pages\WriteForUs;

use Deep\Blogs\Http\Livewire\Parts\SingleBlogItem;
use Deep\Blogs\Http\Livewire\Parts\SingleBlogItemBlock;
use Deep\Blogs\Http\Livewire\Parts\SingleSidebar;
use Deep\Blogs\Http\Livewire\Parts\SuggestBlogs;
use Deep\Blogs\Http\Livewire\Parts\WriteForUsBlock;
use Deep\Blogs\Http\Livewire\Parts\VerticalBlogItem;
use Deep\Blogs\Http\Livewire\Parts\SmallBlogItem;
use Deep\Blogs\Http\Livewire\Parts\SmallBlogItemBlock;
use Deep\Blogs\Http\Livewire\Parts\QuarterBlogItem;
use Deep\Blogs\Http\Livewire\Parts\HorizontalBlogItem;

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

        Livewire::component('addUpdateBlog', AddUpdateBlog::class);
        Livewire::component('adminBlog', AdminBlog::class);
        Livewire::component('adminBlogmeta', AdminBlogmeta::class);
        Livewire::component('adminAuthor', AdminAuthor::class);

        Livewire::component('blogPage', BlogPage::class);
        Livewire::component('writeForUs', WriteForUs::class);

        Livewire::component('singleBlogItem', SingleBlogItem::class);
        Livewire::component('singleBlogItemBlock', SingleBlogItemBlock::class);
        Livewire::component('singleSidebar', SingleSidebar::class);
        Livewire::component('suggestBlogs', SuggestBlogs::class);
        Livewire::component('writeForUsBlock', WriteForUsBlock::class);
        Livewire::component('verticalBlogItem', VerticalBlogItem::class);
        Livewire::component('smallBlogItem', SmallBlogItem::class);
        Livewire::component('quarterBlogItem', QuarterBlogItem::class);
        Livewire::component('horizontalBlogItem', HorizontalBlogItem::class);
    }
}