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
            $arr1 = substr($cep, 0, 5);
            $arr2 = substr($cep, -3);
            $cep = $arr1."-".$arr2;
            return $cep;
        });
    }
}
