<?php

namespace Deep\Seo\Http\Livewire\Schema;

use Livewire\Component;

use Deep\Ecom\Models\Product;

class ProductSchema extends Component
{
    public $data;
    public function mount($url){
        $this->url          =   $url;
        $this->data         =   Product::where('url', $url)->first();
    }

    public function render(){ 
        return view('deep::livewire.schema.product-schema');
    }
}