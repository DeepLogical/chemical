<?php

namespace Deep\Pages\Http\Livewire\Form;

use Livewire\Component;

use Session;
use Deep\Ecom\Models\Product;

class SearchForm extends Component
{
    public $search, $search_options;

    public function render(){ return view('deep::livewire.form.search-form'); }

    public function submit(){        
        $this->validate([
            'search' => 'required'
        ]);

        Session::put( 'search', $this->search );
        return redirect( route('search') );
    }

    private function resetInputFields(){
        $this->isOpen                   = false;
    }

    public function updatedSearch(){
        $this->search_options           =   Product::active()->search($this->search)->take(20)->get();
    }
}