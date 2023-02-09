<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public  $name, $code;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$code)
    {
        $this->name=$name;
        $this->code=$code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

//        return $this->subject('Mail from ItSolutionStuff.com')
//            ->view('account_confirmation_email');

        return $this->from('support@managersqr.managershq.com.au')
            ->subject('Account Confirmation')
            ->markdown('account_confirmation_email');
    }
}
