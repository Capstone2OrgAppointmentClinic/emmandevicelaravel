<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentLog;

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
{
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $view->with('unreadNotifications', Auth::user()->unreadNotifications);
        }
        $logs = StudentLog::latest()->with('student')->paginate(12);
        $view->with('logs', $logs);
    });
}
    }
}
