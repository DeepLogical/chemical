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
        $this->heading              =   (!empty($hp) && isset($hp['h'])) ? $hp['h'] : "Latest Blogs And News";
        $this->paragraph            =   (!empty($hp) && isset($hp['p'])) ? $hp['p'] : "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
    }

    public function render(){ return view('deep::livewire.parts.suggest-blogs'); }
}