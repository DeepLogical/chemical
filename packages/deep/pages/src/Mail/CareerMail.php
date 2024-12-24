<?php

namespace Deep\Pages\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Deep\Pages\Models\Career;

class CareerMail extends Mailable
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
        $this->data         =   Career::where('id', $this->id)->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thank you for applying for a job on '.config('deep.brand'))
                    ->markdown('deep::emails.career-mail');
    }
}
