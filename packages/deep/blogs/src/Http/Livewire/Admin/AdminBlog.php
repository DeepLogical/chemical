<?php

namespace Deep\Blogs\Http\Livewire\Admin;

use Livewire\Component;

use Deep\Blogs\Models\Blog;
use Livewire\WithPagination;

class AdminBlog extends Component
{
    use WithPagination;

    public $perPage = 100, $search;

    public function render(){ 
        $data = Blog::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-blog', [ 'data' => $data ] )->layout('layouts.admin');
    }

    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
}