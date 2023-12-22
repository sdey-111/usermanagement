<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class FrontendRouteHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard=null)
    {
        if ($guard == "taskProvider"){

            if(!Auth::guard($guard)->check())
            {
              return redirect()->action('LoginController@getUserLogin');
            }
        }

        if ($guard == "taskSeeker"){

            if(!Auth::guard($guard)->check())
            {
               return redirect()->action('LoginController@getUserLogin');

            }
        }
        return $next($request); 
    }
}
