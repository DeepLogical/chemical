<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

class HeaderCrumbOne extends Component
{
    public $heading, $paragraph;
    
    public function render(){ return view('deep::livewire.parts.header-crumb-one'); }
}