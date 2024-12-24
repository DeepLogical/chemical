<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

class Privacy extends Component
{
    public $brand, $full_address, $gst, $owner;
    public $email = [];
    public $phone = [];

    public function mount(){
        $this->full_address = config('deep.full_address');
        $this->email = config('deep.email');
        $this->phone = config('deep.phone');
        $this->brand = config('deep.brand');
        $this->gst = config('deep.gst');
        $this->owner = config('deep.owner');
    }
    
    public function render(){ return view('deep::livewire.pages.privacy')->layout('layouts.admin'); }
}