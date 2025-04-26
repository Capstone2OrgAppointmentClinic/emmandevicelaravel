<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\StudentLog;
use Carbon\Carbon;


class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        StudentLog::create([
            'user_id' => $event->user->id,
            'name' => $event->user->name,
            'login_at' => now(),
        ]);
    }
}
