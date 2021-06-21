<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        
        Str::macro('cep', function ($cep)
        {
            $str1 = substr($cep, 0, 5);
            $str2 = substr($cep, -3);
            $cep = $str1."-".$str2;
            return $cep;
        });
    }
}
