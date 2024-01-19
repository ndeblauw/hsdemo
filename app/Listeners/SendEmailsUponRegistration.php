<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\InformAdminOfNewUser;
use App\Notifications\WelcomeNewUser;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailsUponRegistration implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(object $event): void
    {
        $event->user->notify(new WelcomeNewUser());

        $admin = User::where('is_admin', true)->first();
        $admin?->notify(new InformAdminOfNewUser($event->user));
    }
}
