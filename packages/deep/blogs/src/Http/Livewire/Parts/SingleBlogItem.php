<?php

namespace Deep\Blogs\Http\Livewire\Parts;

use Livewire\Component;

class SingleBlogItem extends Component
{
    public $i;
    
    public function render(){
        return view('deep::livewire.parts.single-blog-item');
    }
}
