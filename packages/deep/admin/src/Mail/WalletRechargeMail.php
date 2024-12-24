<?php

namespace Deep\Admin\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Deep\Admin\Models\WalletRecharge;

class WalletRechargeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id){
        $this->data = WalletRecharge::where('id', decode($id))->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Wallet Recharged on '.config('deep.brand') )->markdown('deep::emails.wallet-recharge-mail');
    }
}