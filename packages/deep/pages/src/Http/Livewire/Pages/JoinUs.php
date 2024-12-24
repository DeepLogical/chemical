<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use DB;
use Auth;
use Deep\Pages\Models\Career;
use Livewire\WithFileUploads;

use Mail;
use Deep\Pages\Mail\CareerMail;

class JoinUs extends Component
{    
    use WithFileUploads;
    
    public $name, $email, $phone, $resume, $cover, $subject, $message;

    public function mount(){
        if( Auth::check() ){
            $this->name                 =   Auth::user()->name;
            $this->email                =   Auth::user()->email;
            $this->phone                =   Auth::user()->phone;
        }
    }

    public function render(){ return view('deep::livewire.pages.join-us'); }

    public function submit(){
        $this->validate([
            'name'                      => 'required',
            'email'                     => 'required|email',
            'phone'                     => 'required|numeric|digits:10',
            'subject'                   => 'required',
            'message'                   => 'required',
            'resume'                    => 'required | max:2048',
        ]);
        
        DB::transaction(function () {
            $resume = null; if( $this->resume ){ $resume = simpleUpload( "job-resume", $this->resume ); }
            $cover = null; if( $this->cover ){ $cover = simpleUpload( "job-cover", $this->cover ); }

            Career::create([
                'user_id'                   =>  Auth::check() ? Auth::user()->id : null,
                'name'                      =>  $this->name,
                'email'                     =>  $this->email,
                'phone'                     =>  $this->phone,
                'subject'                   =>  $this->subject,
                'resume'                    =>  $resume,
                'cover'                     =>  $cover,
                'message'                   =>  $this->message,
                'status'                    =>  'requested',
            ]);

            try{
                Mail::to( $this->email)->cc( config('deep.email') )->send(new CareerMail($xx));
            }catch (\Exception $e) {
                \Log::warning("CareerMail Mail not sent ".now());
            }

            sendNotifications('careerForm');
            $this->dispatch('alert', ['type' => 'success',  'message' => 'Form Submitted Successfully.' ]);            
            return redirect(route('thankyou') );
        }, 3);
    }
}