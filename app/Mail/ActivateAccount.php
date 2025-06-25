<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateAccount extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$code)
    {
        //
        $this->user = $user;
        $this->code = $code;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        return $this
        ->markdown('emails.activateEmail')
        ->subject('Activate your account on '.env('APP_NAME'))
       
        ->with('user',$this->user)
        ->with('code',$this->code);

    }
}
