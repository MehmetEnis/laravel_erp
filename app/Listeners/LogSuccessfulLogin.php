<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\UserAction;
use Auth;


class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        UserAction::create([
            'user_id'      => Auth::user()->id,
            'action'       => 'Logged In',
            'action_model' => $event->user->getTable(),
            'action_id'    => $event->user->id,
        ]);
    }
}
