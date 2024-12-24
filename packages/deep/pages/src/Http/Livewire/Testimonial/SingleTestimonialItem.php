<?php

namespace Deep\Pages\Http\Livewire\Testimonial;

use Livewire\Component;

class SingleTestimonialItem extends Component
{
    public $i;
    
    public function render(){ return view('deep::livewire.testimonial.single-testimonial-item'); }
}
