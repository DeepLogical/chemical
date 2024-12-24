<?php

namespace Deep\Pages\Http\Livewire\Form;

use Livewire\Component;

use DB;
use Mail;
use Auth;
use Deep\Pages\Mail\SubscribeMail;
use Deep\Pages\Models\Subscribe;

class SubscribeForm extends Component
{
    public $email, $status;

    public function render(){ return view('deep::livewire.form.subscribe-form'); }

    public function submit(){        
        $this->validate([
            'email' => 'required'
        ]);

        if( Subscribe::where('email', $this->email)->exists() ){
            $this->dispatch('alert', ['type' => 'success',  'message' => 'You are already Subscribed' ]);
            return;
        }

        DB::transaction(function () {
            $entry = Subscribe::create([
                'user_id'       =>  Auth::check() ? Auth::user()->id : null,
                'email'         =>  $this->email,
                'status'        =>  1,
            ]);

            try{
                Mail::to( $this->email )->cc( config('deep.email') )->send(new SubscribeMail(encode($entry->id) ));
            }catch (\Exception $e) {
                \Log::warning("SubscribeMail Mail not sent ".now());
            }
            
            $this->email = '';

            sendNotifications('subscriptionForm');
            
            $this->dispatch('alert', ['type' => 'success',  'message' => 'You subscribed Successfully.' ]);
            return redirect(route('thankyou') );
        }, 3);
    }
}