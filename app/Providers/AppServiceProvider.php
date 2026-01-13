<?php

namespace App\Providers;

// use Illuminate\Auth\Events\Login;
use App\Models\Ticket;
use App\Observers\TicketObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\ServiceProvider;
use App\Listeners\SendLoginNotification;

// use App\Listeners\SendLoginNotification;

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
    }

    protected $listen = [
        Login::class=>[
            SendLoginNotification::class,
        ],
    ];
}
