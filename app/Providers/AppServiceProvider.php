<?php

namespace App\Providers;

use App\Contracts\SchoolRepositoryContract;
use App\Contracts\StudentRepositoryContract;
use App\Contracts\TeamRepositoryContract;
use App\Repositories\SchoolRepository;
use App\Repositories\StudentRepository;
use App\Repositories\TeamRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(SchoolRepositoryContract::class, SchoolRepository::class);
        $this->app->bind(StudentRepositoryContract::class, StudentRepository::class);
        $this->app->bind(TeamRepositoryContract::class, TeamRepository::class);
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
