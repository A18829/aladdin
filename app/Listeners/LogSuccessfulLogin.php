<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Log;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
       $user = $event->user;
        Log::channel('login')->info('User logged in:', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'ip' => request()->ip(),
            //'user_agent' => request()->userAgent(),
            'time' => now(),
        ]);
    }
}
