<?php

namespace Deep\Pages\Http\Livewire\Admin;

use Livewire\Component;

use Deep\Pages\Models\Subscribe;
use Livewire\WithPagination;

class AdminSubscription extends Component
{
    use WithPagination;
    
    public $email, $status, $data_id;

    public $isOpen = 0;    
    public $perPage = 100;
    public $search;

    public function render(){
        $data =     Subscribe::select('id', 'email', 'status', 'updated_at')
                    ->orderBy('id', 'DESC')->search($this->search)->paginate($this->perPage);
        return view('deep::livewire.admin.admin-subscription', [ 'data' => $data ])->layout('layouts.admin');
    }

    public function edit($i){
        $this->email = $i['email'];
        $this->status = $i['status'];
        $this->data_id = $i['id'];
        $this->isOpen = true;
    }

    public function submit(){
        $this->validate([
            'email' => 'required',
            'status' => 'required',
        ]);
        Subscribe::where('id', $this->data_id)->update([
            'email' => $this->email,
            'status' => $this->status
        ]);

        $this->dispatch('alert', ['type' => 'success',  'message' =>'Subscription Updated Successfully.' ]);
        $this->resetInputFields();
    }

    public function changeStatus($id, $status){
        $message = changeStatus('subscribes', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message]);
    }

    private function resetInputFields(){
        $this->email                    = null;
        $this->status                   = null;
        $this->data_id                  = null;
        $this->isOpen                   = false;
    }
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}