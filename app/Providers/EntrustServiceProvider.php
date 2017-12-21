<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Entrust;

class EntrustServiceProvider extends ServiceProvider
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
        Blade::directive('role', function ($expression) {
            return "<?php if (\\Entrust::hasRole({$expression})) : ?>";
        });

        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('permission', function ($expression) {
            return "<?php if (\\Entrust::hasPermission({$expression})) : ?>";
        });

        Blade::directive('endpermission', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('ability', function ($expression) {
            return "<?php if (\\Entrust::hasAbility({$expression})) : ?>";
        });

        Blade::directive('endability', function () {
            return "<?php endif; ?>";
        });
    }
}
