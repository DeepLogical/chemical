<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Deep\Seo\Models\Meta;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // view()->share('meta', Meta::metatag());
    }
}
