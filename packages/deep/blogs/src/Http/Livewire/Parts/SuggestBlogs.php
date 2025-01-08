<?php

namespace Deep\Blogs\Http\Livewire\Parts;

use Livewire\Component;

use Deep\Blogs\Models\Blog;

class SuggestBlogs extends Component
{
    public $model, $model_id, $heading, $paragraph, $data = [];

    public function mount(){
        $this->data = Blog::active()->limit(15)->inRandomOrder()->get();

        $hp                         =   getHP( $this->model, $this->model_id, 'blog_heading', 'blog_text' );
        $this->heading              =   (!empty($hp) && isset($hp['h'])) ? $hp['h'] : "Interesting Reads";
        $this->paragraph            =   (!empty($hp) && isset($hp['p'])) ? $hp['p'] : "Beautifully crafted blogs and articles";
    }

    public function render(){ return view('deep::livewire.parts.suggest-blogs'); }
}