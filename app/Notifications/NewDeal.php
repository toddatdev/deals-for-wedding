<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewDeal extends Notification
{
    use Queueable;

    private $dealviewdata;
    public $pdf;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($dealviewdata,$session=null, $pdf=null)
    {
        $this->dealviewdata = $dealviewdata;
        $this->pdf = $pdf;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message =  (new MailMessage)
            ->subject($this->dealviewdata['subject'])
            ->greeting($this->dealviewdata['greeting'])
            ->line($this->dealviewdata['body'])
            ->line($this->dealviewdata['lineName'])
            ->line(new HtmlString($this->dealviewdata['lineStatus']))
            ->action($this->dealviewdata['text'], $this->dealviewdata['url'])
            ->line('Thank you for using Deals For Wedding!');

        if ($this->pdf) {
            $message->attachData($this->pdf->output(), 'report.pdf');
        }

        return $message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
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
