<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\PaginationState;

class PaginationStateServiceProvider extends ServiceProvider
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
        $this->app->bind('App\Helpers\Contracts\PaginationStateContract', function(){

            return new PaginationState();

        });
    }
}
