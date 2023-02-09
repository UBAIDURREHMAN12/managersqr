<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $name , $link;





    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($link,$name)
    {
        $this->name=$name;
        $this->link=$link;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('procuriot@ioptime.com')
            ->subject('Reset Password')
            ->markdown('emails.mail');
    }
}
