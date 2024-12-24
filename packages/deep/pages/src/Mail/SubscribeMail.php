<?php

namespace Deep\Pages\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Deep\Pages\Models\Subscribe;

class SubscribeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $id, $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id           =   decode($id);
        $this->data         =   Subscribe::where('id', $this->id)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thank you for Subscribing '.config('deep.brand'))
                    ->markdown('deep::emails.subscribe-mail');
    }
}
