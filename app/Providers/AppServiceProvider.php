<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
		if(isset($_SERVER['HTTP_CF_VISITOR'])) URL::forceScheme('https');
		if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']))
		{
			if($_SERVER['HTTP_X_FORWARDED_PROTO']=="https") URL::forceScheme('https');
		}
		
		
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
