<?php

namespace Deep\Blogs\Http\Livewire\Parts;

use Livewire\Component;

class SmallBlogItem extends Component
{
    public $i;
    
    public function render(){ return view('deep::livewire.parts.small-blog-item'); }
}