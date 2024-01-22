<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ThankSponsorAfterPurchase extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Post $post)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $author = $this->post->author;

        return (new MailMessage)
            ->subject('Thank you for sponsoring!')
            ->greeting("Hej {$notifiable->name},")
            ->line('Thank you once again to sponsor '.$author->name.' for his/her work on '.$this->post->title.', this is really appreciated.')
            ->line('Your sponsorship is now also mentioned on top of the article.')
            ->action('Check it out', route('posts.show', ['post' => $this->post]))
            ->line('Till the next time?');
    }

    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
