<?php

namespace Deep\Seo\Http\Livewire\Schema;

use Livewire\Component;

use Deep\Blogs\Models\Blog;

class BlogSchema extends Component
{
    public $data;
    public function mount($url){
        $this->url          =   $url;
        $this->data         =   Blog::where('url', $url)->first();
    }

    public function render(){ 
        return view('deep::livewire.schema.blog-schema');
    }
}