<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

class HeaderCrumbTwo extends Component
{
    public $heading, $route, $paragraph;
    
    public function render(){ return view('deep::livewire.parts.header-crumb-two'); }
}