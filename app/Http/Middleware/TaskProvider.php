<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class TaskProvider
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $urlArray = explode('/',$request->route()->uri);

        if(isset($urlArray[0]) && $urlArray[0]=='user')
        {
            if ($guard == "taskProvider" && !Auth::guard($guard)->check())
            {
                 dd($guard,Auth::guard('taskProvider')->check(),session()->all());
                //return redirect()->route('google.login.registration');
            }
            else
            {
                if($guard == "taskProvider" && Auth::guard($guard)->check())
                {
                    if(!isset($urlArray[1]) || (isset($urlArray[1]) && $urlArray[1]=='dashboard'))
                    {
                        dd('hii!taskProvider');
                        return redirect()->route('user.dashboard.taskprovider');
                    }
                }
            }
        }
        return $next($request); 
    }
}
