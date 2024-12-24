<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

class BannerSlider extends Component
{
    public $banner;

    public function render(){
        return view('deep::livewire.parts.banner-slider');
    }
}