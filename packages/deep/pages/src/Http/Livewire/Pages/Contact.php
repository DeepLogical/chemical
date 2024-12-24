<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

class Contact extends Component
{    
    public $full_address;
    public $email = [];
    public $phone = [];
    public $social = [];

    public function mount(){
        $this->full_address = config('deep.full_address');
        $this->email = config('deep.email');
        $this->phone = config('deep.phone');
        $this->social = config('deep.social');
        $this->googlemap = config('deep.googlemap');
    }

    public function render(){ return view('deep::livewire.pages.contact')->layout('layouts.admin'); }
}