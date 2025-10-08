<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::setScriptRoute(function ($handle) {
            return Route::get(config('app.url') . '/livewire/livewire.js', $handle);
        });
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post(
                parse_url(config('app.url'), PHP_URL_PATH) . '/livewire/update',
                $handle
            );
        });
    }
}
