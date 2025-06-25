<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $content;

    public function __construct($content)
    {
        //
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('emails.ticketCreated')
            ->with([
                'ticket' => $this->content,
            ])
            ->subject(__('labels.frontend.tickets.new_ticket_email_sbj'));
    }
}
