<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

class Tnc extends Component
{
    public $brand, $full_address;

    public function mount(){
        $this->full_address = config('deep.full_address');
        $this->brand = config('deep.brand');
    }
    public function render(){ return view('deep::livewire.pages.tnc')->layout('layouts.admin'); }
}