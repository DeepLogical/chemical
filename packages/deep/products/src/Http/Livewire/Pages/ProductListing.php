<?php

namespace Deep\Products\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Products\Models\Product;

class ProductListing extends Component
{
    public $heading = "Enjoy ouur Products", $paragraph = "Stay Tuned", $perPage = 2, $search, $metaSelected = [], $url, $count, $data;

    public function loadMore(){
        if( count( $this->data ) < $this->count ){
            $this->perPage += 60;
            $this->getData();
        }else{
            $this->reset = 0;
        }
    }

    public function mount(){
        $this->getData();
    }    

    public function render(){ return view('deep::livewire.pages.product-listing'); }

    private function getData(){
        $query              =   Product::active()->search($this->search);

        if( $this->metaSelected && count( $this->metaSelected) ){
        $query = $query->where(function ($q) {
                $q->whereHas('productmeta', function($q) {
                    $q->whereIn('productmetas.id', $this->metaSelected);
                });
            });
        }
        $this->count        =   $query->count();
        $this->data         =   $query->limit($this->perPage)->get();
    }
    
    protected $listeners = [ 'searchUpdated', 'metaUpdated' ];    
    public function searchUpdated( $data ){ $this->search =  $data; $this->reset = 1; $this->getData(); }
    public function metaUpdated( $data ){ $this->metaSelected =  $data; $this->reset = 1; $this->getData(); }
}