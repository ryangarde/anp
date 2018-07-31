<?php

namespace App\Providers;

use App\Repositories\EntrustRepository;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('entrust', function () {
            return new EntrustRepository::class;
        });
    }
}
