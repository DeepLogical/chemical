<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

class Breadcrumb extends Component
{
    public $data;
    
    public function render(){ return view('deep::livewire.parts.breadcrumb'); }
}