<?php

namespace Deep\Admin\Http\Livewire\Parts;

use Livewire\Component;

use DB;
use Auth;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

use Livewire\WithFileUploads;

class PaymentModal extends Component
{
    use WithFileUploads;

    public $isOpen = 0, $name, $email, $phone, $amount = 400, $key, $secret, $site, $brand;

    public function mount(){
        $this->name                 =   Auth::user()->name;
        $this->email                =   Auth::user()->email;
        $this->phone                =   Auth::user()->phone;
        $this->key                  =   config('deep.mode') == "prod" ? config('deep.rzp_prod_key') : config('deep.rzp_test_key');
        $this->secret               =   config('deep.mode') == "prod" ? config('deep.rzp_prod_secret') : config('deep.rzp_test_secret');
        $this->site                 =   config('deep.mode') == "prod" ? config('deep.site') : config('deep.test_site');
        $this->brand                =   config('deep.brand');
    }

    public function render(){ return view('deep::livewire.parts.payment-modal')->layout('layouts.admin'); }

    public function submit(){
        $this->validate([
            'amount'    =>  'required|numeric',
        ]);

        $amount         =   $this->amount*100;
        $csrf           =   csrf_token();

        $response = Http::withBasicAuth( $this->key, $this->secret )->post('https://api.razorpay.com/v1/orders', [
            "amount" => $this->amount*100,
            "currency" => "INR",
            "receipt" => "rcptid_11"
        ]);

        if($response->json()){ $order_id = $response->json()['id']; }

        $options = '{
            "key": "'.$this->key.'",
            "amount": '.$amount.',
            "currency": "INR",
            "name": '.$this->brand.',
            "description": "Walet Recharge on '.$this->brand.'",
            "image": "https://www.chedfsPoint.com/images/logo.png",
            "order_id": "'.$order_id.'",
            "callback_url": "'.$this->site.'/recharge-wallet",
            "prefill": {
                "name": "'.Auth::user()->name.'",
                "email": "'.Auth::user()->email.'",
                "contact": "'.Auth::user()->phone.'"
            },
            "theme": {
                "color": "#f19f40"
            }      
        }';

        $this->dispatch('makeRzpPayment', [ 'data' => $options ]);
    }

    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['openModalCalled'];
    public function openModalCalled(){ $this->isOpen    =   1; }

    private function resetInputFields(){
        $this->amount                            =   null;
        $this->isOpen                           =   false;
    }
}