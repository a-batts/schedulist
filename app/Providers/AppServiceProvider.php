<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Filament;
use Illuminate\Support\Facades\Cookie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
          $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
          $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $theme = \Cookie::get('theme');
            if ($theme != 'dark' && $theme != 'light') {
                $theme = 'auto';
            }

            $view->with('theme', $theme);
        });

        Filament::serving(function () {
            Filament::registerStyle('style', asset('css/filament.css'));
        });

        date_default_timezone_set('America/New_York');

    }
}
