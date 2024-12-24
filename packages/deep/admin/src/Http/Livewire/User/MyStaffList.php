<?php

namespace Deep\Admin\Http\Livewire\User;

use Livewire\Component;

use DB;
use Deep\Admin\Models\MyStaff;

use Livewire\WithPagination;

class MyStaffList extends Component
{
    use WithPagination;

    public $sortBy = 'id', $sortDirection = 'desc', $perPage = 100, $search;

    public function mount(){
    }

    public function render(){
        $data = MyStaff::search($this->search)->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage);
        return view('deep::livewire.user.my-staff-list', [ "data" => $data ])->layout('layouts.admin');
    }

    public function changeStatus($id, $status){
        $message = changeStatus('my_staff', 'status', $id, $status);
        $this->dispatch('alert', ['type' => 'success',  'message' => $message]);
    }

    protected $listeners = ['searchUpdated', 'perPageUpdated', 'userCreated', 'openModalCalled' ];
    public function searchUpdated($search){ $this->search = $search; }
    public function perPageUpdated($perPage){ $this->perPage = $perPage; }
    public function openModalCalled(){ $this->dispatch( 'createUser' ); }
    public function userCreated( $user_id ){ 
        MyStaff::create([
            'user_id'                   =>  Auth::user()->id,
            'staff_id'                  =>  decode( $user_id ),
            'status'                    =>  1
        ]);
    }
}