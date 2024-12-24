<?php

namespace Deep\Admin\Http\Livewire\Admin;

use Livewire\Component;

use DB;
use Deep\Admin\Models\AdminSetting as Settings;

class AdminSetting extends Component
{
    public $basicOptions, $type, $name, $value, $status, $data_id;
    public $isOpen = 0, $perPage = 100, $search;

    public function mount(){
        $this->basicOptions =   Settings::select('id', 'name')->where('type', 'Basic')->get();
    }

    public function render(){
        $data =   Settings::search($this->search)->orderBy('id', 'DESC')->paginate($this->perPage);
        return view('deep::livewire.admin.admin-setting', ['data' => $data])->layout('layouts.admin');
    }

    public function submit(){        
        $this->validate([
            'type'                      => 'required',
            'name'                      => 'required',
            'value'                     => 'required',
            'status'                    => 'required',
        ]);
        
        DB::transaction(function () {
            $data = Settings::updateOrCreate(['id' => $this->data_id], [
                'type'                  =>  $this->type,
                'name'                  =>  $this->name,
                'value'                 => $this->value,
                'status'                => $this->status
            ]);

            $this->dispatch('alert', ['type' => 'success',  'message' =>$this->data_id ? 'Setting Updated Successfully.' : 'Setting Created Successfully.', ]);

            $this->resetInputFields();
            $this->basicOptions =   Settings::select('id', 'name')->where('type', 'Basic')->get();
        }, 3);
    }

    public function changeStatus($id, $status){
        $message = changeStatus('admin_settings', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' =>$message ]);
    }

    public function edit($id){
        $this->data_id                  = decode($id);
        $check = Settings::where('id', $this->data_id)->first();

        if( $check ){
            $this->type                     = $check->type;
            $this->name                     = $check->name;
            $this->value                    = $check->value;
            $this->status                   = $check->status;
            $this->isOpen                   = 1;
        }
    }

    private function resetInputFields(){
        $this->type                     =   '';
        $this->name                     =   '';
        $this->value                    =   '';
        $this->status                   =   '';
        $this->data_id                  =   '';
        $this->isOpen                   =   false;
    }
    
    public function closeModal(){ $this->resetInputFields(); }
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; $this->status = 1; }
}
