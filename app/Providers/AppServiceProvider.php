<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use App\Repositories\PageTitleRepository;
use App\Repositories\SubscribeUserRepository;
use App\Repositories\UserMessageRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view)
        {
            $data=[];
            $view->with($data);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
