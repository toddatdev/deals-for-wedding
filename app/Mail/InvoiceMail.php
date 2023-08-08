<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $deal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($deal)
    {
        $this->deal = $deal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invoice Email')

            ->view('mails.invoice-email');
    }
}
