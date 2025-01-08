<?php
namespace Deep\Blogs\Http\Livewire\Parts;

use Livewire\Component;
use Deep\Blogs\Models\Blog;
use Deep\Blogs\Models\Blogmeta;

class SingleSidebar extends Component
{
    public $search, $category = [], $tag = [], $blogs = [];

    public function mount(){
        $this->blogs = Blog::select('id', 'name', 'url', 'media_id')
                            ->orderBy('id', 'DESC')
                            ->limit(15)
                            ->get();

        $this->category = Blogmeta::where('type', 'category')
                                    ->limit(15)
                                    ->withCount('blogs')
                                    ->having('blogs_count', '>', 0)
                                    ->get();
        
        $this->tag = Blogmeta::where('type', 'tag')->limit(15)->get();
    }

    public function updatedSearch(){
        $this->emit('searchUpdated', $this->search);
        $this->filterBlogs();
    }

    // Method to filter the blogs based on search
    public function filterBlogs() {
        $this->blogs = Blog::select('id', 'name', 'url', 'media_id')
                            ->where('name', 'like', '%' . $this->search . '%')  // Filtering based on search term
                            ->orderBy('id', 'DESC')
                            ->limit(15)
                            ->get();
    }

    public function render(){
        return view('deep::livewire.parts.single-sidebar');
    }
}
