<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\PaginationPage;

class PaginationPageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Contracts\PaginationPageContract', function(){

            return new PaginationPage();

        });
    }
}
