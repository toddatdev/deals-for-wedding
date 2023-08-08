<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ViewDealMail extends Mailable
{
    use Queueable, SerializesModels;

    public $dealDetailsViewByUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dealDetailsViewByUser)
    {
        $this->dealDetailsViewByUser = $dealDetailsViewByUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('View Deal by '.auth()->user()->fname)
            ->view('emails.view-deal-by-user');
    }
}
