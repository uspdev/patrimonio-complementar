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
        $path = parse_url(config('app.url'), PHP_URL_PATH);
        if ($path && $path !== '/') {
            $path = rtrim($path, '/');

            Livewire::setScriptRoute(function ($handle) use ($path) {
                return Route::get($path . '/livewire/livewire.js', $handle);
            });

            Livewire::setUpdateRoute(function ($handle) use ($path) {
                return Route::post($path . '/livewire/update', $handle)
                    ->name('livewire.update');
            });
        }
    }
}
