<?php

namespace Deep\Products\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Products\Models\Form;
use Deep\Products\Models\Product;
use Livewire\WithPagination;

class AdminForm extends Component
{
    use WithPagination;
    public $isOpen = 0, $perPage = 100, $search;
    public $filter_type, $filter_status;

    public function render(){
        $data =   Form::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-form', [ 'data' => $data ] )->layout('layouts.admin');
    }

    public function openModal(){ $this->resetInputFields(); $this->isOpen = true; }
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}