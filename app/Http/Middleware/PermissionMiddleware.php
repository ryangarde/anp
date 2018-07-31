<?php

namespace App\Http\Middleware;

use Facades\App\Contracts\EntrustInterface;
use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @param  string/array              $permissions Permission Name
     * @param  boolean                   $requiredAll Require all permissions
     * @return mixed
     */
    public function handle($request, Closure $next, $permissions, $requiredAll = false)
    {
        $requiredAll = preg_replace('/\s+/', '', $requiredAll);

        if (! EntrustInterface::hasPermission(explode('|', $permissions), $requiredAll)) {
            return redirect('/error');
        }

        return $next($request);
    }
}
