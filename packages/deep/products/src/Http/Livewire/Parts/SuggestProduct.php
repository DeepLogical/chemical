<?php

namespace Deep\Products\Http\Livewire\Parts;

use Livewire\Component;

use Deep\Products\Models\Product;

class SuggestProduct extends Component
{
    public $data = [], $heading = "Explore Our Products", $paragraph = "Explore our diverse products, designed to enhance skills, ignite passions, and guide you towards success with expert instruction and real-world applications. Unlock your potential today!";

    public function mount(){
        $this->data = Product::active()->limit(15)->inRandomOrder()->get();
    }

    public function render(){ return view('deep::livewire.parts.suggest-product'); }
}