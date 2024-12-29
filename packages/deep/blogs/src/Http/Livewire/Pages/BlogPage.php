<?php

namespace Deep\Blogs\Http\Livewire\Pages;

use Livewire\Component;

use Deep\Blogs\Models\Blog;
use Deep\Blogs\Models\Blogmeta;

class BlogPage extends Component
{
    public $search, $heading = "Chemicals Insightz", $blogMeta, $data;

    public function loadMore(){ 
        $this->perPage += 20;
        $this->getData();
    }

    public function mount( $url = null){
        if(request()->routeIs('tags') || request()->routeIs('category')){
            $this->blogMeta = Blogmeta::select('id', 'name', 'type')->where('url', $url)->first();
            if( !$this->blogMeta ){ return redirect( route('404') ); }
            $this->heading = "Blogs of ".ucfirst($this->blogMeta->type).' '.$this->blogMeta->name;
        }
        $this->getData();
    }
    
    public function render(){ return view('deep::livewire.pages.blog-page'); }

    private function getData(){
        if($this->blogMeta){
            $this->data = $this->blogMeta->blogs( $this->search )->get();
        }else{
            $this->data =   Blog::active()->search($this->search)->orderBy('id', 'DESC')->get();
        }
    }

    protected $listeners = [ 'searchUpdated' ];
    public function searchUpdated($search){ $this->search = $search; $this->getData(); }
}