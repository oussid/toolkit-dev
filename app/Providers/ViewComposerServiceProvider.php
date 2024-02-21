<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        view()->composer('*', function ($view) {
            $url = $_SERVER['REQUEST_URI'];
            $urlParts = explode('/', $url);
            $ParentPageName = "dashboard";
            if($urlParts[1]){
                $ParentPageName = $urlParts[1];
            }
            $view->with('ParentPageName', $ParentPageName);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
