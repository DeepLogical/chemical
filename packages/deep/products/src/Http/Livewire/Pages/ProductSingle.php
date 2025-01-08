<?php

namespace Deep\Products\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Products\Models\Product;

class ProductSingle extends Component
{
    public $data;
    
    public function mount($url){
        $this->data =       Product::where('url', $url)->first();
        if( !$this->data){ return redirect( route('404') ); }
    }
    
    public function render(){ return view('deep::livewire.pages.product-single'); }
}
