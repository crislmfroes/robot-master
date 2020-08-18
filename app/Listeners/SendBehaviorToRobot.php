<?php

namespace App\Listeners;

use App\Events\BehaviorSelected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBehaviorToRobot
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
     * @param  BehaviorSelected  $event
     * @return void
     */
    public function handle(BehaviorSelected $event)
    {
        //
    }
}
