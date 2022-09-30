<?php

namespace App\Providers;

use App\Repositories\Team\TeamRepository;
use App\Repositories\Team\TeamRepositoryInterface;
use App\Service\Team\TeamService;
use App\Service\Team\TeamServiceInterface;
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
        $this->app->singleton(
            TeamRepositoryInterface::class,
            TeamRepository::class
        );

        $this->app->singleton(
            TeamServiceInterface::class,
            TeamService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
