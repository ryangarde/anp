<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Bind category repository with category interface.
         *
         */
        $this->app->bind(
            'App\Contracts\CategoryInterface',
            'App\Repositories\CategoryRepository'
        );

        /**
         * Bind main repository with main interface.
         *
         */
        $this->app->bind(
            'App\Contracts\RepositoryInterface',
            'App\Repositories\Repository'
        );

        /**
         * Bind producer repository with producer interface.
         *
         */
        $this->app->bind(
            'App\Contracts\ProducerInterface',
            'App\Repositories\ProducerRepository'
        );

        /**
         * Bind product repository with product interface.
         *
         */
        $this->app->bind(
            'App\Contracts\ProductInterface',
            'App\Repositories\ProductRepository'
        );
    }
}
