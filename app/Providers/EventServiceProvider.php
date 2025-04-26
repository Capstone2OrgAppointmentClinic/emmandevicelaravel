<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\LogSuccessfulLogin;
use App\Listeners\LogSuccessfulLogout;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listeners for the application.
     *
     * @var array
     */
    protected $listen = [
        // Register the login event
        Login::class => [
            LogSuccessfulLogin::class, // Event listener para sa successful login
        ],
        
        // Register the logout event
        Logout::class => [
            LogSuccessfulLogout::class, // Event listener para sa successful logout
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
