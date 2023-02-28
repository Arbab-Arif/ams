<?php

namespace App\Listeners;

class SetDepartmentIdInSession
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
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        session()->put('department_id', $event->user->department_id);
        session()->put('company_id', $event->user->company_id);
    }
}
