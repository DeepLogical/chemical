<?php

namespace Deep\Products\Http\Livewire\Pages;

use Livewire\Component;

use DB;
use Auth;
use Deep\Products\Models\Product;

class Form extends Component
{
        public $name, $email, $phone, $company, $location, $product_id, $quantity, $message, $product_options = [];

    public function mount(){
        $this->product_options        =   Product::active()->get();

        if( Auth::check() ){
            $this->name             =   Auth::user()->name;
            $this->email            =   Auth::user()->email;
            $this->phone            =   Auth::user()->phone;
        }
    }

    public function render(){ return view('deep::livewire.pages.form'); }

    public function submit(){
        $this->validate([
            'name'                      => 'required',
            'email'                     => 'required|email',
            'phone'                     => 'required|numeric|digits:10',
            'product_id'                => 'required|numeric',
            'location'                  => 'required|numeric',
            'quantity'                  => 'required|numeric',
        ]);
        
        DB::transaction(function () {
            $entry = Form::create([
                'user_id'                   =>  Auth::check() ? Auth::user()->id : null,
                'name'                      =>  $this->name,
                'email'                     =>  $this->email,
                'phone'                     =>  $this->phone,
                'product_id'                =>  $this->product_id,
                'company'                   =>  $this->company,
                'location'                  =>  $this->location,
                'quantity'                  =>  $this->quantity,
                'message'                   =>  $this->message,
                'status'                    =>  "Requested",
            ]);

            $this->dispatch('alert', ['type' => 'success',  'message' => 'Form Submitted Successfully.' ]);            
            return redirect(route('thankyou') );
        }, 3);
    }
}

