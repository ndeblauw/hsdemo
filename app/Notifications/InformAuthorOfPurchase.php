<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InformAuthorOfPurchase extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Post $post)
    {
        //
    }

    public function toMail(object $notifiable): MailMessage
    {
        $sponsor = $this->post->sponsor;

        return (new MailMessage)
            ->subject('Somebody sponsored your post')
            ->greeting("Hej {$notifiable->name},")
            ->line('Good news, '.$sponsor->name.' liked your article on'.$this->post->title.'so much, that they decided to sponsor you.')
            ->line('This is now also mentioned on top of your article.')
            ->action('Check it out', route('posts.show', ['post' => $this->post]))
            ->line('As soon as the total amount of sponsorship reaches € 100,-, we will make a transfer to your account. Until the money is ours and you have no rights at all... #EVIL GRIN#');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }
}
