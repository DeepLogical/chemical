<?php

namespace Deep\Products\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Products\Models\Product;
// use Deep\Products\Models\Productmeta;

class ProductPage extends Component
{
    public $search, $heading = "Chemicals Insightz", $productMeta, $data;

    public function loadMore(){ 
        $this->perPage += 20;
        $this->getData();
    }

    public function mount( $url = null){
        if(request()->routeIs('tags') || request()->routeIs('category')){
            $this->productMeta = Productmeta::select('id', 'name', 'type')->where('url', $url)->first();
            if( !$this->productMeta ){ return redirect( route('404') ); }
            $this->heading = "Products of ".ucfirst($this->productMeta->type).' '.$this->productMeta->name;
        }
        $this->getData();
    }
    
    public function render(){ return view('deep::livewire.pages.product-page'); }

    private function getData(){
        if($this->productMeta){
            $this->data = $this->productMeta->products( $this->search )->get();
        }else{
            $this->data =   Product::active()->search($this->search)->orderBy('id', 'DESC')->get();
        }
    }

    protected $listeners = [ 'searchUpdated' ];
    public function searchUpdated($search){ $this->search = $search; $this->getData(); }
}