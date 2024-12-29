<?php

namespace Deep\Products\Http\Livewire\Parts;

use Livewire\Component;

class SingleProductItem extends Component
{
    public $i;
    
    public function render(){
        return view('deep::livewire.parts.single-product-item');
    }
}
