<?php

namespace Deep\Pages\Http\Livewire\Block;

use Livewire\Component;

class WhyChooseUs extends Component
{
    public $data = [
        [ "name" => "Free Shipping", "img" => "support.svg", "text" => "Offer a diverse range of training modules catering to various skill levels, ages, and xx" ],
        [ "name" => "Huge Savings", "img" => "saving.svg", "text" => "Showcase a wide array of xx events, competitions, and tournaments. " ],
        [ "name" => "Certified Products", "img" => "certified.svg", "text" => "Highlight the vibrant community fostered by your platform. " ],
        [ "name" => "Easy Returns", "img" => "returns.svg", "text" => "Highlight the credentials and experience of your trainers, coaches, and organizers." ]
    ];
    
    public function render(){ return view('deep::livewire.block.why-choose-us'); }
}