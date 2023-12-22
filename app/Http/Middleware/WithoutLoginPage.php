<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Illuminate\Support\Facades\Auth;

class WithoutLoginPage extends Middleware
{
    /**
     * Handle an incoming request.
     * after login those page request redirect dashboard page
     *  pages are [registration,login,forget-password,reset-password]
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            if ($request->url() === url()->to('register') || $request->url() === url()->to('login')
                || $request->url() === url()->to('forget-password') || $request->url() === url()->to('reset-password')
                || $request->url() === url()->to('thank-you') || $request->url() === url()->to('register-next-step') ) {
                return redirect()->action('HomePageController@getDashboard');
            }
        }
        return $next($request);
    }
}
