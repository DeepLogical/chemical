<?php

namespace Deep\Pages\Http\Livewire\Form;

use Livewire\Component;

use DB;
use Mail;
use Auth;
use Deep\Pages\Mail\ContactMail;
use Deep\Pages\Models\Contact;

class ContactForm extends Component
{
    public $type, $name, $email, $phone, $message;
    // public $name = "Amit", $email = "", $phone = "8424003840", $message = "testing";

    public function mount(){
        if( Auth::check() ){
            $this->name                 =   Auth::user()->name;
            $this->email                =   Auth::user()->email;
            $this->phone                =   Auth::user()->phone;
        }

        // Mail::to( 'almora1deepak@gmail.com' )->cc( config('deep.email') )->send(new ContactMail( encode( 1 ) ));
    }
    
    public function render(){ return view('deep::livewire.form.contact-form'); }

    public function submit(){
        $this->validate([
            'name'                      => 'required',
            'email'                     => 'required|email',
            'phone'                     => 'required|numeric|digits:10',
            'message'                   => 'required'
        ]);

        if( !$this->email && $this->phone ){
            $this->dispatch('alert', ['type' => 'success',  'message' => 'Email Or Phone ir required' ]); return; 
        }
        
        DB::transaction(function () {
            $entry = Contact::create([
                'user_id'                   =>  Auth::check() ? Auth::user()->id : null,
                'name'                      =>  $this->name,
                'email'                     =>  $this->email,
                'phone'                     =>  $this->phone,
                'message'                   =>  $this->message,
            ]);

            try{
                Mail::to( $this->email )->cc( config('deep.email') )->send(new ContactMail( encode( $entry->id ) ));
            }catch (\Exception $e) { \Log::warning("ContactMail Mail not sent ".now()); }

            sendNotifications('contactForm');
            $this->dispatch('alert', ['type' => 'success',  'message' => 'Form Submitted Successfully.' ]);            
            return redirect(route('thankyou') );
        }, 3);
    }
}