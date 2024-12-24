<?php

namespace Deep\Pages\Http\Livewire\Parts;

use Livewire\Component;

use Session;

use Deep\Blogs\Models\Blog;
use Deep\Ecom\Models\Product;
use Deep\Ecom\Models\Productmeta;
use Deep\Ecom\Models\ProductBrand;

class SearchModal extends Component
{
    public $isOpen = 0, $search;

    public $blogs, $products, $productMeta, $brand;

    public function render(){ return view('deep::livewire.parts.search-modal'); }

    public function submit(){        
        $this->validate([
            'search' => 'required'
        ]);

        Session::put( 'search', $this->search );

        return redirect( route('search') );
    }

    public function updatedSearch(){
        $this->blogs        =   Blog::active()->search($this->search)->inRandomOrder()->limit(10)->get();
        $this->products     =   Product::active()->search($this->search)->inRandomOrder()->limit(10)->get();
        $this->productMeta  =   Productmeta::active()->search($this->search)->inRandomOrder()->limit(10)->get();
        $this->brand        =   ProductBrand::active()->search($this->search)->inRandomOrder()->limit(10)->get();
    }

    private function resetInputFields(){
        $this->isOpen                   = false;
    }

    protected $listeners = ['openSearchModal', 'closeModal'];
    public function openSearchModal(){ $this->isOpen = true; }
    public function closeModal(){ $this->resetInputFields(); }
}