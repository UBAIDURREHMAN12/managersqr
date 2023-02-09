<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail2 extends Mailable
{
    use Queueable, SerializesModels;
    public $username , $password, $link;





    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username,$password,$link)
    {
        $this->username=$username;
        $this->password=$password;
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
            ->subject('Account Confirmation and Login Credentials')
            ->markdown('emails.mail2');
    }
}
