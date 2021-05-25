<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;

class UserLoggedInListener
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
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        $user = $event->user;
        $user->timestamps = false;
        $user->last_login_at = now();
        $user->last_login_ip = request()->getClientIp();
        $user->save();
    }
}
