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
         * Bind admin repository with admin interface.
         *
         */
        $this->app->bind(
            'App\Contracts\AdminInterface',
            'App\Repositories\AdminRepository'
        );

        /**
         * Bind category repository with category interface.
         *
         */
        $this->app->bind(
            'App\Contracts\CategoryInterface',
            'App\Repositories\CategoryRepository'
        );

        /**
         * Bind entrust repository with entrust interface.
         *
         */
        $this->app->bind(
            'App\Contracts\EntrustInterface',
            'App\Repositories\EntrustRepository'
        );

        /**
         * Bind order product repository with order product interface.
         *
         */
        $this->app->bind(
            'App\Contracts\OrderProductInterface',
            'App\Repositories\OrderProductRepository'
        );

        /**
         * Bind order repository with order interface.
         *
         */
        $this->app->bind(
            'App\Contracts\OrderInterface',
            'App\Repositories\OrderRepository'
        );

        /**
         * Bind permission repository with permission interface.
         *
         */
        $this->app->bind(
            'App\Contracts\PermissionInterface',
            'App\Repositories\PermissionRepository'
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

        /**
         * Bind main repository with main interface.
         *
         */
        $this->app->bind(
            'App\Contracts\RepositoryInterface',
            'App\Repositories\Repository'
        );

        /**
         * Bind role repository with role interface.
         *
         */
        $this->app->bind(
            'App\Contracts\RoleInterface',
            'App\Repositories\RoleRepository'
        );

        /**
         * Bind shopping cart repository with shopping cart interface.
         *
         */
        $this->app->bind(
            'App\Contracts\ShoppingCartInterface',
            'App\Repositories\ShoppingCartRepository'
        );

        /**
         * Bind user repository with user interface.
         *
         */
        $this->app->bind(
            'App\Contracts\UserInterface',
            'App\Repositories\UserRepository'
        );
    }
}
