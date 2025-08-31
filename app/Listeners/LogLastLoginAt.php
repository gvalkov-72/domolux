<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Models\User;

class LogLastLoginAt
{
    /**
     * Handle the event.
     */
    public function handle(Authenticated $event): void
    {
        /** @var User $user */
        $user = $event->user;

        $user->last_login_at = now();
        $user->save();
    }
}
