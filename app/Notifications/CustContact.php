<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustContact extends Notification
{
    use Queueable;
    private $dealviewdata;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($dealviewdata)
    {
        $this->dealviewdata = $dealviewdata;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject($this->dealviewdata['subject'])
        ->greeting($this->dealviewdata['greeting'])
        ->line($this->dealviewdata['body'])
        ->action($this->dealviewdata['text'], $this->dealviewdata['url'])
        ->line('Thank you for using Deals For Wedding!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'body' => $this->dealviewdata['body'],
            'url' => $this->dealviewdata['url'],
            'notifyto' => $this->dealviewdata['notifyto']
        ];
    }
}
