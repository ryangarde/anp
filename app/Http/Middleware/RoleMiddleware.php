<?php

namespace App\Http\Middleware;

use Facades\App\Contracts\EntrustInterface;
use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @param  string/array              $roles Role Name
     * @param  boolean                   $requiredAll Require all permissions
     * @return mixed
     */
    public function handle($request, Closure $next, $roles, $requiredAll = false)
    {
        $requiredAll = preg_replace('/\s+/', '', $requiredAll);

        if (! EntrustInterface::hasRole(explode('|', $roles), $requiredAll)) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
