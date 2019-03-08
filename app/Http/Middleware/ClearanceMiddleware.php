<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) {
            return $next($request);
        }

        if ($request->is('sensors/create')) {
            if (!Auth::user()->hasPermissionTo('Add sensor')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->is('sensors/*/edit')) {
            if (!Auth::user()->hasPermissionTo('Edit sensor')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) {
            if (!Auth::user()->hasPermissionTo('Delete sensor')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
