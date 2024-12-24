<?php

namespace Deep\Pages\Http\Livewire\Pages;

use Livewire\Component;

use Session;
use Deep\Blogs\Models\Blog;
use Deep\Ecom\Models\Product;

class Search extends Component
{
    public $blogs = [], $products = [], $search;

    public function mount(){
        if( Session::get('search') ){ $this->search = Session::get('search'); }

        $this->blogs            =   Blog::active()->search($this->search)->orderBy('id', 'desc')->limit(12)->get();
        $this->products         =   Product::active()->search($this->search)->orderBy('id', 'desc')->limit(12)->get();
    }

    public function render(){ return view('deep::livewire.pages.search'); }
}