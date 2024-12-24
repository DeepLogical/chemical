<?php

namespace Deep\Admin\Http\Livewire\Admin;

use Livewire\Component;

use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class AdminSpatie extends Component
{
    use WithPagination;
    
    public $isOpen = 0, $perPage = 100, $search, $sortBy = 'id', $sortDirection = 'desc';
    public $type, $name, $data_id;

    public function mount(){
        if( Auth::user()->id != 1 ){ return redirect(route('adminblog') ); }
    }

    public function render(){
        $roles              =   Role::orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        $permissions        =   Permission::orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        return view('deep::livewire.admin.admin-spatie', [ "roles" => $roles, "permissions" => $permissions ])->layout('layouts.admin');
    }

    public function edit($i, $type){
        $this->type                         =   $type;
        $this->name                         =   $i['name'];
        $this->data_id                      =   $i['id'];
        $this->isOpen                       =   true;
    }

    public function submit(){
        $this->validate([
            'type'                          =>  'required',            
            'name'                          =>  'required',
        ]);

        if($this->type == 'role'){
            if( !$this->data_id && Role::where('name', strtolower($this->name))->exists() ){
                $this->dispatch('alert', ['type' => 'error', 'message' => ' Duplicate Role.' ]);
                return;
            }            

            Role::updateOrCreate(['id' => $this->data_id], [
                'name'                      =>  strtolower($this->name),
                'guard_name'                =>  'web',
            ]);
        }

        if($this->type == 'permission'){
            if( !$this->data_id && Permission::where('name', strtolower($this->name))->exists() ){
                $this->dispatch('alert', ['type' => 'error', 'message' => ' Duplicate Permission.' ]);
                return;
            }

            Permission::updateOrCreate(['id' => $this->data_id], [
                'name'                      =>  strtolower($this->name),
                'guard_name'                => 'web',
            ]);
        }

        $this->dispatch('alert', ['type' => 'success', 'message' => $this->data_id ? $this->type. ' Updated Successfully.' : $this->type. ' Created Successfully.' ]);
        $this->closeModal();
    }

    private function resetInputFields(){
        $this->type                         =   null;
        $this->name                         =   null;
        $this->data_id                      =   null;
        $this->isOpen                       =   false;
    }

    public function closeModal(){ $this->resetInputFields(); }    
    protected $listeners = ['searchUpdated', 'perPageUpdated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->isOpen = 1; }
}