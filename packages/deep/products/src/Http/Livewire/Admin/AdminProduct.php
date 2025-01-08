<?php

namespace Deep\Products\Http\Livewire\Admin;

use Livewire\Component;

use Deep\Products\Models\Product;
use Livewire\WithPagination;

class AdminProduct extends Component
{
    use WithPagination;

    public $perPage = 100, $search;

    public function render(){ 
        $data = Product::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-product', [ 'data' => $data ] )->layout('layouts.admin');
    }

    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
}