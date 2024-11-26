<?php

namespace App\Providers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Cmixin\BusinessTime;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        BusinessTime::enable(Carbon::class);
        BusinessTime::enable([Carbon::class, CarbonImmutable::class]);
        BusinessTime::enable(Carbon::class, [
            'monday' => ['08:30-17:30'],
            'tuesday' => ['08:30-17:30'],
            'wednesday' => ['08:30-17:30'],
            'thursday' => ['08:30-17:30'],
            'friday' => ['08:30-17:30'],
            'saturday' => [],  // No work on Saturday
            'sunday' => [],    // No work on Sunday
            'exceptions' => [
                '12-25' => [], // Christmas Day, closed
                // You can add other holidays or exceptions here
            ],
            'holidaysAreClosed' => true, // Mark all holidays as closed
        ]);
        Paginator::useBootstrapFive();
    }
}
