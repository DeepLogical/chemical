<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

use Cookie;

class Map extends Component
{
    public $data, $view;
    
    public function render(){ return view('deep::livewire.parts.map'); }

    public function checkLocation( $lat, $long ){
        checkLocation( $lat, $long );
        Cookie::queue( 'lat', $lat );
        Cookie::queue( 'long', $long );
        $this->emit("locationFound");
    }
}