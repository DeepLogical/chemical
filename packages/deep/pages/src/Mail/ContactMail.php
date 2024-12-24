<?php

namespace Deep\Pages\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Deep\Pages\Models\Contact;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data_id, $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data_id ){
        $this->data_id                  =   decode( $data_id );
        $this->data                     =   Contact::where('id', $this->data_id)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thank you for connecting with '.config('deep.brand') )->markdown('deep::emails.contact-mail');
    }
}