<?php

namespace App\Listeners;

use App\Events\Applied;
use App\Mail\UserApplyEmailTemplate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendApplyNotification
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
     * @param  \App\Events\Applied  $event
     * @return void
     */
    public function handle(Applied $event)
    {
        Mail::to($event->owner->email)->send(new UserApplyEmailTemplate($event->applicant, $event->owner, $event->description));
    }
}
