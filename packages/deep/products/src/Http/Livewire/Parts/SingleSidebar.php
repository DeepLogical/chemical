<?php

namespace Deep\Products\Http\Livewire\Parts;

use Livewire\Component;

use Deep\Products\Models\Product;
use Deep\Products\Models\Comments;

class SingleSidebar extends Component
{
    public $search, $category = [], $tag = [], $products = [];

    public function mount(){
        $this->products                =   Product::select('id', 'name', 'url', 'media_id')->orderBy('id', 'DESC')->limit(15)->get();
        // $this->category             =   Productmeta::where('type', 'category')->limit(15)
        //                                 ->withCount('products')->having('products_count', '>', 0)->get();
                                        
        // $this->tag                  =   Productmeta::where('type', 'tag')->limit(15)->get();
    }
    
    public function render(){ return view('deep::livewire.parts.single-sidebar'); }

    public function updatedSearch(){ $this->emit('searchUpdated', $this->search); }
}