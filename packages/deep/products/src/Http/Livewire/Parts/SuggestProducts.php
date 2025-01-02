<?php

namespace Deep\Products\Http\Livewire\Parts;

use Livewire\Component;

use Deep\Products\Models\Product;

class SuggestProducts extends Component
{
    public $model, $model_id, $heading, $paragraph, $data = [];

    public function mount(){
        $this->data = Product::active()->limit(15)->inRandomOrder()->get();

        $hp                         =   getHP( $this->model, $this->model_id, 'product_heading', 'product_text' );
        // $this->heading              =   (!empty($hp) && isset($hp['h'])) ? $hp['h'] : "Products";
        // $this->paragraph            =   (!empty($hp) && isset($hp['p'])) ? $hp['p'] : "Beautifully crafted products and articles";
    }

    public function render(){ return view('deep::livewire.parts.suggest-products'); }
}