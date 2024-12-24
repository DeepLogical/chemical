<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

class ShareMe extends Component
{
    public $url;
    
    public function render(){ return view('deep::livewire.parts.share-me'); }
}