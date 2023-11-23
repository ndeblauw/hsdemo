<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\WelcomeNewUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWelcomeMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
        //
    }

    public function handle(): void
    {
        sleep(5);

        $this->user->notify(new WelcomeNewUser());

        sleep(5);
    }
}
