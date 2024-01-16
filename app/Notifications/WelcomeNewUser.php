<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNewUser extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to HSdemo Blog')
            ->greeting('Hello '.$notifiable->name.',')
            ->line('Welcome to our <strong>great blog</strong>, we are sure you are going to enjoy')
            ->action('Read the latest articles', route('posts.index'))
            ->line('Thank you for registering with us!')
            ->salutation('Greetings from<br/><br/>The Great Blog Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
