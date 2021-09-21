<?php

namespace App\Providers;

use App\Models\Vacancy;
use App\Observers\VacancyObserver;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Vacancy::observe(VacancyObserver::class);
    }
}
