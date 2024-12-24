<?php

namespace App\Livewire\Pages;

use Livewire\Component;

use Deep\Blogs\Models\Blog;

class Single extends Component
{
    public $data;
    
    public function mount($url){
        $this->data =       Blog::where('url', $url)->first();
        if( !$this->data){ return redirect( route('404') ); }
    }
    
    public function render()
    {
        return view('livewire.pages.single');
    }
}
