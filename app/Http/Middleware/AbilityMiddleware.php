<?php

namespace App\Http\Middleware;

use Facades\App\Contracts\EntrustInterface;
use Closure;

class AbilityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @param  string/array              $roles       Role Name
     * @param  string/array              $permissions Permissions
     * @param  boolean                   $requiredAll Require all roles and permissions
     * @return mixed
     */
    public function handle($request, Closure $next, $roles = null, $permissions = null, $requiredAll = false)
    {
        $roles       = preg_replace('/\s+/', '', $roles);
        $permissions = preg_replace('/\s+/', '', $permissions);
        $requiredAll = preg_replace('/\s+/', '', $requiredAll);

        if (! EntrustInterface::hasAbility(explode('|', $roles), explode('|', $permissions), $requiredAll)) {
            return redirect()->back();
        }

        return $next($request);
    }
}
