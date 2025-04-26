<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\StudentLog;
use Carbon\Carbon;

class LogSuccessfulLogout
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
    public function handle(Logout $event): void
    {
        $log = StudentLog::where('user_id', $event->user->id)
                       ->whereNull('logout_at') 
                       ->latest()                
                       ->first();
                       

        if ($log) {
            $log->update([
                'logout_at' => now(),
            ]);
    }
    }
}