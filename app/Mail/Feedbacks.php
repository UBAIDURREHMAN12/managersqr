<?php

namespace App\Mail;

use App\order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Feedbacks extends Mailable
{
    use Queueable, SerializesModels;
    public $order; public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(order $order,User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->from('info@qrcodegenerator')->subject('Feedback Received')->markdown('emails.Feedbacks');
        return $this->from('managersqr@gmail.com')->subject('Feedback Received')->markdown('emails.Feedbacks');

    }
}
