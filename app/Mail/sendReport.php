<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class sendReport extends Mailable
{
    use Queueable, SerializesModels;
    public $name,$note,$admin_note,$feedback_id,$attachment ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$note,$admin_note,$feedback_id,$attachment)
    {
        $this->name=$name;
        $this->note=$note;
        $this->admin_note=$admin_note;
        $this->feedback_id=$feedback_id;
        $this->attachment=$attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $images =db::table('feedbac_images')->where('feedback_id',$this->feedback_id)->get();



        $email =$this->from('managersqr@gmail.com')->subject('Report')->markdown('emails.sendReport');

       if($this->attachment==1){
                foreach($images as $filePath){
                $email->attach(public_path(str_replace("public/", "",$filePath->image)));
           }
        }


        return $email;



    }
}
