<?php

namespace Deep\Products\Http\Livewire\Parts;

use Livewire\Component;

use Deep\Products\Models\Product;
use Deep\Products\Models\Productmeta;
use Deep\Products\Models\Comments;

class ProductSidebar extends Component
{
    public $search, $category = [], $catSelected = [], $tag = [], $tagSelected = [], $product = [], $productSpecial = [], $productSpecialSelected = [], $subject = [], $subjectSelected = [], $board = [], $boardSelected = [], $grade = [], $gradeSelected = [] ;

    public function mount(){
        $this->category                 =   Productmeta::where('type', 'category')->limit(15)->get();
        $this->tag                      =   Productmeta::where('type', 'tag')->limit(15)->get();
    }
    
    public function render(){ return view('deep::livewire.parts.product-sidebar'); }

    public function updatedSearch(){ $this->dispatch('searchUpdated', $this->search); }

    public function updatedCatSelected(){
        foreach($this->catSelected as $key=>$i){ if(!$i){ unset($this->catSelected[$key]); } }
        $this->mergeOptions();
    }

    public function updatedTagSelected(){
        foreach($this->tagSelected as $key=>$i){ if(!$i){ unset($this->tagSelected[$key]); } }
        $this->mergeOptions();
    }

    public function updatedProductSpecialSelected(){
        foreach($this->productSpecialSelected as $key=>$i){ if(!$i){ unset($this->productSpecialSelected[$key]); } }
        $this->mergeOptions();
    }
    public function updatedGradeSelected(){
        foreach($this->GradeSelected as $key=>$i){ if(!$i){ unset($this->GradeSelected[$key]); } }
        $this->mergeOptions();
    }

    private function mergeOptions(){ 
        $metaSelected = array_merge( $this->catSelected, $this->tagSelected);
        $this->dispatch('metaUpdated', $metaSelected);
    }
}