<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register repos specific for your system
        $this->registerRepos();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::routes();
    }

    /**
     * Register specific repos for this system
     *
     * @return void
     */
    public function registerRepos() {
        // Put your repos in here
        $this->app->bind(
            'App\Repositories\Interfaces\DeviceRepoInterface',
            'App\Repositories\DeviceRepo'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\PlaceRepoInterface',
            'App\Repositories\PlaceRepo'
        );
        $this->app->bind(
            'App\Repositories\Interfaces\UserRepoInterface',
            'App\Repositories\UserRepo'
        );
    }

}
